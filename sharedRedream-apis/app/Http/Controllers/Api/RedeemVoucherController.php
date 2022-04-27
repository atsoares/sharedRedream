<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RedeemVoucherService;
use App\Http\Requests\RedeemVoucherRequest;
use App\Http\Resources\RedeemVoucherResource;
use Illuminate\Support\Facades\Auth;

class RedeemVoucherController extends Controller
{
    /**
     * Variable to hold injected dependency
     *
     * @var redeemVoucherService
     */
    protected $redeemVoucherService;

    /**
     * Constructor
     *
     * @param RedeemVoucherService $redeemVoucherService
     */
    public function __construct(RedeemVoucherService $redeemVoucherService)
    {
        $this->redeemVoucherService = $redeemVoucherService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $count
     * @return \Illuminate\Http\Response
     */
    public function storeInBatch(int $count)
    {
        return $this->redeemVoucherService->generateNewVouchers($count);
    }

    /**
     * Redeem and update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RedeemVoucherRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redeem(RedeemVoucherRequest $request)
    {
        if(Auth::user()->id != $request->user_id)
            return response()->json(['message' => 'Not Authorized'], 401);
        
        return $this->redeemVoucherService->redeem($request->validated());
    }
}
