<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RedeemVoucherService;
use App\Http\Requests\RedeemVoucher;
use App\Http\Resources\CreateVoucherResource;
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
        $vouchers = $this->redeemVoucherService->generateNewVouchers($count);
        return $vouchers;
    }

    /**
     * Redeem and update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redeem(RedeemVoucher $request)
    {
        if(Auth::user()->id != $request->user_id)
            return response()->json(['message' => 'Not Authorized'], 401);

        $voucher = $this->redeemVoucherService->findByToken($request->token);

        if(!$voucher)
            return response()->json(['message' => 'Token not valid'], 401);
        
        return $this->redeemVoucherService->redeem($voucher, $request->user_id);
    }
}
