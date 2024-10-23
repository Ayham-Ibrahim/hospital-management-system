<?php

namespace Modules\ScheduleManagement\Http\Controllers;


use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use  Modules\ScheduleManagement\Models\SurjicalOperation;
use Modules\ScheduleManagement\Transformers\OperationResource;
use Modules\ScheduleManagement\Http\Requests\Operation\StoreOperationRequest;
use Modules\ScheduleManagement\Http\Requests\Operation\UpdateOperationRequest;
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
     * Summary of store
     * @param \Modules\ScheduleManagement\Http\Requests\Operation\StoreOperationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOperationRequest $request)
    {

        $operation = SurjicalOperation::create($request->validated());

        // Validate and retrieve the data from the request
        $data = $request->validated();
        $operation = SurjicalOperation::create($data);

        // If doctor IDs are provided, attach the doctors to the operation
        if($data['doctor_ids']){
            $operation->doctors()->attach($data['doctor_ids']);
        }

        return $this->success(new OperationResource($operation));
    }
    

    public function show(SurjicalOperation $surjical_operation)
    {
        $surjical_operation->load(['patient','doctor','room']);
        return $this->success(new OperationResource($surjical_operation));
    }


    /**
     * Summary of update
     * @param \Modules\ScheduleManagement\Http\Requests\Operation\UpdateOperationRequest $request
     * @param  \Modules\ScheduleManagement\Models\SurjicalOperation  $surjical_operation
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateOperationRequest $request, SurjicalOperation $surjical_operation)
    {
        // Validate and retrieve the data from the request
        $data = $request->validated();

        // Validate the request data
        $surjical_operation->update(array_filter($request->validated()));

         // If doctor IDs are provided, attach the doctors to the surjical_operation
         if($data['doctor_ids']){
            $surjical_operation->doctors()->sync($data['doctor_ids']);
        }

        return $this->success(new OperationResource($surjical_operation));
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
