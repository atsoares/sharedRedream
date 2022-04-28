<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\IncidentService;
use App\Http\Requests\StoreUpdateIncidentRequest;
use App\Http\Requests\SupportIncidentRequest;
use App\Http\Resources\IncidentResource;

class IncidentController extends Controller
{
    /**
     * Variable to hold injected dependency
     *
     * @var incidentService
     */
    protected $incidentService;

    /**
     * Constructor
     *
     * @param IncidentService $incidentService
     */
    public function __construct(IncidentService $incidentService)
    {
        $this->incidentService = $incidentService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidents = $this->incidentService->getAll();
        return IncidentResource::collection($incidents);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUpdateIncidentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateIncidentRequest $request)
    {
        $incident = $this->incidentService->create($request->validated());

        return new IncidentResource($incident);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $incident = $this->incidentService->getById($id);

        return new IncidentResource($incident);
    }

    /**
     * Support the incident.
     *
     * @param  SupportIncidentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function support(SupportIncidentRequest $request, $id)
    {
        $incident = $this->incidentService->support($id, $request->validated());
    
        if($incident instanceof Incident)
            return new IncidentResource($incident);
        
        return $incident;
    }

    /**
     * Refund the incident
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refund($id)
    {
        $incident = $this->incidentService->refund($id);

        if($incident instanceof Incident)
            return new IncidentResource($incident);
        
        return $incident;
    }


}
