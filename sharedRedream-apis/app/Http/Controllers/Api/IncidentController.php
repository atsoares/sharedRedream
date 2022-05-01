<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Incident;
use App\Services\IncidentService;
use App\Http\Requests\StoreUpdateIncidentRequest;
use App\Http\Requests\SupportIncidentRequest;
use App\Http\Resources\IncidentResource;

/**
 * @group Incident endpoints
 */
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
     * Create new incident
     *
     * @authenticated
     * 
     * @response 201 {
     *    "data": {
     *        "title": "Help my Cats",
     *        "description": "Need help to feed my cats please",
     *        "owner": "CatFan",
     *        "total_raised": 0,
     *        "goal": "500.00",
     *        "expires_at": "28-05-2022",
     *        "created_at": "28-04-2022 15:46:21",
     *        "transactions": []
     *     }
     * }
     * @response status=422 scenario="Validation error" { 
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "description": [
     *            "The description field is required."
     *        ]
     *    }
     * }
     * @param  StoreUpdateIncidentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateIncidentRequest $request)
    {
        $incident = $this->incidentService->create($request->validated());

        return new IncidentResource($incident);
    }
    
    /**
     * Get all active incidents
     * 
     * @authenticated
     * 
     * @response 200 {
     *    "data": {
     *        "id": 2,
     *        "title": "Help my Cats",
     *        "description": "Need help to feed my cats please",
     *        "owner": "CatFan",
     *        "total_raised": "170.00",
     *        "goal": "500.00",
     *        "expires_at": "28-05-2022",
     *        "created_at": "28-04-2022 15:46:21",
     *        "transactions": [
     *          {
     *            "operation": "incident_help",
     *            "user": "John",
     *            "value": "55.00"
     *          },
     *          {
     *            "operation": "incident_help",
     *            "user": "Alex",
     *            "value": "45.00"
     *          },  
     *          {
     *            "operation": "incident_help",
     *            "user": "Doug",
     *            "value": "70.00"
     *          }
     *        ]
     *    }
     * }
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $incidents = $this->incidentService->getAllActive();
        return IncidentResource::collection($incidents);
    }

    /**
     * Get all incidents from an USER
     *
     * @authenticated
     * 
     * @response 200 {
     *    "data": {
     *        "id": 2,
     *        "title": "Help my Cats",
     *        "description": "Need help to feed my cats please",
     *        "owner": "CatFan",
     *        "total_raised": "170.00",
     *        "goal": "500.00",
     *        "expires_at": "28-05-2022",
     *        "created_at": "28-04-2022 15:46:21",
     *        "transactions": [
     *          {
     *            "operation": "incident_help",
     *            "user": "John",
     *            "value": "55.00"
     *          },
     *          {
     *            "operation": "incident_help",
     *            "user": "Alex",
     *            "value": "45.00"
     *          },  
     *          {
     *            "operation": "incident_help",
     *            "user": "Doug",
     *            "value": "70.00"
     *          }
     *        ]
     *    }
     * }
     * 
     * @param int $user_id
     * @return \Illuminate\Http\Response
     */
    public function userIncidents(int $user_id)
    {
        $incidents = $this->incidentService->getAllFromUser($user_id);
        return IncidentResource::collection($incidents);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $incident = $this->incidentService->getById($id);

        return new IncidentResource($incident);
    }

    /**
     * Support the incident
     * 
     * The user can help donating some value to an incident
     *
     * @authenticated
     * 
     * @response 200 {
     *    "data": {
     *        "title": "Help my Cats",
     *        "description": "Need help to feed my cats please",
     *        "owner": "CatFan",
     *        "total_raised": 45,
     *        "created_at": "28-04-2022 15:46:21",
     *        "transactions": [
     *          {
     *            "operation": "incident_help",
     *            "user": "Alex",
     *            "value": "45.00"
     *          }  
     *        ]
     *     }
     * }
     * @response status=422 scenario="Validation error" { 
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "value": [
     *            "The value field is required."
     *        ]
     *    }
     * }
     * @response status=422 scenario="Not enouth money" { 
     *    "error": "Balance is not enought",
     *    "code": 422
     * }
     * @response status=404 scenario="Incident not found" { 
     *    "message": "Incident does not exist"
     * }
     * 
     * @param  SupportIncidentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function support(SupportIncidentRequest $request,int $id)
    {
        $incident = $this->incidentService->support($id, $request->validated());
        
        if($incident instanceof Incident){}
            return new IncidentResource($incident);
        
        return $incident;
    }

    /**
     * Refund the incident
     * 
     * Refunds the total raised to the owner of the incident.
     *
     * @authenticated
     * 
     * @response 200 {
     *    "data": {
     *        "title": "Help my Cats",
     *        "description": "Need help to feed my cats please",
     *        "owner": "CatFan",
     *        "total_raised": 45,
     *        "created_at": "28-04-2022 15:46:21",
     *        "transactions": [
     *          {
     *            "operation": "incident_help",
     *            "user": "Alex",
     *            "value": "45.00"
     *          },
     *          {
     *            "operation": "incident_refund",
     *            "user": "CatFan",
     *            "value": "45.00"
     *          }  
     *        ]
     *     }
     * }
     * @response status=403 scenario="Not authorized user trying to perform" { 
     *    "error": "This action is not allowed",
     *    "code": 403
     * }
     * @response status=404 scenario="Incident not found" { 
     *    "message": "Incident does not exist"
     * }
     * 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function refund(int $id)
    {
        $incident = $this->incidentService->refund($id);

        if($incident instanceof Incident)
            return new IncidentResource($incident);
        
        return $incident;
    }


}
