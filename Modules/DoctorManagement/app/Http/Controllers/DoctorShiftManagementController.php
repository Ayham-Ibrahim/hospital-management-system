<?php

namespace Modules\DoctorManagement\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\DoctorManagement\Models\Doctor;
use Modules\DoctorManagement\Models\DoctorShift;
use Modules\DoctorManagement\Http\Requests\DoctorShiftStoreRequest;
use Modules\DoctorManagement\Http\Requests\DoctorShiftUpdateRequest;
use Illuminate\Http\Request;

class DoctorShiftManagementController extends Controller
{
    /**
     * Display a listing of the DoctorShifts.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $doctorShifts = DoctorShift::with('doctor')->get();
        return $this->success([$doctorShifts]);
    }

    /**
     * Summary of store
     * @param \Modules\DoctorManagement\Http\Requests\DoctorShiftStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function store(DoctorShiftStoreRequest $request)
    {
        $doctorShift = DoctorShift::create($request->validated());
        return $this->success([$doctorShift], 201);
    }

    /**
     * Summary of show
     * @param \Modules\DoctorManagement\Models\DoctorShift $doctorshift
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(DoctorShift $doctorShift)
    {
        return $this->success([$doctorShift]);
    }

    /**
     * Summary of update
     * @param \Modules\DoctorManagement\Models\DoctorShift $doctorshift
     * @param \Modules\DoctorManagement\Http\Requests\DoctorShiftUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function update(DoctorShiftUpdateRequest $request, DoctorShift $doctorShift)
    {

        $doctorShift->update($request->validated());
        return response()->json($doctorShift);
    }


    /**
     * Summary of destroy
     * @param \Modules\DoctorManagement\Models\DoctorShift $doctorshift
     * @return \Illuminate\Http\JsonResponse
     */

    public function destroy(DoctorShift $doctorShift)
    {
        $doctorShift->delete();
        return $this->success(['message' => 'Doctor shift deleted successfully']);
    }
}
