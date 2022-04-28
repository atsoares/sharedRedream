<?php

namespace App\Services;

use App\Repositories\Impl\RedeemVoucherRepositoryInterface;
use App\Exceptions\InvalidTokenException;
use App\Exceptions\AuthException;
use Illuminate\Support\Facades\Auth;

class RedeemVoucherService
{


    /**
     * Variable to hold injected dependency
     *
     * @var redeemVoucherRepository
     */
    private $redeemVoucherRepository;

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
     * @param string $token
     */
    public function findByToken(string $token)
    {
        return $this->redeemVoucherRepository->findByToken($token);
    }

    /**
     * Create a Voucher
     *
     * @param object $data
     */
    public function create(object $data)
    {
        return $this->redeemVoucherRepository->create($data);
    }

    /**
     * Redeem a Voucher
     *
     * @param array $data
     */
    public function redeem(array $data)
    {
        if(Auth::user()->id != $data['user_id'])
            throw new AuthException();

        $voucher = $this->redeemVoucherRepository->findByToken($data['token']);

        if(!$voucher || !$voucher->active)
            throw new InvalidTokenException();

        return $this->redeemVoucherRepository->redeemUpdate($voucher, $data['user_id']);
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
                    'token' => $this->getUniqueToken(),
                    'value' => 100.00
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
        $combinationString = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for($i=0;$i<20;$i++){
            $token .= $combinationString[$this->uniqueSecureHelper(0,strlen($combinationString))];
        }
        return $token;
    }

    /** 
     * This helper function will return unique and secure string...
     */
    public function uniqueSecureHelper($minVal, $maxVal) {
        $range = $maxVal - $minVal;
        if ($range < 0) return $minVal;

        $log = log($range, 2);
        $bytes = (int) ($log/8) + 1;//length in bytes
        $bits = (int) $log + 1;//length in bits
        $filter = (int) (1 << $bits) - 1;//set all lower bits to 1

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter;//discard irrelevant bits
        } while ($rnd >= $range);
        return $minVal + $rnd;
    }
}