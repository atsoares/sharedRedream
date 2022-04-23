<?php

namespace App\Repositories;

use App\Repositories\Impl\RedeemVoucherRepositoryInterface;
use App\Models\RedeemVoucher;
use App\Models\Wallet;
use App\Models\Transaction;
use Carbon\Carbon;

class RedeemVoucherRepository implements RedeemVoucherRepositoryInterface
{
    /**
     * Variable to hold injected dependency
     *
     * @var entity
     */
    protected $entity;

    /**
     * Variable to hold injected dependency
     *
     * @var wallet
     */
    protected $wallet;

    /**
     * Variable to hold injected dependency
     *
     * @var transaction
     */
    protected $transaction;

    /**
     * Constructor
     *
     * @param RedeemVoucher $voucher
     */
    public function __construct(RedeemVoucher $voucher, Wallet $w, Transaction $t)
    {
        $this->entity = $voucher;
        $this->wallet = new WalletRepository($w);
        $this->transaction = new TransactionRepository($t);
    }

    /**
     * Get All
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->entity->all();
    }

    /**
     * Find by Id
     *
     * @param int $id
     * @return RedeemVoucher
     */
    public function findById(int $id): ?RedeemVoucher
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * Find by Token
     *
     * @param string $token
     * @return RedeemVoucher
     */
    public function findByToken(string $token): ?RedeemVoucher
    {
        return $this->entity->where('token', $token)->first();
    }

    /**
     * Create a Voucher
     *
     * @param array $data
     * @return RedeemVoucher
     */
    public function create(array $data): ?RedeemVoucher
    {
        return $this->entity->create($data);
    }

    /**
     * Update a Voucher
     *
     * @param int $id
     * @param int $user_id
     * @return RedeemVoucher
     */
    public function redeemUpdate(int $id, int $user_id): ?RedeemVoucher
    {
        $voucher = $this->findById($id);

        $voucher->active = false;
        $voucher->refunded_at = Carbon::now();
        $voucher->user_id = $user_id;
        $voucher->save();

        $this->wallet->deposit($user_id, $voucher->value);

        $this->transaction->create([
            'user_id' => $user_id,
            'redeem_voucher_id' => $voucher->id,
            'operation' => 'voucher_redeem'
        ]);

        return $voucher;
    }
}