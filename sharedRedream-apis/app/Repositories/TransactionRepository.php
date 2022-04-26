<?php

namespace App\Repositories;

use App\Models\Transaction;

class TransactionRepository
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
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction)
    {
        $this->entity = $transaction;
    }

    /**
     * Get All by Users
     *
     * @param int $user_id
     * @return Collection
     */
    public function getAllByUser(int $user_id): Collection
    {
        return $this->entity->where('user_id', $user_id)->get();
    }

    /**
     * Get All Supporters per Incident
     *
     * @param int $incident_id
     * @return Collection
     */
    public function getAllSupportersByIncident(int $incident_id): Collection
    {
        return $this->entity->where('incident_id', $incident_id)->get();
    }

    /**
     * Create new transaction
     *
     * @param array $data
     * @return Transaction
     */
    public function create(array $data): ?Transaction
    {
        return $this->entity->create($data);
    }

}