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

    public function index()
    {
        $doctorShifts = DoctorShift::with('doctor')->get();
        return $this->success([$doctorShifts]);
    }

    public function store(DoctorShiftStoreRequest $request)
    {
        $doctorShift = DoctorShift::create($request->validated());
        return $this->success([$doctorShift], 201);
    }

    public function show(DoctorShift $doctorShift)
    {
        return $this->success([$doctorShift]);
    }

    public function update(DoctorShiftUpdateRequest $request, DoctorShift $doctorShift)
    {

        $doctorShift->update($request->validated());
        return response()->json($doctorShift);
    }

    public function destroy(DoctorShift $doctorShift)
    {

        $doctorShift->delete();
        return $this->success(['message' => 'Doctor shift deleted successfully']);
    }
}
