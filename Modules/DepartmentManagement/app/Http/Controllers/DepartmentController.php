<?php

namespace Modules\DepartmentManagement\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Modules\DepartmentManagement\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\DepartmentManagement\Http\Requests\Department\UpdateDepartmentRequest;
use Modules\DepartmentManagement\Http\Requests\Department\StoreDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $deparments = Department::all();
        return $this->success($deparments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());
        return $this->success($department, "created successfully", 201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Department $department)
    {
        try {
            return $this->success($department);
        } catch (ModelNotFoundException $e) {
            Log::error('departemt not found' . $e->getmessage());
            throw new Exception("Depatrment not found");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update(array_filter($request->validated()));
        return $this->success($department);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return $this->success(null, 'department deleted successfully', 200);
        } catch (ModelNotFoundException $e) {
            Log::error('departemt not found' . $e->getmessage());
            throw new Exception("Depatrment not found");
        }
    }
}
