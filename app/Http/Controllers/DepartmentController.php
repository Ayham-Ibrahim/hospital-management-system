<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\ApiResponseService;
use App\Http\Requests\Department\StoreDepartmentRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\Department\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $department = Department::all();
        return ApiResponseService::success($department);
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
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        try {
            return ApiResponseService::success($department);
        } catch (ModelNotFoundException $e) {
            Log::error('department not found:'. $e->getmessage());
            throw new Exception('department not found.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        try {
            $department->update(array_filter($request->validated()));
            return ApiResponseService::success($department);
        } catch (ModelNotFoundException $e) {
            Log::error('department not found:'. $e->getmessage());
            throw new Exception('department not found.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return ApiResponseService::success(null,"department deleted successfully");
    }
}
