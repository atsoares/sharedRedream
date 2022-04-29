<?php

namespace App\Repositories\Impl;

interface IncidentRepositoryInterface
{
    public function getAll();
    public function getAllActive();
    public function findById(int $id);
    public function findByUserId(int $user_id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function support(object $incident, array $data);
    public function refund(object $incident);
} 