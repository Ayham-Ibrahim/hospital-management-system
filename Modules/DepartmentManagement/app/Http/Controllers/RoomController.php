<?php

namespace Modules\DepartmentManagement\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Modules\DepartmentManagement\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\DepartmentManagement\Transformers\Room\RoomResource;
use Modules\DepartmentManagement\Http\Requests\Room\StoreRoomRequest;
use Modules\DepartmentManagement\Http\Requests\Room\UpdateRoomRequest;

class RoomController extends Controller
{
    /**
     * Display a listing of the rooms
     *  using filters according to status and type of room.
     * @return \Illuminate\Http\JsonResponse
     */

    public function index(Request $request)
    {
        $rooms = Room::with('medicalRecords.patient')->when(
            $request->has('status'),
            fn($query) => $query->where('status', $request->input('status'))
        )->when(
            $request->has('type'),
            fn($query) => $query->where('type', $request->input('type'))
                ->paginate(10)
        );

        return $this->paginated(RoomResource::collection($rooms));
    }

    /**
     * Summary of store
     * @param \Modules\DepartmentManagement\Http\Requests\Room\StoreRoomRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->validated());
        return $this->success(new RoomResource($room), "created successfully", 201);
    }

    /**
     * Summary of show
     * @param \Modules\DepartmentManagement\Models\Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Room $room)
    {
        try {
            $room->load(['department', 'medicalRecords.patient']);
            return $this->success(new RoomResource($room));
        } catch (ModelNotFoundException $e) {
            Log::error('room not found' . $e->getmessage());
            throw new Exception("room not found");
        }
    }

    /**
     * Summary of update
     * @param \Modules\DepartmentManagement\Models\Room $rooom
     * @param \Modules\DepartmentManagement\Http\Requests\Room\UpdateRoomRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update(array_filter($request->validated()));
        return $this->success(new RoomResource($room));
    }


    /**
     * Summary of destroy
     * @param \Modules\DepartmentManagement\Models\Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Room $room)
    {
        try {
            $room->delete();
            return $this->success(null, 'room deleted successfully', 200);
        } catch (ModelNotFoundException $e) {
            Log::error('room not found' . $e->getmessage());
            throw new Exception("room not found");
        }
    }
}
