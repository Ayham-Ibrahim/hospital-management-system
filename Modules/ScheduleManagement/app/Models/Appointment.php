<?php

namespace Modules\ScheduleManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\DoctorManagement\Models\Doctor;
use Modules\PatientManagement\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\ScheduleManagement\Database\Factories\AppointmentFactory;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['patient_id','doctor_id','appointment_date','status'];


     /**
     * get the patient who own the appointment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }


       /**
     * the doctor who resposible of this appointment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    
    // protected static function newFactory(): AppointmentFactory
    // {
    //     // return AppointmentFactory::new();
    // }
}
