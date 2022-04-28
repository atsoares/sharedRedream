<?php

namespace App\Repositories;

use App\Repositories\Impl\IncidentRepositoryInterface;
use App\Models\Incident;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Exceptions\NotEnoughtBalanceException;
use Illuminate\Database\Eloquent\Collection;

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
    public function __construct(Incident $incident, Wallet $w, Transaction $t)
    {
        $this->entity = $incident;
        $this->wallet = new WalletRepository($w);
        $this->transaction = new TransactionRepository($t);
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
        return $this->entity->where('refunded', false)->find($id);
    }

    /**
     * Create a Incident
     *
     * @param array $data
     * @return Incident
     */
    public function create(array $data): ?Incident
    {
        $data['total_raised'] = 0;
        return $this->entity->create($data);
    }

    /**
     * Update existing Incident
     *
     * @param int $id
     * @param array $data
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
     * @param object $incident
     * @param array $data
     * @return Incident
     */
    public function support(object $incident, array $data): ?Incident
    {
        $wallet = $this->wallet
                            ->checkIfUserHasAvailableBalance($data['user_id'], $data['value']);
       
        if(!$wallet)
            throw new NotEnoughtBalanceException();

        $this->wallet->withdrawal($wallet, $data['value']);
        
        $incident->total_raised = $incident->total_raised + $data['value'];
        $incident->save();

        $this->transaction->create([
            'user_id' => $data['user_id'],
            'incident_id' => $incident->id,
            'value' => $data['value'],
            'operation' => 'incident_help'
        ]);
        return $incident;
    }

    /**
     * Refund existing Incident
     *
     * @param object $incident
     * @return Incident
     */
    public function refund(object $incident): ?Incident
    {
        $incident->refunded = true;
        $incident->refunded_at = now();

        $incident->save();

        $wallet = $this->wallet->findByUserId($incident->user_id);

        $this->wallet->deposit($wallet, $incident->total_raised);

        $this->transaction->create([
            'user_id' => $incident->user_id,
            'incident_id' => $incident->id,
            'value' => $incident->total_raised,
            'operation' => 'incident_refund'
        ]);

        return $incident;
    }
}