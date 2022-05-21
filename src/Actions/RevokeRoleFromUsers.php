<?php

namespace Mdhesari\LaravelSpatieRolePermission\Actions;

use Mdhesari\LaravelSpatieRolePermission\Models\Role;

class RevokeRoleFromUsers
{
    public function __invoke(Role $role, array $data)
    {
        foreach (get_user_model()->whereIn('id', $data['users'])->cursor() as $user) {
            $user->removeRole($role);
        }
    }
}
