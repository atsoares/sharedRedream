<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\Http\Resources\TransactionIncidentResource;
use App\Http\Resources\TransactionUserResource;

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
     * Display a listing of the resource.
     *
     * @param  int  $user_id
     * @return \Illuminate\Http\Response
     */
    public function userExtract($user_id)
    {
        $transactions = $this->transactionService->getAllByUser($user_id);
        return TransactionUserResource::collection($transactions);   
    }
    
    /**
     * Display a listing of the resource.
     *
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
