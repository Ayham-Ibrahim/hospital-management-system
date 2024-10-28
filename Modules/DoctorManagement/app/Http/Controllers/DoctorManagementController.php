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
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // $query = Doctor::query();
        $doctors = Doctor::when(
            $request->has('specialty'),
            fn($query) => $query->where('specialty', $request->input('specialty'))
        )->paginate(10);
        return $this->paginated(DoctorResource::collection($doctors));
    }


    /**
     * Create a new doctor with optional image upload.
     * @param \Modules\DoctorManagement\Http\Requests\DoctorStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DoctorStoreRequest $request)
    {
        $doctor = Doctor::create($request->validated());

        if ($request->hasFile('image')) {
            $doctor->image = $request->file('image')->store('doctors', 'public');
            $doctor->save();
        }

        return $this->success(new DoctorResource($doctor), 201);
    }

    /**
     * Show details of a specific doctor.
     * @param \Modules\DoctorManagement\Models\Doctor $doctor
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Doctor $doctor)
    {
        $doctor->load('department');
        return $this->success(new DoctorResource($doctor));
    }

    /**
     * Update an existing doctor with optional image upload.
     * @param \Modules\DoctorManagement\Models\Doctor $doctor
     * @param \Modules\DoctorManagement\Http\Requests\DoctorUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DoctorUpdateRequest $request,Doctor $doctor)
    {

        $doctor->update($request->validated());
        if ($request->hasFile('image')) {
            $doctor->image = $request->file('image')->store('doctors', 'public');
            $doctor->save();
        }

        return $this->success(new DoctorResource($doctor));
    }

    /**
     * Remove the specified doctor.
     * @param \Modules\DoctorManagement\Models\Doctor $doctor
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return $this->success(['message' => "successfuly deleted"]);
    }
}
