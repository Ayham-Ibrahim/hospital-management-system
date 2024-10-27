<?php

namespace Modules\AuthManagement\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Modules\AuthManagement\Http\Requests\Roles\RoleRequest;
use Modules\AuthManagement\Http\Requests\Roles\UpdateRoleRequest;

class RoleController extends Controller
{
     /**
     * __construct of BookController
     */
    // public function __construct()
    // {
    //     $this->middleware(['permission:view roles'])->only( 'index');
    //     $this->middleware(['permission:add role'])->only('store');
    //     $this->middleware(['permission:edit role'])->only('update');
    //     $this->middleware(['permission:view role by id'])->only('show');
    //     $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::select(['id','name'])->get();
        return $this->success($roles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'guard_name' =>'api'
        ]);
       
        if ($request->input('permissions')) {
            // Retrieve the permissions by their IDs
            $permissions = Permission::whereIn('id', $request->input('permissions'))->get();
            // Sync the role with the permission models
            $role->syncPermissions($permissions);
        }
        return $this->success([
            'id' => $role->id,
            'name' => $role->name, 
        ],'created successfully',201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Role $role)
    {
        $role->load('permissions');
        return $this->success($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request,Role $role)
    {
        $data = $request->validated();
        $role->update($data);
        if ($request->input('permissions')) {
            // Retrieve the permissions by their IDs
            $permissions = Permission::whereIn('id', $request->input('permissions'))->get();
            // Sync the role with the permission models
            $role->syncPermissions($permissions);
        }
        return $this->success([
            'id' => $role->id,
            'name' => $role->name,
            'permission' => $role->permissions, 
        ],'updated successfully',201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'Role deleted']);
    }
}
