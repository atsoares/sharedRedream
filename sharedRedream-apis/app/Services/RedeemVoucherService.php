<?php

namespace App\Services;

use App\Repositories\Impl\RedeemVoucherRepositoryInterface;

class RedeemVoucherService
{
    /**
     * Variable to hold injected dependency
     *
     * @var redeemVoucherRepository
     */
    protected $redeemVoucherRepository;

    /**
     * Constructor
     *
     * @param RedeemVoucherRepositoryInterface $redeemVoucherRepository
     */
    public function __construct(RedeemVoucherRepositoryInterface $redeemVoucherRepository)
    {
        $this->redeemVoucherRepository = $redeemVoucherRepository;
    }

    /**
     * Get All
     *
     */
    public function getAll()
    {
        return $this->redeemVoucherRepository->getAll();
    }

    /**
     * Find by Id
     *
     * @param int $id
     */
    public function findById(int $id)
    {
        return $this->redeemVoucherRepository->findById($id);
    }

    /**
     * Create a Voucher
     *
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->redeemVoucherRepository->create($data);
        return response()->json(['message' => 'Voucher created'], 201);
    }

    /**
     * Redeem a Voucher
     *
     * @param array $data
     */
    public function redeem(array $data)
    {
        $voucher = $this->redeemVoucherRepository->findByToken($data['token']);

        if(!$voucher || !$voucher->active)
            return response()->json(['message' => 'Token not valid'], 404);

        $this->redeemVoucherRepository->redeemUpdate($voucher->id, $data['user_id']);
        return response()->json(['message' => 'Redeem voucher with success'], 200);
    }

    /**
     * Generate new vouchers
     *
     * @param int $count
     */
    public function generateNewVouchers(int $count)
    {
        if($count > 0){
            for ($x = 0; $x <= $count; $x++) {
                $data = [
                    'token' => getUniqueToken(),
                    'value' => random_int(10,100)
                ];
                $this->redeemVoucherRepository->create($data);
            }
        }
        return response()->json(['message' => 'Vouchers Created'], 201);
    }

    /**
     * Generate unique token
     *
     */
    public function getUniqueToken(){
        $token = "";
        $combinationString = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        for($i=0;$i<20;$i++){
            $token .= $combinationString[uniqueSecureHelper(0,strlen($combinationString))];
        }
        return $token;
    }
}