<?php

namespace App\Repositories\Impl;

interface IncidentRepositoryInterface
{
    public function getAll();
    public function findById(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function support(int $id, array $data);
    public function refund(int $id, array $data);
}