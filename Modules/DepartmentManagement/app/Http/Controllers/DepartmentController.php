<?php

namespace Modules\DepartmentManagement\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Modules\DepartmentManagement\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\DepartmentManagement\Http\Requests\Department\StoreDepartmentRequest;
use Modules\DepartmentManagement\Http\Requests\Department\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deparments = Department::all();
        return ApiResponseService::success($deparments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());
        return ApiResponseService::success($department,"created successfully",201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Department $department)
    {
        try {
            return ApiResponseService::success($department);
        } catch (ModelNotFoundException $e) {
            Log::error('departemt not found'.$e->getmessage());
            throw new Exception("Depatrment not found");
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request,Department $department)
    {
        $department->update(array_filter($request->validated()));
        return ApiResponseService::success($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return ApiResponseService::success(null,'department deleted successfully',200);
        } catch (ModelNotFoundException $e) {
            Log::error('departemt not found'.$e->getmessage());
            throw new Exception("Depatrment not found");
            
        }
    }
}
