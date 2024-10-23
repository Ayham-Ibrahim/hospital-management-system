<?php

namespace Modules\DepartmentManagement\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Modules\DepartmentManagement\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\DepartmentManagement\Transformers\Department\DepartmentResource;
use Modules\DepartmentManagement\Http\Requests\Department\StoreDepartmentRequest;
use Modules\DepartmentManagement\Http\Requests\Department\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // Start with the base query
        $query = Department::with(['rooms', 'doctors']);

        // Apply filters based on request parameters
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('empty_rooms')) {
            $emptyRoomCount = $request->input('empty_rooms');
            $query->whereHas('rooms', function ($q) use ($emptyRoomCount) {
                $q->where('status', 'empty')->havingRaw('COUNT(*) >= ?', [$emptyRoomCount]);
            });
        }

        // Paginate the results
        $departments = $query->paginate(10);

        return $this->paginated(DepartmentResource::collection($departments));
        // $departments = Department::with(['rooms','doctors'])->paginate(10);
        // return $this->paginated(DepartmentResource::collection($departments));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());
        $department->select('id', 'name', 'description', 'phone_number');
        return $this->success(new DepartmentResource($department), "created successfully", 201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Department $department)
    {
        try {
            return $this->success(new DepartmentResource($department));
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
        return $this->success(new DepartmentResource($department));
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
