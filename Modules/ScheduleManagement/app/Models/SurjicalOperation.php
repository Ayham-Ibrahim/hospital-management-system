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


    /**
     *  patient who have the operation 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * doctor who is the cef of the opertaion
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * surjecal room of the operation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function room()
    {
        return $this->belongsTo(Room::class);
    }



    /**
     * The doctors involved in the surgical operation.
     *
     * This defines a many-to-many relationship between the surgical operation
     * and doctors, utilizing a pivot table named 'doctor_surjical_operation'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function doctors()
    {
        return $this->belongsToMany(Doctor::class, 'doctor_surjical_operation');
    }



    // protected static function newFactory(): SurjicalOperationFactory
    // {
    //     // return SurjicalOperationFactory::new();
    // }
}
