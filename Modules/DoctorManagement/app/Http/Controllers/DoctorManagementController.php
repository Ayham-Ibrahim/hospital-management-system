<?php

namespace Modules\DoctorManagement\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use  Modules\DoctorManagement\Models\Doctor;
use Modules\DoctorManagement\Transformers\DoctorResource;
use Modules\DoctorManagement\Http\Requests\DoctorStoreRequest;
use Modules\DoctorManagement\Http\Requests\DoctorUpdateRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class DoctorManagementController extends Controller
{
    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:view doctors', only: ['index']),
            new Middleware('permission:add doctor', only: ['store']),
            new Middleware('permission:view doctor by id', only: ['show']),
            new Middleware('permission:edit doctor', only: ['update']),
            new Middleware('permission:delete doctor', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $cacheKey = 'doctors-index-' . md5(json_encode($request->all()));

        $doctors = Cache::remember($cacheKey, 60 * 60 * 24, function () use ($request) {
            return Doctor::when(
                    $request->has('specialty'),
                    fn($query) => $query->filterBySpecialty($request->input('specialty'))
                )
                ->paginate(10);
        });
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
