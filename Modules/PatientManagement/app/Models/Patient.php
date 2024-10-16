<?php

namespace Modules\PatientManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\PatientManagement\Database\Factories\PatientFactory;
use Modules\DepartmentManagement\Models\Service;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'birth_date',
        'gender',
        'medical_description',
        'address',
        'mobile_number'
    ];

    protected static function newFactory(): PatientFactory
    {
        return PatientFactory::new();
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'patient_services');
    }
}
