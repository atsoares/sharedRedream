<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RedeemVoucherService;
use App\Http\Requests\RedeemVoucherRequest;
use App\Http\Resources\RedeemVoucherResource;

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
     * @param  RedeemVoucherRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redeem(RedeemVoucherRequest $request)
    {
        return $this->redeemVoucherService->redeem($request->validated());
    }
}
