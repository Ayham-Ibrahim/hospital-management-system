<?php

namespace Modules\ScheduleManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\DepartmentManagement\Models\Room;
use Modules\DoctorManagement\Models\Doctor;
use Modules\PatientManagement\Models\Patient;
// use Modules\ScheduleManagement\Database\Factories\SurjicalOperationFactory;

class SurjicalOperation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'operation_name',
        'patient_id',
        'doctor_id',
        'room_id',
        'team',
        'duration',
        'schedule_date',
    ];

    protected $casts = [
        'team' => 'array',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_surjical_operation');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }



    // protected static function newFactory(): SurjicalOperationFactory
    // {
    //     // return SurjicalOperationFactory::new();
    // }
}
