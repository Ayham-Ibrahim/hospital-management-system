<?php

namespace Modules\DepartmentManagement\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\ApiResponseService;
use Modules\DepartmentManagement\Models\Room;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\DepartmentManagement\Http\Requests\Room\StoreRoomRequest;
use Modules\DepartmentManagement\Http\Requests\Room\UpdateRoomRequest;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = Room::all();
        return ApiResponseService::success($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $room = Room::create($request->validated());
        return ApiResponseService::success($room,"created successfully",201);
    }

    /**
     * Show the specified resource.
     */
    public function show(Room $room)
    {
        try {
            return ApiResponseService::success($room);
        } catch (ModelNotFoundException $e) {
            Log::error('room not found'.$e->getmessage());
            throw new Exception("room not found");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request,Room $room)
    {
        $room->update(array_filter($request->validated()));
        return ApiResponseService::success($room);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        try {
            $room->delete();
            return ApiResponseService::success(null,'room deleted successfully',200);
        } catch (ModelNotFoundException $e) {
            Log::error('room not found'.$e->getmessage());
            throw new Exception("room not found");
            
        }
    }
}
