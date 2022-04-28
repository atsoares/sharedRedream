<?php

namespace App\Services;

use App\Repositories\Impl\IncidentRepositoryInterface;
use App\Exceptions\AuthException;
use Illuminate\Support\Facades\Auth;
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
        return $this->incidentRepository->support($id, $data);
    }

    /**
     * Refund existing Incident
     *
     */
    public function refund(int $id)
    {
        $incident = $this->incidentRepository->findById($id);
        if(Auth::user()->id != $incident->user_id)
            throw new AuthException();

        return $this->incidentRepository->refund($id);
    }
   
}