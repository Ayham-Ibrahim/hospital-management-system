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
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
class PatientController extends Controller
{
     /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:view patients', only: ['index']),
            new Middleware('permission:add patient', only: ['store']),
            new Middleware('permission:view patient by id', only: ['show']),
            new Middleware('permission:edit patient', only: ['update']),
            new Middleware('permission:delete patient', only: ['destroy']),
        ];
    }

    /**
     * Get a paginated list of patients along with their associated services.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $patients = Patient::with('services')
            ->filter($request)
            ->paginate(10);
        return $this->paginated(PatientResource::collection($patients));
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


    /**
     * list of patients for select list
     * @return \Illuminate\Http\JsonResponse
     */
    public function patientList(){
        $patients = Patient::select(['id','name'])->get();
        return $this->success($patients);
    }

    // show services for specific patient
}
