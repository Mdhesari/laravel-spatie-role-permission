<?php

namespace Mdhesari\LaravelSpatieRolePermission\Actions;

use Mdhesari\LaravelSpatieRolePermission\Models\Role;
use Mdhesari\LaravelSpatieRolePermission\Models\User;

class AssignRoleToUsers
{
    public function __invoke(Role $role, array $data)
    {
        foreach (User::whereIn('id', $data['users'])->cursor() as $user) {
            $user->assignRole($role);
        }
    }
}
