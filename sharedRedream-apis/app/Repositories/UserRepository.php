<?php

namespace App\Repositories;

use App\Repositories\Impl\UserRepositoryInterface;
use App\Models\User;
use App\Models\Wallet;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Variable to hold injected dependency
     *
     * @var entity
     */
    protected $entity;

    /**
     * Variable to hold injected dependency
     *
     * @var wallet
     */
    protected $wallet;

    /**
     * Constructor
     *
     * @param User $user
     * @param Wallet $wallet
     */
    public function __construct(User $user, Wallet $wallet)
    {
        $this->entity = $user;
        $this->waller = $wallet;
    }

    /**
     * Find by Id
     *
     * @param int $id
     * @return User
     */
    public function findById(int $id): ?User
    {
        return $this->entity->findOrFail($id);
    }

    /**
     * Create a User
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): ?User
    {
        $user = $this->entity->create($data);

        $w = new Wallet([
            'user_id' => $user->id,
            'balance' => 0
        ]);
        $w->save();

        return $user->fresh();
    }

    /**
     * Update existing User
     *
     * @param int $id
     * @param array $data
     * @return User
     */
    public function update(int $id, array $data): ?User
    {
        $user = $this->findById($id);

        return $user->update($data);
    }
}