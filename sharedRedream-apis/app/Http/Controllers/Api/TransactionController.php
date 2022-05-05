<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\Http\Resources\TransactionIncidentResource;
use App\Http\Resources\TransactionUserResource;

/**
 * @group Transaction endpoints
 */
class TransactionController extends Controller
{
    /**
     * Variable to hold injected dependency
     *
     * @var transactionService
     */
    protected $transactionService;

    /**
     * Constructor
     *
     * @param TransactionService $transactionService
     */
    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Get all transactions from an USER
     *
     * @authenticated
     *
     * @response 200 {
     *    "data": [
     *     {
     *        "operation": "voucher_redeem",
     *        "redeem_voucher_id": 6,
     *        "value": "100.00"
     *     },
     *     {
     *        "operation": "incident_help",
     *        "incident_id": 2,
     *        "value": "30.00"
     *     },
     *     {
     *        "operation": "incident_help",
     *        "incident_id": 3,
     *        "value": "20.00"
     *     }
     * }
     * @response status=403 scenario="Not authorized user trying to perform" { 
     *    "error": "This action is not allowed",
     *    "code": 403
     * }
     * 
     * @return \Illuminate\Http\Response
     */
    public function userExtract()
    {
        $transactions = $this->transactionService->getAllByUser(Auth::user()->id);
        return TransactionUserResource::collection($transactions);   
    }
    
    /**
     * Get all transactions from an incident.
     *
     * @authenticated
     * 
     * @response 200 {
     *    "data": [
     *     {
     *        "operation": "incident_help",
     *        "user": Alex,
     *        "value": "30.00"
     *     },
     *     {
     *        "operation": "incident_help",
     *        "user": John,
     *        "value": "20.00"
     *     }
     * }
     * 
     * @response status=404 scenario="Incident not found" { 
     *    "message": "Incident does not exist"
     * }
     * @param  int  $incident_id
     * @return \Illuminate\Http\Response
     */
    public function incidentExtract($incident_id)
    {
        $transactions = $this->transactionService->getAllByIncident($incident_id);
        return TransactionIncidentResource::collection($transactions);  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
