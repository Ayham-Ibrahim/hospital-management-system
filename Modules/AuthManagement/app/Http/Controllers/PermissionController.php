<?php

namespace Modules\AuthManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Modules\AuthManagement\Http\Requests\Permission\StorePermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = Permission::select(['id','name'])->get();
        return $this->success($permissions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'api',
        ]);

        return $this->success([
            'id' => $permission->id,
            'name' => $permission->name 
        ],'created successfully',201);

    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        //

        return response()->json([]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePermissionRequest $request,Permission $permission)
    {
        $data = $request->only('name');
        $permission->update($data);
        return $this->success([
            'id' => $permission->id,
            'name' => $permission->name 
        ],'updated successfully',200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return $this->success(null,'deleted successfully',200);
    }
}
