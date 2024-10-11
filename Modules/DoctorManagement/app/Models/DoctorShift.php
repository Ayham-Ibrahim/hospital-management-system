<?php

namespace Modules\DoctorManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\DoctorManagement\Database\Factories\DoctorShiftFactory;

class DoctorShift extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'doctor_id',
        'date',
        'start_shift',
        'end_shift',
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // protected static function newFactory(): DoctorShiftFactory
    // {
    //     // return DoctorShiftFactory::new();
    // }
}
