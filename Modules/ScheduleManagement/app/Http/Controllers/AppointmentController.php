<?php

namespace Modules\ScheduleManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\ScheduleManagement\Models\Appointment;
use Modules\ScheduleManagement\Http\Requests\Appointment\StoreAppointnmentRequest;
use Modules\ScheduleManagement\Http\Requests\Appointment\UpdateAppointnmentRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AppointmentController extends Controller
{
   
     /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:view appointments', only: ['index']),
            new Middleware('permission:add appointment', only: ['store']),
            new Middleware('permission:view appointment by id', only: ['show']),
            new Middleware('permission:edit appointment', only: ['update']),
            new Middleware('permission:delete appointment', only: ['destroy']),
        ];
    }

    /**
     * Get a paginated list of appointments.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $appointments = Appointment::with([
            'patient:id,name',
            'doctor:id,name'
        ])->select(['id', 'appointment_date', 'status'])->paginate(10);
        return $this->paginated($appointments);
    }

    /**
     * Summary of store
     * @param \Modules\ScheduleManagement\Http\Requests\Appointment\StoreAppointnmentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreAppointnmentRequest $request)
    {
        // create new appointment using validated data
        $appointment = Appointment::create($request->validated());
        //load the patione and doctor
        $appointment->load(['doctor:id,name', 'patient:id,name']);
        // get json response
        return $this->success($appointment);
    }


    /**
     * Display a single appointment .
     *
     * @param  \Modules\ScheduleManagement\Models\Appointment  $appointment
     * @return \Illuminate\Http\JsonResponse
     */

    public function show(Appointment $appointment)
    {
        //load the patione and doctor
        $appointment->load(['doctor:id,name', 'patient:id,name']);
        // get json response
        return $this->success($appointment);
    }

    /**
     * Update an existing  Appointment.
     *
     * @param  \Modules\ScheduleManagement\Http\Requests\Appointment\UpdateAppointnmentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAppointnmentRequest $request, Appointment $appointment)
    {

        // update the appointment using validated data
        $appointment->update(array_filter($request->validated()));
        //load the patione and doctor
        $appointment->load(['doctor:id,name', 'patient:id,name']);
        // get json response
        return $this->success($appointment);
    }

    /**
     * Delete a appointment record.
     *
     * @param  \Modules\ScheduleManagement\Models\Appointment  $operation
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        // get json response
        return $this->success(null, 'done', 200);
    }
}
