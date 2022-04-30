<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RedeemVoucherService;
use App\Http\Requests\RedeemVoucherRequest;
use App\Http\Resources\RedeemVoucherResource;

/**
 * @group Voucher endpoints
 */
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
     * Generate new Vouchers 
     * 
     * I know, in real world this end point would be available only for admin user type, but.. yeah.. 
     * Lets keep this way, just to make faster to test
     * 
     * @authenticated
     * 
     * @response 201 {
     *    "message": "Vouchers Created"
     * }
     * 
     * @param  int  $count
     * @return \Illuminate\Http\Response
     */
    public function storeInBatch(int $count)
    {
        return $this->redeemVoucherService->generateNewVouchers($count);
    }

    /**
     * Redeem the voucher passing USER_ID
     * 
     * The user gets the value in his wallet and can start to help others
     *
     * @authenticated
     * 
     * @response 200 {
     *    "data": {
     *        "token": "S49SC89I34BC3S0KJRJM",
     *        "user_id": 2,
     *        "value": 100.00,
     *        "used_at": "28-04-2022 15:46:21"
     *    }
     * }
     * 
     * @response status=422 scenario="Validation error" { 
     *    "message": "The given data was invalid.",
     *    "errors": {
     *        "token": [
     *            "The token must be at least 20 characters."
     *        ]
     *    }
     * }
     * @response status=403 scenario="Not authorized user trying to perform" { 
     *    "error": "This action is not allowed",
     *    "code": 403
     * }
     * @param  RedeemVoucherRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function redeem(RedeemVoucherRequest $request)
    {
        $voucher = $this->redeemVoucherService->redeem($request->validated());
        return new RedeemVoucherResource($voucher);
    }

    /**
     * Get one token to redeem
     * 
     * Just to test it quick, lets get one token number
     *
     * @authenticated
     * 
     * @response 200 {
     *    "data": {
     *        "token": "S49SC89I34BC3S0KJRJM",
     *        "value": 100.00
     *    }
     * }
     * 
     * @response status=404 scenario="Not found" { 
     *    "message": "We're out of token"
     * }
     * @return \Illuminate\Http\Response
     */
    public function getOneAvailable()
    {
        return new RedeemVoucherResource($this->redeemVoucherService->getOneAvailable());
    }
}
