<?php

namespace Modules\ScheduleManagement\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use  Modules\ScheduleManagement\Models\SurjicalOperation;
use Modules\ScheduleManagement\Transformers\OperationResource;
use Modules\ScheduleManagement\Http\Requests\Operation\StoreOperationRequest;
use Modules\ScheduleManagement\Http\Requests\Operation\UpdateOperationRequest;

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
     * Summary of store
     * @param \Modules\ScheduleManagement\Http\Requests\Operation\StoreOperationRequest $request
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


    /**
     * Summary of update
     * @param \Modules\ScheduleManagement\Http\Requests\Operation\UpdateOperationRequest $request
     * @param mixed $id
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
