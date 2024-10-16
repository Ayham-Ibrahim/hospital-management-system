<?php

namespace Modules\DoctorManagement\Models;

use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\DoctorManagement\Models\DoctorShift;
use Modules\DepartmentManagement\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\DoctorManagement\Database\Factories\DoctorFactory;
use Modules\PatientManagement\Models\MedicalRecord;
// use Modules\DoctorManagement\Database\Factories\DoctorFactory;

class Doctor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'speciality',
        'image',
        'department_id',
        'mobile_number',
        'job_date',
        'address',
        'salary',
    ];

    /**
     * get the doctor's shifts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shifts()
    {
        return $this->hasMany(DoctorShift::class);
    }

    /**
     * Get the medical records that the doctor manages
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    /**
     *  return department that the doctor is belongs to it
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department(){
        return $this->belongsTo(Department::class);
    }

    // protected static function newFactory(): DoctorFactory
    // {
    //     return DoctorFactory::new();
    // }

   

}
