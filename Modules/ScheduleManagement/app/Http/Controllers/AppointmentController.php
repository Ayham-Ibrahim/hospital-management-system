<?php

namespace Modules\ScheduleManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\ScheduleManagement\Models\Appointment;
use Modules\ScheduleManagement\Http\Requests\Appointment\StoreAppointnmentRequest;
use Modules\ScheduleManagement\Http\Requests\Appointment\UpdateAppointnmentRequest;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with([
            'patient:id,name',
            'doctor:id,name'
        ])->select(['id','appointment_date','status'])->paginate(10);
        return $this->paginated($appointments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointnmentRequest $request)
    {
        // create new appointment using validated data
        $appointment = Appointment::create($request->validated());
        //load the patione and doctor 
        $appointment->load(['doctor:id,name','patient:id,name']);
        // get json response
        return $this->success($appointment);
    }

    /**
     * Show the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //load the patione and doctor 
        $appointment->load(['doctor:id,name','patient:id,name']);
        // get json response
        return $this->success($appointment);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointnmentRequest $request,Appointment $appointment)
    {
        
       // update the appointment using validated data
        $appointment->update(array_filter($request->validated()));
        //load the patione and doctor 
        $appointment->load(['doctor:id,name','patient:id,name']);
        // get json response
        return $this->success($appointment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
         $appointment->delete();
         // get json response
         return $this->success(null,'done',200);
    }
}
