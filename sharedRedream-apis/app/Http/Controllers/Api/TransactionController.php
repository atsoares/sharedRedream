<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\WalletService;
use App\Http\Requests\UserExtractRequest;
use App\Http\Requests\IncidentExtractRequest;
use App\Http\Resources\TransactionResource;

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
     * @param  UserExtractRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function userExtract(UserExtractRequest $request)
    {
        $validated = $request->validated();

        $transactions = $this->transactionService->getAllByUser($validated['user_id']);
        return new TransactionResource($transactions);   
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  IncidentExtractRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function incidentExtract(IncidentExtractRequest $request)
    {
        $validated = $request->validated();

        $transactions = $this->transactionService->getAllByIncident($validated['incident_id']);
        return new TransactionResource($transactions);  
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
