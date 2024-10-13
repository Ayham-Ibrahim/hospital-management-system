<?php

namespace Modules\DepartmentManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\DepartmentManagement\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\DepartmentManagement\Database\Factories\RoomFactory;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'room_number',
        'status',
        'type',
        'beds_number',
        'department_id',
    ];

    
    /**
     *  return department that the room is belongs to it
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(){
        return $this->belongsTo(Department::class);
    }
}
