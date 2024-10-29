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
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoomController extends Controller
{
     /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware('permission:view rooms', only: ['index']),
            new Middleware('permission:add room', only: ['store']),
            new Middleware('permission:view room by id', only: ['show']),
            new Middleware('permission:edit room', only: ['update']),
            new Middleware('permission:delete room', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of rooms with filtering by status and type.
     *  using filters according to status and type of room.
     * @return \Illuminate\Http\JsonResponse
     */

     public function index(Request $request)
	 {
        $rooms = Room::with('medicalRecords.patient')
            ->filter($request)
            ->paginate(10);

        return $this->paginated(RoomResource::collection($rooms));
	 }

    /**
     * Store a newly created room.
     * @param \Modules\DepartmentManagement\Http\Requests\Room\StoreRoomRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->validated());
        return $this->success(new RoomResource($room), "created successfully", 201);
    }

    /**
     * Show details of a specific room.
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
     * Update an existing room.
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
     * Delete a room.
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


    /**
     * list of room for select list
     * @return \Illuminate\Http\JsonResponse
     */
    public function roomList(){
        $rooms = Room::select(['id','room_number'])->get();
        return $this->success($rooms);
    }
}
