<?php

namespace Modules\DepartmentManagement\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Modules\DepartmentManagement\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\DepartmentManagement\Http\Requests\Services\StoreServiceRequest;
use Modules\DepartmentManagement\Http\Requests\Services\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return $this->success($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->validated());
        return $this->success($service, "created successfully", 201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Service $service)
    {
        try {
            return $this->success($service);
        } catch (ModelNotFoundException $e) {
            Log::error('room not found' . $e->getmessage());
            throw new Exception("room not found");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update(array_filter($request->validated()));
        return $this->success($service);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return $this->success(null, 'service deleted successfully', 200);
        } catch (ModelNotFoundException $e) {
            Log::error('service not found' . $e->getmessage());
            throw new Exception("service not found");
        }
    }
}
