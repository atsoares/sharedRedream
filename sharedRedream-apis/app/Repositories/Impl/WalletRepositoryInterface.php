<?php

namespace App\Repositories\Impl;

interface WalletRepositoryInterface
{
    public function findById(int $id);
    public function findByUserId(int $user_id);
    public function create(array $data);
    public function deposit(int $user_id, int $value);
    public function withdrawal(int $user_id, int $value);

}