<?php

namespace Modules\DepartmentManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\DepartmentManagement\Database\Factories\DepartmentFactory;

class Department extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'phone_number',    
    ];

    // protected static function newFactory(): DepartmentFactory
    // {
    //     // return DepartmentFactory::new();
    // }
}
