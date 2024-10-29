<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\DepartmentManagement\Models\Department;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test department creation
     *
     * @return void
     */
    public function test_department_can_be_created()
    {
        $departmentData = [
            'name' => 'Cardiology',
            'description' => 'Department of Cardiology',
            'phone_number' => '+1234567890'
        ];

        $department = Department::create($departmentData);

        // $this->assertDatabaseHas('departments', [
        //     'name' => $departmentData['name'],
        //     'description' => $departmentData['description'],
        //     'phone_number' => $departmentData['phone_number']
        // ]);

        $this->assertInstanceOf(Department::class, $department);
        $this->assertEquals($departmentData['name'], $department->name);
        $this->assertEquals($departmentData['description'], $department->description);
        $this->assertEquals($departmentData['phone_number'], $department->phone_number);
    }

    /**
     * Test department retrieval
     *
     * @return void
     */
    public function test_department_can_be_retrieved()
    {
        $department = Department::factory()->create();

        $retrievedDepartment = Department::find($department->id);

        $this->assertNotNull($retrievedDepartment);
        $this->assertEquals($department->name, $retrievedDepartment->name);
        $this->assertEquals($department->description, $retrievedDepartment->description);
        $this->assertEquals($department->phone_number, $retrievedDepartment->phone_number);
    }

    /**
     * Test department updating
     *
     * @return void
     */
    public function test_department_can_be_updated()
    {
        $department = Department::factory()->create();

        $updatedData = [
            'name' => 'Neurology',
            'description' => 'Department of Neurology',
            'phone_number' => '+9876543210'
        ];

        $department->update($updatedData);

        // $this->assertDatabaseHas('departments', [
        //     'id' => $department->id,
        //     'name' => $updatedData['name'],
        //     'description' => $updatedData['description'],
        //     'phone_number' => $updatedData['phone_number']
        // ]);

        $this->assertEquals($updatedData['name'], $department->fresh()->name);
        $this->assertEquals($updatedData['description'], $department->fresh()->description);
        $this->assertEquals($updatedData['phone_number'], $department->fresh()->phone_number);
    }

    /**
     * Test department deletion
     *
     * @return void
     */
    public function test_department_can_be_deleted()
    {
        $department = Department::factory()->create();

        // $this->assertDatabaseHas('departments', ['id' => $department->id]);

        $department->delete();

        // $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }
}
