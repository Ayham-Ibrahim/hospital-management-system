<?php

namespace Modules\DepartmentManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\DepartmentManagement\Models\Department;
use Modules\PatientManagement\Models\MedicalRecord;
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
    public function department()
    {
        return $this->belongsTo(Department::class);
    }



    /**
     * Get the medical records that the room contains
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    /**
     * Scope to filter rooms by status and type if present in the request.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $request)
    {
        return $query->when(
            $request->has('status'),
            fn($query) => $query->where('status', $request->input('status'))
        )
        ->when(
            $request->has('type'),
            fn($query) => $query->where('type', $request->input('type'))
        );
    }
}
