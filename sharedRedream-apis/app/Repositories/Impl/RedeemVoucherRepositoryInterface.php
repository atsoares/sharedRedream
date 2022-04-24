<?php

namespace App\Repositories\Impl;

interface RedeemVoucherRepositoryInterface
{
    public function getAll();
    public function findById(int $id);
    public function findByToken(string $token);
    public function create(array $data);
    public function redeemUpdate(object $voucher, int $user_id);
}