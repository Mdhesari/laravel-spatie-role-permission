<?php

namespace Mdhesari\LaravelSpatieRolePermission\Http\Controllers;

use Mdhesari\LaravelSpatieRolePermission\Actions\ApplyRoleQueryFilters;
use Mdhesari\LaravelSpatieRolePermission\Actions\AssignRoleToUsers;
use Mdhesari\LaravelSpatieRolePermission\Actions\CreateRole;
use Mdhesari\LaravelSpatieRolePermission\Actions\DeleteRole;
use Mdhesari\LaravelSpatieRolePermission\Actions\RevokeRoleFromUsers;
use Mdhesari\LaravelSpatieRolePermission\Actions\UpdateRole;
use Mdhesari\LaravelSpatieRolePermission\Events\RoleDeleted;
use Mdhesari\LaravelSpatieRolePermission\Http\Requests\RoleRequest;
use Mdhesari\LaravelSpatieRolePermission\Http\Requests\RoleUserRequest;
use Mdhesari\LaravelSpatieRolePermission\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Mdhesari\LaravelQueryFilters\Actions\ApplyQueryFilters;
use Throwable;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth', 'can:'.get_permission_key(),
        ]);
    }

    /**
     * @param Request $request
     * @param ApplyRoleQueryFilters $applyQueryFilters
     * @return JsonResponse
     * @QAparam s string
     * @QAparam oldest boolean
     * @QAparam user_id integer
     * @QAparam date_from integer
     * @QAparam date_to integer
     */
    public function index(Request $request, ApplyRoleQueryFilters $applyQueryFilters): JsonResponse
    {
        $query = $applyQueryFilters(Role::query(), $request->all());

        return api()->success(null, [
            'items' => $query->paginate(),
        ]);
    }

    /**
     * @param RoleRequest $request
     * @param CreateRole $createRole
     * @return JsonResponse
     */
    public function store(RoleRequest $request, CreateRole $createRole): JsonResponse
    {
        $role = $createRole($request->validated());

        return api()->success(null, [
            'item' => $role,
        ]);
    }

    /**
     * @param RoleRequest $request
     * @param Role $role
     * @param UpdateRole $updateRole
     * @return JsonResponse
     */
    public function update(RoleRequest $request, Role $role, UpdateRole $updateRole): JsonResponse
    {
        $role = $updateRole($role, $request->validated());

        $role->load(['users', 'permissions']);

        return api()->success(null, [
            'item' => $role,
        ]);
    }

    /**
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role): JsonResponse
    {
        $role->load(['users', 'permissions']);

        return api()->success(null, [
            'item' => $role,
        ]);
    }

    /**
     * @param Role $role
     * @param DeleteRole $deleteRole
     * @return JsonResponse
     * @throws ValidationException
     * @throws Throwable
     */
    public function destroy(Role $role, DeleteRole $deleteRole): JsonResponse
    {
        $deleteRole($role);

        return api()->success();
    }

    public function assign(RoleUserRequest $request, Role $role, AssignRoleToUsers $assignRoleToUsers): JsonResponse
    {
        $assignRoleToUsers($role, $request->validated());

        return api()->success(null, [
            'item' => $role->load('users'),
        ]);
    }

    public function revoke(RoleUserRequest $request, Role $role, RevokeRoleFromUsers $revokeRoleFromUsers): JsonResponse
    {
        $revokeRoleFromUsers($role, $request->validated());

        return api()->success(null, [
            'item' => $role->load('users'),
        ]);
    }
}
