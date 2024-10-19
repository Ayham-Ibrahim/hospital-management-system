<?php

namespace Modules\ScheduleManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use  Modules\ScheduleManagement\Models\SurjicalOperation;
use Modules\ScheduleManagement\Transformers\OperationResource;
use Modules\ScheduleManagement\Http\Requests\Operation\StoreOperationRequest;
use Modules\ScheduleManagement\Http\Requests\Operation\UpdateOperationRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class SurjicalOperationController extends Controller
{

    /**
     * Get a paginated list of SurjicalOperation.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $operations = SurjicalOperation::paginate(10);
        return $this->paginated(OperationResource::collection($operations));
    }


    /**
     * Create a new SurjicalOperation record.
     *
     * @param  \Modules\ScheduleManagement\Http\Requests\StoreOperationtRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOperationRequest $request)
    {
        $operation = SurjicalOperation::create($request->validated());
        return $this->success(new OperationResource($operation));
    }


    /**
     * Display a single SurjicalOperation along .
     *
     * @param  \Modules\ScheduleManagement\Models\SurjicalOperation  $operation
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        Log::info('Incoming ID:', ['id' => $id]);
        $operation = SurjicalOperation::find($id);
        return $this->success(new OperationResource($operation));
    }

    // public function show(SurjicalOperation $operation)
    // {
    //     return $this->success(new OperationResource($operation));
    // }


    /**
     * Update an existing  SurjicalOperation.
     *
     * @param  \Modules\ScheduleManagement\Http\Requests\UpdateOperationRequest  $request
     * @param  \Modules\PatientManagement\Models\SurjicalOperation  $operation
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateOperationRequest $request, $id)
    {

        // Find the surgical operation by ID
        $operation = SurjicalOperation::find($id);

        // Validate the request data
        $operation->update(array_filter($request->validated()));

        return $this->success(new OperationResource($operation));
    }


    /**
     * Delete a SurjicalOperation record.
     *
     * @param  \Modules\ScheduleManagement\Models\SurjicalOperation  $operation
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(SurjicalOperation $operation)
    {
        $operation->delete();
        return $this->success(null, 'SurjicalOperation deleted successfully', 200);
    }
}
