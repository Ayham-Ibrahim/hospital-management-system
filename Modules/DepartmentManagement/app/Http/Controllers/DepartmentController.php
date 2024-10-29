<?php

namespace Modules\DepartmentManagement\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;
use Modules\DepartmentManagement\Models\Department;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\DepartmentManagement\Transformers\Department\DepartmentResource;
use Modules\DepartmentManagement\Http\Requests\Department\StoreDepartmentRequest;
use Modules\DepartmentManagement\Http\Requests\Department\UpdateDepartmentRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DepartmentController extends Controller
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:view departments', only: ['index']),
            new Middleware('permission:add department', only: ['store']),
            new Middleware('permission:view department by id', only: ['show']),
            new Middleware('permission:edit department', only: ['update']),
            new Middleware('permission:delete department', only: ['destroy']),
        ];
    }

    /**
     *  Display a listing of departments with caching and filtering.
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
     *  Store a newly created department.
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
     * Show details of a specific department.
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
     * Update an existing department.
     * @param \Modules\DepartmentManagement\Models\Department $department
     * @param \Modules\DepartmentManagement\Http\Requests\Department\UpdateDepartmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update(array_filter($request->validated()));
        return $this->success(new DepartmentResource($department));
    }


    /**
     * Remove the specified department.
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
