<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Repositories\Impl\IncidentRepositoryInterface;
use App\Models\Incident;
use App\Models\Wallet;
use App\Models\Transaction;
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
        return $this->entity->get();
    }

    /**
     * Get All Active
     *
     * @return Collection
     */
    public function getAllActive(): Collection
    {
        return $this->entity->where('active', true)->get();
    }
    
    /**
     * Get All Active and Expired
     *
     * @return Collection
     */
    public function getAllActiveExpired(): Collection
    {
        return $this->entity->where('active', true)
                            ->where('expires_at', '<', today())
                            ->get();
    }
    

    /**
     * Find by User Id
     *
     * @param int $user_id
     * @return Collection
     */
    public function findByUserId(int $user_id): ?Collection
    {
        return $this->entity->where('user_id', $user_id)->get();
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
     * @param array $data
     * @return Incident
     */
    public function create(array $data): ?Incident
    {
        $data['user_id'] = Auth::user()->id;
     
        //since the create response doesn't returns the not requested fields default values, I'm passing this value here to assertions tests
        $data['total_raised'] = 0; 

        //tried to use .fresh() but returns 200 instead 201.
        return $this->entity->create($data); 
    }

    /**
     * Update existing Incident
     *
     * @param object $incident
     * @param array $data
     * @return bool
     */
    public function update(object $incident, array $data)
    {
        return $incident->update($data);
    }

    /**
     * Disable Incident
     *
     * @param object $incident
     * @param array $data
     * @return bool
     */
    public function disable(object $incident)
    {
        $incident->active = false;
        $incident->save();

        return $incident;
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
        $this->wallet->withdrawal($this->wallet->findByUserId(Auth::user()->id), $data['value']);
        
        $incident->total_raised = $incident->total_raised + $data['value'];
        $incident->save();

        $this->transaction->create([
            'user_id' => Auth::user()->id,
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
        $incident->active = false;
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