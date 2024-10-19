<?php

namespace Modules\PatientManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\DepartmentManagement\Models\Service;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\PatientManagement\Database\Factories\PatientFactory;

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
    

    /**
     * patient Factory
     * @return \Modules\PatientManagement\Database\Factories\PatientFactory
     */
    protected static function newFactory(): PatientFactory
    {
        return PatientFactory::new();
    }

    /**
     * Summary of services
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'patient_service');
    }

    /**
     * get the patients medical records
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function medicalRecords(): HasMany{
        return $this->hasMany(MedicalRecord::class);
    }
}
