<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    /**
     * Grant all abilities to administrator.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if (session('statut') === 'admin') {
            return true;
        }
    }

}
