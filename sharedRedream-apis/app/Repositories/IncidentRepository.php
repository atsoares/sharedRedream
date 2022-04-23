<?php

namespace App\Repositories;

use App\Repositories\Impl\IncidentRepositoryInterface;
use App\Models\Incident;
use Carbon\Carbon;

class IncidentRepository implements IncidentRepositoryInterface
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
     * @param Incident $incident
     */
    public function __construct(Incident $incident)
    {
        $this->entity = $incident;
        $this->wallet = new WalletRepository();
        $this->transaction = new TransactionRepository();
    }

    /**
     * Get All
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->entity->where('refunded', false)->get();
    }

    /**
     * Find by Id
     *
     * @param int $id
     * @return Incident
     */
    public function findById(int $id): ?Incident
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * Create a Incident
     *
     * @return Incident
     */
    public function create(array $data): ?Incident
    {
        $incident = $this->entity->create($data);
        return $incident->fresh();
    }

    /**
     * Update existing Incident
     *
     * @return Incident
     */
    public function update(int $id, array $data): ?Incident
    {
        $incident = $this->findById($id);

        return $incident->update($data);
    }

    /**
     * Support existing Incident
     *
     * @return Incident
     */
    public function support(int $id, array $data): ?Incident
    {
        $incident = $this->findById($id);

        $this->wallet->withdrawal($data['user_id'], $data['value']);

        $incident->total_raised = $incident->total_raised + $data['value'];
        $incident->save();

        $this->transaction->create([
            'user_id' => $data['user_id'],
            'incident_id' => $incident->id,
            'operation' => 'incident_help'
        ]);
        return $incident;
    }

    /**
     * Refund existing Incident
     *
     * @return Incident
     */
    public function refund(int $id): ?Incident
    {
        $incident = $this->findById($id);

        $incident->refunded = true;
        $incident->refunded_at = Carbon::now();

        $incident->save();

        $this->wallet->deposit($incident->user_id, $incident->total_raised);

        $this->transaction->create([
            'user_id' => $incident->user_id,
            'incident_id' => $incident->id,
            'operation' => 'incident_refund'
        ]);

        return $incident;
    }
}