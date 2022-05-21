<?php

/*
 * Role Permission
 */

use Illuminate\Support\Facades\Route;
use Mdhesari\LaravelSpatieRolePermission\Http\Controllers\PermissionController;
use Mdhesari\LaravelSpatieRolePermission\Http\Controllers\RoleController;

Route::prefix('roles')->name('roles.')->group(function () {
    Route::post('{role}/assign', [RoleController::class, 'assign'])->name('assign');
    Route::post('{role}/revoke', [RoleController::class, 'revoke'])->name('revoke');
});

Route::apiResource('roles', RoleController::class);

Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
