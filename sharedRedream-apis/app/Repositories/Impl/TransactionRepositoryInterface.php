<?php

namespace App\Repositories\Impl;

interface TransactionRepositoryInterface
{
    public function getAllByUser(int $user_id);
    public function create(array $data);

}