<?php

namespace App\Repositories;

use App\Repositories\Impl\RedeemVoucherRepositoryInterface;
use App\Models\RedeemVoucher;
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
    public function __construct(RedeemVoucher $voucher)
    {
        $this->entity = $voucher;
        $this->wallet = new WalletRepository();
        $this->transaction = new TransactionRepository();
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
     * @return Voucher
     */
    public function findById(int $id): ?Voucher
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * Find by Token
     *
     * @param string $token
     * @return Voucher
     */
    public function findByToken(string $token): ?Voucher
    {
        return $this->entity->where('token', $token)->findOrFail();
    }

    /**
     * Create a Voucher
     *
     * @param array $data
     * @return Voucher
     */
    public function create(array $data): ?Voucher
    {
        return $this->entity->create($data);
    }

    /**
     * Update a Voucher
     *
     * @param int $id
     * @param int $user_id
     * @return Voucher
     */
    public function redeemUpdate(int $id, int $user_id): ?Voucher
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