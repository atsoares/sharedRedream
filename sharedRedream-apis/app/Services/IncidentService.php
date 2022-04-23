<?php

namespace App\Services;

use App\Repositories\Impl\IncidentRepositoryInterface;

class IncidentService
{
    /**
     * Variable to hold injected dependency
     *
     * @var incidentRepository
     */
    protected $incidentRepository;

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
    public function findById(int $id)
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
        $this->incidentRepository->support($id, $data);
        return response()->json(['message' => 'Incident Helped'], 200);
    }

    /**
     * Refund existing Incident
     *
     */
    public function refund(int $id, array $data)
    {
        $this->incidentRepository->refund($id, $data);
        return response()->json(['message' => 'Incident Refudend'], 200);
    }
   
}