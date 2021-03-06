<?php

namespace App\Services;

use App\Repositories\Impl\TransactionRepositoryInterface;
use App\Exceptions\AuthException;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    /**
     * Variable to hold injected dependency
     *
     * @var transactionRepository
     */
    private $transactionRepository;

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
        if(!Auth::hasUser() || Auth::user()->id != $user_id)
            throw new AuthException();

        return $this->transactionRepository->getAllByUser($user_id);
    }

    /**
     * Get All Supporters By Incident
     *
     * @param int $incident_id
     */
    public function getAllByIncident(int $incident_id)
    {
        if(!Auth::hasUser())
            throw new AuthException();
        return $this->transactionRepository->getAllSupportersByIncident($incident_id);
    }

}