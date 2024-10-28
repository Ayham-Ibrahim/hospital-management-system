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
     * Display a listing of the departments
     *  using cach and filters.
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $cachKey = 'department_index' . md5(json_encode($request->all()));
        $cachedDepartments  = Cache::remember($cachKey, 60 * 60 * 24, function () use ($request) {
            return Department::with(['rooms:id,room_number', 'doctors:id,name'])->when(
                $request->has('name'),
                fn($query) => $query->where('name', 'like', '%' . $request->input('name') . '%')
            )->get();
        });
        return $this->success(DepartmentResource::collection($cachedDepartments));
    }


    /**
     * Summary of store
     * @param \Modules\DepartmentManagement\Http\Requests\Department\StoreDepartmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDepartmentRequest $request)
    {
        $department = Department::create($request->validated());
        $department->select('id', 'name', 'description', 'phone_number');
        return $this->success(new DepartmentResource($department), "created successfully", 201);
    }

    /**
     * Summary of show
     * @param \Modules\DepartmentManagement\Models\Department $department
     * @return \Illuminate\Http\JsonResponse
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
     * Summary of update
     * @param \Modules\DeparmentManagement\Models\Department $department
     * @param \Modules\DepartmentManagement\Http\Requests\Department\UpdateDepartmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update(array_filter($request->validated()));
        return $this->success(new DepartmentResource($department));
    }


    /**
     * Summary of destroy
     * @param \Modules\DepartmentManagement\Models\Department $department
     * @return \Illuminate\Http\JsonResponse
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
