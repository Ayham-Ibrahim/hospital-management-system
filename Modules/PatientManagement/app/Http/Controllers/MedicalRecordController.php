<?php

namespace Modules\PatientManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\PatientManagement\Models\MedicalRecord;
use Modules\PatientManagement\Models\Patient;
use Modules\PatientManagement\Transformers\MedicalRecordResource;
use Modules\PatientManagement\Http\Requests\MedicalRecord\StoreMedicalRecord;
use Modules\PatientManagement\Http\Requests\MedicalRecord\UpdateMedicalRecord;

class MedicalRecordController extends Controller
{
    /**
     * Get a paginated list of medical_records along with their associated patients ,doctors and rooms.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $medicalRecords = MedicalRecord::paginate(10);
        return $this->paginated(MedicalRecordResource::collection($medicalRecords));
    }

    /**
     * Create a new medical_record record.
     * @param \Modules\PatientManagement\Http\Requests\MedicalRecord\StoreMedicalRecord $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreMedicalRecord $request)
    {
        $medicalRecord = MedicalRecord::create($request->validated());
        return $this->success(new MedicalRecordResource($medicalRecord), "created successfully", 201);
    }

    /**
     * Display a single medical_record .
     *
     * @param  \Modules\PatientManagement\Models\MedicalRecord  $medicalrecord
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['doctor', 'room', 'patient']);
        return $this->success(new MedicalRecordResource($medicalRecord));
    }

    /**
     * Update an existing medical_record record.
     * @param \Modules\PatientManagement\Http\Requests\MedicalRecord\UpdateMedicalRecord $request
     * @param \Modules\PatientManagement\Models\MedicalRecord $medicalRecord
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateMedicalRecord $request, MedicalRecord $medicalRecord)
    {
        $data = $request->validated();
        $medicalRecord->update(array_filter($data));
        return $this->success(new MedicalRecordResource($medicalRecord));
    }

    /**
     * Delete a medical_record record.
     *
     * @param  \Modules\PatientManagement\Models\MedicalRecord  $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return $this->success(null, 'medicalRecord deleted successfully', 200);
    }

    /**
     * get the patient records
     * @param \Modules\PatientManagement\Models\Patient $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function patientRecords(Patient $patient)
    {
        $medicalRecords = MedicalRecord::where('patient_id', $patient->id)
            ->with(['doctor:id,name'])
            ->get();

        return $this->success(MedicalRecordResource::collection($medicalRecords));
    }
}
