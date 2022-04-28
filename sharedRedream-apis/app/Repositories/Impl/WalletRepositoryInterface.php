<?php

namespace App\Repositories\Impl;

use App\Models\Wallet;

interface WalletRepositoryInterface
{
    public function findById(int $id);
    public function findByUserId(int $user_id);
    public function create(array $data);
    public function deposit(Wallet $wallet, float $value);
    public function withdrawal(Wallet $wallet, float $value);
    public function checkIfUserHasAvailableBalance(int $user_id, float $value);

} 