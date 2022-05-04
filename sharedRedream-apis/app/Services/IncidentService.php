<?php

namespace App\Services;

use App\Repositories\Impl\IncidentRepositoryInterface;
use App\Exceptions\AuthException;
use App\Models\Incident;
use App\Policies\IncidentPolicy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Exceptions\HttpResponseException;

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
    public function getAllActive()
    {
        if(!Auth::hasUser())
            throw new AuthException();
        return $this->incidentRepository->getAllActive();
    }

    /**
     * Get All from user
     *
     */
    public function getAllFromUser(int $user_id)
    {
        if(!Auth::hasUser())
            throw new AuthException();
        return $this->incidentRepository->findByUserId($user_id);
    }

    /**
     * Find by Id
     *
     * @param int $id
     */
    public function getById(int $id)
    {
        if(!Auth::hasUser())
            throw new AuthException();
        return $this->incidentRepository->findById($id);
    }

    /**
     * Create a Incident
     *
     * @param array $data
     */
    public function create(array $data)
    {
        if(!Auth::hasUser() || Auth::user()->id != $data['user_id'])
            throw new AuthException();
        return $this->incidentRepository->create($data);
    }

    /**
     * Support existing Incident
     *
     */
    public function support(int $id, array $data)
    {
        if(Auth::user()->id != $data['user_id'])
            throw new AuthException();

        $incident = $this->getById($id);
        if(!$incident)
            throw new HttpResponseException(response()->json(["message"=>"Incident does not exist"], 404));

        return $this->incidentRepository->support($incident, $data);
    }

    /**
     * Refund existing Incident
     *
     */
    public function refund(int $id)
    {
        if(!Auth::hasUser())
            throw new AuthException();

        $incident = $this->getById($id);
        if(!$incident)
            throw new HttpResponseException(response()->json(["message"=>"Incident does not exist"], 404));
        
        if(Auth::user()->id != $incident->user_id)
            throw new AuthException();
        
        if($incident->total_raised <= 0)
            throw new HttpResponseException(response()->json(["message"=>"Nothing to refund"], 422));

        return $this->incidentRepository->refund($incident);
    }
   
}