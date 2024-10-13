<?php

namespace Modules\DoctorManagement\Models;

use App\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\DoctorManagement\Models\DoctorShift;
use Modules\DepartmentManagement\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\DoctorManagement\Database\Factories\DoctorFactory;
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

    public function shifts()
    {
        return $this->hasMany(DoctorShift::class);
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
