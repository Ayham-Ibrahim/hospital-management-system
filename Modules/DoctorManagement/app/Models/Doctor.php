<?php

namespace Modules\DoctorManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\DoctorManagement\Models\DoctorShift;
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

    // protected static function newFactory(): DoctorFactory
    // {
    //     // return DoctorFactory::new();
    // }
}
