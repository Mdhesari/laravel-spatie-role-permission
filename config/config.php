<?php

/*
 * You can place your custom package configuration in here.
 */

use Mdhesari\LaravelSpatieRolePermission\Models\User;

return [
    'permission_key' => 'roles',
    'guard_name'     => 'sanctum',
    'user_model'     => User::class,
];