<?php

namespace Modules\PatientManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\PatientManagement\Http\Requests\Patient\StorePatientRequest;
use Modules\PatientManagement\Http\Requests\Patient\UpdatePatientRequest;
use Modules\PatientManagement\Transformers\PatientResource;
use Modules\PatientManagement\Http\Requests\Patient\StorePatientServiceRequest;
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


    public function store(StorePatientRequest $request)
    {

        $patient = Patient::create($request->validated());
        return $this->success(new PatientResource($patient), 'Patient created successfully', 201);
    }


    public function show(Patient $patient)
    {
        $patient->load('services');
        return $this->success(new PatientResource($patient));
    }


    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update(array_filter($request->validated()));

        return $this->success(new PatientResource($patient));
    }


    public function destroy(Patient $patient)
    {
        $patient->delete();
        return $this->success(null, 'patient deleted successfully', 200);
    }

    public function storeServices(StorePatientServiceRequest $request, Patient $patient)
    {
        // Attach the selected services to the patient
        $patient->services()->attach($request->validated('service_ids'));

        return $this->success(new PatientResource($patient->load('services')), 'Services added successfully');
    }
}
