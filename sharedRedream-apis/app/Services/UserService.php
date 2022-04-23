<?php

namespace App\Services;

use App\Repositories\Impl\UserRepositoryInterface;

class UserService
{
    /**
     * Variable to hold injected dependency
     *
     * @var userRepository
     */
    private $userRepository;

    /**
     * Constructor
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Create a User
     *
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->userRepository->create($data);
        return response()->json(['message' => 'User Created'], 201);
    }

    /**
     * Update a User
     *
     * @param array $data
     */
    public function update(array $data)
    {
        return $this->userRepository->update($data);
        return response()->json(['message' => 'User Updated'], 200);
    }
   
}