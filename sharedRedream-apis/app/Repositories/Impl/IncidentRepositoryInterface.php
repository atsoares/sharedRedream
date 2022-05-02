<?php

namespace App\Repositories\Impl;

interface IncidentRepositoryInterface
{
    public function getAll();
    public function getAllActive();
    public function getAllActiveExpired();
    public function findById(int $id);
    public function findByUserId(int $user_id);
    public function create(array $data);
    public function disable(object $incident);
    public function update(object $incident, array $data);
    public function support(object $incident, array $data);
    public function refund(object $incident);
} 