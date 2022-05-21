<?php

namespace Mdhesari\LaravelSpatieRolePermission\Actions;

use Mdhesari\LaravelSpatieRolePermission\Events\RoleUpdated;
use Mdhesari\LaravelSpatieRolePermission\Models\Role;

class UpdateRole
{
    public function __invoke(Role $role, array $data): ?Role
    {
        if ( isset($data['name']) ) {
            $role->updateOrFail([
                'name' => $data['name'],
            ]);
        }

        if ( isset($data['permissions']) ) {
            $role->syncPermissions($data['permissions']);
        }

        if ( isset($data['users']) ) {
            $role->users()->sync($data['users']);
        }

        event(new RoleUpdated($role));

        return $role->fresh();
    }
}