<?php

namespace Modules\DepartmentManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\DepartmentManagement\Models\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\PatientManagement\Models\Patient;
// use Modules\DepartmentManagement\Database\Factories\ServiceFactory;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ["name", "description", "department_id"];

    /**
     *  return department that the service is belongs to it
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function patients()
    {
        return $this->belongsToMany(Patient::class, 'patient_service');
    }

    // protected static function newFactory(): ServiceFactory
    // {
    //     // return ServiceFactory::new();
    // }


}
