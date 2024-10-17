<?php

namespace Modules\PatientManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\DoctorManagement\Models\Doctor;
use Modules\DepartmentManagement\Models\Room;
use Modules\PatientManagement\Models\Patient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\PatientManagement\Database\Factories\MedicalRecordFactory;

class MedicalRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'room_id',
        'blood_type',
        'admission_date',
        'discharge_date',
        'medicines',
        'details',
        // 'type',
    ];

    public function casts() {
        return [
            'medicines' => 'array',
        ];
    }


    /**
     * get the patient who own the record
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }


    /**
     * the room that contain the patient who own this record
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }


    /**
     * the doctor who resposible of this patient
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }


    // protected static function newFactory(): MedicalRecordFactory
    // {
    //     // return MedicalRecordFactory::new();
    // }
}
