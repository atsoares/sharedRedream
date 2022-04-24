<?php

namespace App\Policies;

use App\Models\User;
use App\Models\RedeemVoucher;
use Illuminate\Auth\Access\HandlesAuthorization;

class RedeemVoucherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given voucher can be redeemed by the user.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\RedeemVoucher $voucher
     * @return bool
     */
    public function redeem(User $user, RedeemVoucher $voucher)
    {
        return $voucher->user_id === $user->id;
    }
}
