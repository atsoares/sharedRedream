<?php

namespace App\Repositories;

use App\Repositories\Impl\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
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
        $this->wallet = new WalletRepository($wallet);
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
     * Find by Email
     *
     * @param string $email
     * @return User
     */
    public function findByEmail(string $email): ?User
    {
        return $this->entity->where('email', $email)->first();
    }

    /**
     * Create a User
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): ?User
    {
        $data['password'] = Hash::make($data['password']);

        $user = $this->entity->create($data);

        $this->wallet->create([
            'user_id' => $user->id,
            'balance' => 0
        ]);

        return $user->fresh();
    }

    /**
     * Update existing User
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data)
    {
        $user = $this->findById($id);

        return $user->update($data);
    }
}