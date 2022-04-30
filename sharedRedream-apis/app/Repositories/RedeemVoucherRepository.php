<?php

namespace App\Repositories;

use App\Repositories\Impl\RedeemVoucherRepositoryInterface;
use App\Models\RedeemVoucher;
use App\Models\Wallet;
use App\Models\Transaction;

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
     * Get one active
     *
     * @return RedeemVoucher
     */
    public function getOneAvailable(): ?RedeemVoucher
    {
        return $this->entity->where('active', true)->first();
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
        return $this->entity
                        ->where('token', $token)
                        ->first();
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
     * @param object $voucher
     * @return RedeemVoucher
     */
    public function redeemUpdate(object $voucher, int $user_id): ?RedeemVoucher
    {
        $voucher->active = false;
        $voucher->refunded_at = now();
        $voucher->user_id = $user_id;
        $voucher->save();

        $wallet = $this->wallet->findByUserId($user_id);

        $this->wallet->deposit($wallet, $voucher->value);

        $this->transaction->create([
            'user_id' => $user_id,
            'redeem_voucher_id' => $voucher->id,
            'value' => $voucher->value,
            'operation' => 'voucher_redeem'
        ]);

        return $voucher;
    }
}