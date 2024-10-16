<?php

namespace Modules\PatientManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\PatientManagement\Http\Requests\Patient\storePatientRequest;
use Modules\PatientManagement\Http\Requests\Patient\updatePatientRequest;
use Modules\PatientManagement\Transformers\PatientResource;
use  Modules\DepartmentManagement\Models\Service;
use Modules\PatientManagement\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('services')->paginate(10);
        return $this->success(PatientResource::collection($patients));
    }


    public function store(storePatientRequest $request)
    {

        $patient = Patient::create($request->validated());
        return $this->success(new PatientResource($patient), 'Patient created successfully', 201);
    }


    public function show(Patient $patient)
    {
        $patient->load('services');
        return $this->success(new PatientResource($patient));
    }


    public function update(updatePatientRequest $request, Patient $patient)
    {
        $patient->update($request->validated());

        return $this->success(new PatientResource($patient));
    }


    public function destroy(Patient $patient)
    {
        $patient->delete();
        return $this->success(null, 'patient deleted successfully', 200);
    }
}
