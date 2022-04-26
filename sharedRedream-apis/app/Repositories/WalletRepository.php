<?php

namespace App\Repositories;

use App\Repositories\Impl\WalletRepositoryInterface;
use App\Models\Wallet;

class WalletRepository implements WalletRepositoryInterface
{
    /**
     * Variable to hold injected dependency
     *
     * @var entity
     */
    protected $entity;

    /**
     * Constructor
     *
     * @param Wallet $wallet
     */
    public function __construct(Wallet $wallet)
    {
        $this->entity = $wallet;
    }

    /**
     * Find by Id
     *
     * @param int $id
     * @return Wallet
     */
    public function findById(int $id): ?Wallet
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * Find by User Id
     *
     * @param int $user_id
     * @return Wallet
     */
    public function findByUserId(int $user_id): ?Wallet
    {
        return $this->entity->where('user_id', $user_id)->first();
    }

    /**
     * Create a Wallet
     *
     * @param array $data
     * @return Wallet
     */
    public function create(array $data): ?Wallet
    {
        $wallet = $this->entity->create($data);
        return $wallet->fresh();
    }

    /**
     * Deposit value to a Wallet
     *
     * @param int $user_id
     * @param float $value
     * @return Wallet
     */
    public function deposit(int $user_id, float $value): ?Wallet
    {
        $wallet = $this->findByUserId($user_id);

        $wallet->balance = $wallet->balance + $value;
        $wallet->save();

        return $wallet;
    }

    /**
     * Withdraw value from a Wallet
     *
     * @param int $user_id
     * @param float $value
     * @return bool
     */
    public function withdrawal(int $user_id, float $value)
    {
        $wallet = $this->findByUserId($user_id);

        if($this->checkAvailableBalance($wallet, $value)){
            $wallet->balance = $wallet->balance - $value;
            $wallet->save();
            return true;
        }else{
            return false;
        }
    }

    /**
     * Check if wallet has enough amount to be withdraw
     *
     * @param int $id
     * @param float $value
     * @return bool
     */
    public function checkAvailableBalance(object $wallet, float $value)
    {
        $actual = $wallet->balance;
        $after = $actual - $value;
        if($after <= 0){
            return false;
        }
        return true;
    }
}