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
    public function medicalRecords(): HasMany
    {
        return $this->hasMany(MedicalRecord::class);
    }

    /**
     * Scope a query to filter patients by name and admission date.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $request)
    {
        return $query->when(
            $request->has('name'),
            fn($query) => $query->where('name', 'like', '%' . $request->input('name') . '%')
        )->when(
            $request->has('admission_date'),
            fn($query) => $query->whereHas('medicalRecords', function ($query) use ($request) {
                $query->where('admission_date', $request->input('admission_date'));
            })
        );
    }
}
