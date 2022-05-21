<?php

namespace Mdhesari\LaravelSpatieRolePermission\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Mdhesari\LaravelSpatieRolePermission\Models\Permission;
use Illuminate\Http\Request;
use Mdhesari\LaravelQueryFilters\Actions\ApplyQueryFilters;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum', 'can:'.config('laravel-spatie-role-permission::permission_key'),
        ]);
    }

    /**
     * @param Request $request
     * @param ApplyQueryFilters $applyQueryFilters
     * @return JsonResponse
     */
    public function index(Request $request, ApplyQueryFilters $applyQueryFilters): JsonResponse
    {
        $permissions = $applyQueryFilters(Permission::query(), $request->all());

        return api()->success(null, [
            'items' => $permissions->paginate(),
        ]);
    }
}
