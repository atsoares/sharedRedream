<?php

namespace App\Services;

use App\Repositories\Impl\WalletRepositoryInterface;

class WalletService
{
    /**
     * Variable to hold injected dependency
     *
     * @var walletRepository
     */
    private $walletRepository;

    /**
     * Constructor
     *
     * @param WalletRepositoryInterface $walletRepository
     */
    public function __construct(WalletRepositoryInterface $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }

    /**
     * Get the wallet balance value from user
     *
     * @param int $user_id
     */
    public function balance(int $user_id)
    {
        return $this->walletRepository->findByUserId($user_id);
    }

}