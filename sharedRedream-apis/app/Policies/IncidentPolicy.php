<?php

namespace App\Policies;

use App\Models\Incident;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IncidentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given incident can be refund by the user.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Incident $incident
     * @return bool
     */
    public function refund(User $user, Incident $incident)
    {
        return $user->id === $incident->user_id;
    }

    /**
     * Determine if the given incident can be supported by the user.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Incident $incident
     * @return bool
     */
    public function support(User $user, Incident $incident)
    {
        return $user->id !== $incident->user_id;
    }
}
