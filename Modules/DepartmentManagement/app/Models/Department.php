<?php

namespace Modules\DepartmentManagement\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\DepartmentManagement\Models\Service;
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

  
    /**
     * return rooms that belongs to the department
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms(){
        return $this->hasMany(Room::class);
    }

    /**
     * return services that belongs to the department
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services(){
        return $this->hasMany(Service::class);
    }


    // protected static function newFactory(): DepartmentFactory
    // {
    //     // return DepartmentFactory::new();
    // }
}
