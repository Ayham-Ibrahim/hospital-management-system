<?php

namespace Modules\DepartmentManagement\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Illuminate\Support\Facades\Cache;
use Modules\DepartmentManagement\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\DepartmentManagement\Transformers\Service\ServicesResource;
use Modules\DepartmentManagement\Http\Requests\Services\StoreServiceRequest;
use Modules\DepartmentManagement\Http\Requests\Services\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cacheKey = 'services-index-' . md5(json_encode($request->all()));

        $services = Cache::remember($cacheKey,60*60*24, function () use ($request) {
            return Service::when(
                $request->has('name'),
                fn($query) => $query->where('name', 'like', '%' . $request->input('name') . '%')
            )
            ->get();
        });
    
        return $this->success(ServicesResource::collection($services));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->validated());
        return $this->success(new ServicesResource($service), "created successfully", 201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Service $service)
    {
        try {
            $service->load('department');
            return $this->success(new ServicesResource($service));
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
        return $this->success(new ServicesResource($service));
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
