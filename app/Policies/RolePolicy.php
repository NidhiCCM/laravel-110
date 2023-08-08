<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Role $rolesCRUD)
    {
        return $rolesCRUD->user_id === $user->id;
    }
}