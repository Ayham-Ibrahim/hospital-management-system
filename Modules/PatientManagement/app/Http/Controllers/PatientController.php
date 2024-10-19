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
    /**
     * Get a paginated list of patients along with their associated services.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $patients = Patient::with('services')->paginate(10);
        return $this->success(PatientResource::collection($patients));
    }


    /**
     * Create a new patient record.
     * 
     * @param  \Modules\PatientManagement\Http\Requests\Patient\StorePatientRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePatientRequest $request)
    {

        $patient = Patient::create($request->validated());
        return $this->success(new PatientResource($patient), 'Patient created successfully', 201);
    }


    /**
     * Display a single patient along with their associated services.
     * 
     * @param  \Modules\PatientManagement\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Patient $patient)
    {
        $patient->load('services');
        return $this->success(new PatientResource($patient));
    }


    /**
     * Update an existing patient record.
     * 
     * @param  \Modules\PatientManagement\Http\Requests\Patient\UpdatePatientRequest  $request
     * @param  \Modules\PatientManagement\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdatePatientRequest $request, Patient $patient)
    {
        $patient->update(array_filter($request->validated()));
        return $this->success(new PatientResource($patient));
    }


    /**
     * Delete a patient record.
     * 
     * @param  \Modules\PatientManagement\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Patient $patient)
    {
        $patient->delete();
        return $this->success(null, 'patient deleted successfully', 200);
    }


    /**
     *  Sync services to the patient.
     * 
     * @param  \Modules\PatientManagement\Http\Requests\Patient\StorePatientServiceRequest  $request
     * @param  \Modules\PatientManagement\Models\Patient  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeServices(StorePatientServiceRequest $request, Patient $patient)
    {
        // Sync the selected services to the patient
        $patient->services()->sync($request->validated('service_ids'));
        return $this->success(new PatientResource($patient->load('services')), 'Services added successfully');
    }




    // show services for specific patient
}
