<?php

namespace Modules\DoctorManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  Modules\DoctorManagement\Models\Doctor;
use Modules\DoctorManagement\Transformers\DoctorResource;
use Modules\DoctorManagement\Http\Requests\DoctorStoreRequest;
use Modules\DoctorManagement\Http\Requests\DoctorUpdateRequest;

class DoctorManagementController extends Controller
{

    public function index()
    {
        $doctors = Doctor::paginate(10);
        return $this->paginated(DoctorResource::collection($doctors));
    }


    public function store(DoctorStoreRequest $request)
    {
        $doctor = Doctor::create($request->validated());

        if ($request->hasFile('image')) {
            $doctor->image = $request->file('image')->store('doctors', 'public');
            $doctor->save();
        }

        return $this->success(new DoctorResource($doctor), 201);
    }


    public function show(Doctor $doctor)
    {
        $doctor->load('department');
        return $this->success(new DoctorResource($doctor));
    }


    public function update(Doctor $doctor, DoctorUpdateRequest $request)
    {

        $doctor->update($request->validated());
        if ($request->hasFile('image')) {
            $doctor->image = $request->file('image')->store('doctors', 'public');
            $doctor->save();
        }

        return $this->success(new DoctorResource($doctor));
    }


    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return $this->success(['message' => "successfuly deleted"]);
    }
}
