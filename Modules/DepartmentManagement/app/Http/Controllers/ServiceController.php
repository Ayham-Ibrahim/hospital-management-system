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
     * Display a listing of services with caching and filtering by name.
     *  using filters according to name and use caching.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $cacheKey = 'services-index-' . md5(json_encode($request->all()));

        $services = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($request) {
            return Service::when(
                $request->has('name'),
                fn($query) => $query->where('name', 'like', '%' . $request->input('name') . '%')
            )
                ->get();
        });

        return $this->success(ServicesResource::collection($services));
    }

    /**
     * Store a newly created service.
     * @param \Modules\DepartmentManagement\Http\Requests\Services\StoreServiceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->validated());
        return $this->success(new ServicesResource($service), "created successfully", 201);
    }

    /**
     * Show details of a specific service.
     * @param \Modules\DepartmentManagement\Models\Service $room
     * @return \Illuminate\Http\JsonResponse
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
     * Update an existing service.
     * @param \Modules\DepartmentManagement\Models\Service $service
     * @param \Modules\DepartmentManagement\Http\Requests\Services\UpdateServiceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update(array_filter($request->validated()));
        return $this->success(new ServicesResource($service));
    }

    /**
     * Delete a service.
     * @param \Modules\DepartmentManagement\Models\Service $service
     * @return \Illuminate\Http\JsonResponse
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
