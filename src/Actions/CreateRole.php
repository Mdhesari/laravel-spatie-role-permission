<?php

namespace Mdhesari\LaravelSpatieRolePermission\Actions;

use Mdhesari\LaravelSpatieRolePermission\Models\Role;
use Mdhesari\LaravelSpatieRolePermission\Models\User;

class CreateRole
{
    public function __invoke(array $data)
    {
        $role = Role::create([
            'name'       => $data['name'],
            'guard_name' => 'sanctum',
        ]);

        if ( isset($data['permissions']) ) {
            $role->syncPermissions($data['permissions']);
        }

        if ( isset($data['users']) ) {
            $role->users()->sync($data['users']);
        }

        return $role->fresh();
    }
}