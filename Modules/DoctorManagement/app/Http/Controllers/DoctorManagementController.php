<?php

namespace Modules\DoctorManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use  Modules\DoctorManagement\Models\Doctor;
use Modules\DoctorManagement\Traits\HttpResponses;
use Modules\DoctorManagement\Http\Requests\DoctorStoreRequest;
use Modules\DoctorManagement\Http\Requests\DoctorUpdateRequest;

class DoctorManagementController extends Controller
{
    use HttpResponses;

    public function index()
    {
        $doctors = Doctor::all();
        return $this->success(['data' => $doctors]);
    }


    public function store(DoctorStoreRequest $request)
    {
        $doctor = Doctor::create($request->validated());

        if ($request->hasFile('image')) {
            $doctor->image = $request->file('image')->store('public/doctors');
            $doctor->save();
        }

        return $this->success(['data' => $doctor], 201);
    }


    public function show(Doctor $doctor)
    {
        return $this->success(['data' => $doctor]);
    }


    public function update(Doctor $doctor, DoctorUpdateRequest $request)
    {

        $doctor->update($request->validated());
        if ($request->hasFile('image')) {
            $doctor->image = $request->file('image')->store('public/doctors');
            $doctor->save();
        }

        return $this->success(['data' => $doctor]);
    }


    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return $this->success(['message' => "successfuly deleted"]);
    }
}
