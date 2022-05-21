<?php

namespace Mdhesari\LaravelSpatieRolePermission;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mdhesari\LaravelSpatieRolePermission\Skeleton\SkeletonClass
 */
class LaravelSpatieRolePermissionFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-spatie-role-permission';
    }
}
