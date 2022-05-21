<?php

namespace Mdhesari\LaravelSpatieRolePermission\Actions;

use Mdhesari\LaravelSpatieRolePermission\Events\RoleDeleted;
use Mdhesari\LaravelSpatieRolePermission\Models\Role;
use Illuminate\Validation\ValidationException;

class DeleteRole
{
    /**
     * @throws \Throwable
     * @throws ValidationException
     */
    public function __invoke(Role $role)
    {
        if ( $role->users()->count() > 0 ) {
            throw ValidationException::withMessages([
                'role' => __('validation.role-conflict', [
                    'attribute' => 'role',
                ]),
            ]);
        }

        $role->deleteOrFail();

        event(new RoleDeleted($role));
    }
}