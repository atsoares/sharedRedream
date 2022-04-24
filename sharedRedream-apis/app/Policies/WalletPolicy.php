<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Auth\Access\HandlesAuthorization;

class WalletPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given wallet balance can be viewed by the user.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Wallet $wallet
     * @return bool
     */
    public function balance(User $user, Wallet $wallet)
    {
        return $user->id === $wallet->user_id;
    }
}
