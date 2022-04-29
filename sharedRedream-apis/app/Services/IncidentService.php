<?php

namespace App\Services;

use App\Repositories\Impl\IncidentRepositoryInterface;
use App\Exceptions\AuthException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Exceptions\NotEnoughtBalanceException;

class IncidentService
{
    /**
     * Variable to hold injected dependency
     *
     * @var incidentRepository
     */
    private $incidentRepository;

    /**
     * Constructor
     *
     * @param IncidentRepositoryInterface $incidentRepository
     */
    public function __construct(IncidentRepositoryInterface $incidentRepository)
    {
        $this->incidentRepository = $incidentRepository;
    }

    /**
     * Get All
     *
     */
    public function getAll()
    {
        return $this->incidentRepository->getAll();
    }

    /**
     * Get All from user
     *
     */
    public function getAllFromUser(int $user_id)
    {
        return $this->incidentRepository->findByUserId($user_id);
    }

    /**
     * Find by Id
     *
     * @param int $id
     */
    public function getById(int $id)
    {
        return $this->incidentRepository->findById($id);
    }

    /**
     * Create a Incident
     *
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->incidentRepository->create($data);
    }

    /**
     * Support existing Incident
     *
     */
    public function support(int $id, array $data)
    {
        $incident = $this->findById($id);
        if(!$incident)
            throw new HttpResponseException(response()->json("Incident does not exist", 404));

        if(Auth::user()->id != $data['user_id'])
            throw new AuthException();
        return $this->incidentRepository->support($incident, $data);
    }

    /**
     * Refund existing Incident
     *
     */
    public function refund(int $id)
    {
        $incident = $this->incidentRepository->findById($id);
        if(!$incident)
        throw new HttpResponseException(response()->json("Incident does not exist", 404));
        
        if(Auth::user()->id != $incident->user_id)
            throw new AuthException();
        
        return $this->incidentRepository->refund($incident);
    }
   
}