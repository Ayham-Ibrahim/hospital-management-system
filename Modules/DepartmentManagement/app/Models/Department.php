<?php

namespace Modules\DepartmentManagement\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Modules\DoctorManagement\Models\Doctor;
use Modules\DepartmentManagement\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\DepartmentManagement\Database\Factories\DepartmentFactory;

class Department extends Model
{
    use HasFactory,Searchable;
    

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'description',
        'phone_number',
    ];

        /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'rooms:id,room_number',
        'doctors:id,name',
    ];

    
    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return [
            'name' => $this->title,
        ];
    }


    /**
     * return rooms that belongs to the department
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    /**
     * return services that belongs to the department
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }


    /**
     * return doctors that belongs to the department
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    /**
     * Get the number of rooms associated with the department.
     *
     * This accessor returns the total number of rooms that belong to the department.
     *
     * @return int
     */
    public function getRoomCountAttribute()
    {
        return $this->rooms()->count();
    }

    /**
     * Get the number of doctors associated with the department.
     *
     * This accessor returns the total number of doctors that belong to the department.
     *
     * @return int
     */
    public function getDoctorCountAttribute()
    {
        return $this->doctors()->count();
    }

    public function getEmptyRoomCountAttribute()
    {
        return $this->rooms()->where('status', 'vacant')->count();
    }


    // protected static function newFactory(): DepartmentFactory
    // {
    //     // return DepartmentFactory::new();
    // }
}
