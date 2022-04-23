<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\IncidentService;
use App\Http\Requests\StoreUpdateIncident;
use App\Http\Requests\RefundIncident;
use App\Http\Requests\SupportIncident;
use App\Http\Resources\IncidentResource;
use App\Http\Resources\WalletBalanceResource;

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
     * @param  \Illuminate\Http\StoreUpdateIncident  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateIncident $request)
    {
        $incident = $this->incidentService
                        ->create($request->validated());

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
        $incident = $this->incidentService
                        ->getById($id);

        return new IncidentResource($incident);
    }

    /**
     * Support the incident.
     *
     * @param  \Illuminate\Http\StoreUpdateIncident  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function support(SupportIncident $request, $id)
    {
        $incident = $this->incidentService
                        ->support($id, $request->validated());

        return new IncidentResource($incident);
    }

    /**
     * Refund the incident
     *
     * @param  \Illuminate\Http\StoreUpdateIncident  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refund(RefundIncident $request, $id)
    {
        $incident = $this->incidentService
                        ->refund($id, $request->validated());

        return new IncidentResource($incident);
    }


}
