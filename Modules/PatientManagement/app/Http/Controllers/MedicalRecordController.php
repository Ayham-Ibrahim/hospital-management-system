<?php

namespace Modules\PatientManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\PatientManagement\Models\MedicalRecord;
use Modules\PatientManagement\Http\Requests\MedicalRecordRequest;
use Modules\PatientManagement\Models\Patient;
use Modules\PatientManagement\Transformers\MedicalRecordResource;
use Modules\PatientManagement\Http\Requests\MedicalRecord\StoreMedicalRecord;
use Modules\PatientManagement\Http\Requests\MedicalRecord\UpdateMedicalRecord;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicalRecords = MedicalRecord::paginate(10);
        return $this->paginated(MedicalRecordResource::collection($medicalRecords));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMedicalRecord $request)
    {
        $medicalRecord = MedicalRecord::create($request->validated());
        return $this->success(new MedicalRecordResource($medicalRecord), "created successfully", 201);
    }

    /**
     * Show the specified resource.
     */
    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load(['doctor','room','patient']);
        return $this->success( new MedicalRecordResource($medicalRecord));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicalRecord $request, MedicalRecord $medicalRecord)
    {
        $data = $request->validated();
        $medicalRecord->update(array_filter($data));
        return $this->success(new MedicalRecordResource($medicalRecord));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return $this->success( null, 'medicalRecord deleted successfully', 200);

    }

    /**
     * get the patient records 
     * @param \Modules\PatientManagement\Models\Patient $patient
     * @return \Illuminate\Http\JsonResponse
     */
    public function patientRecords(Patient $patient){

        // TODO :  id and name the doctor 
        $medicalRecords = MedicalRecord::where('patient_id',$patient->id)
            ->with(['doctor:id,name'])
            ->get();

     return $this->success( MedicalRecordResource::collection($medicalRecords));
    }
}
