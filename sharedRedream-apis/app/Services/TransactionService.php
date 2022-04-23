<?php

namespace App\Services;

use App\Repositories\Impl\TransactionRepositoryInterface;

class TransactionService
{
    /**
     * Variable to hold injected dependency
     *
     * @var transactionRepository
     */
    protected $transactionRepository;

    /**
     * Constructor
     *
     * @param TransactionRepositoryInterface $transactionRepository
     */
    public function __construct(TransactionRepositoryInterface $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    /**
     * Get All by Users
     *
     * @param int $user_id
     */
    public function getAllByUser(int $user_id)
    {
        return $this->transactionRepository->getAllByUser($user_id);
    }

}