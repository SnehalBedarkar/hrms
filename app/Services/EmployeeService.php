<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeService
{
    public function getEmployees()
    {
        return Employee::with([
            'department:id,name',
            'designation:id,name',
        ])
            ->select(
                'id',
                'department_id',
                'designation_id',
                'first_name',
                'last_name',
                'profile_picture',
                'email',
                'mobile_number',
                'status'
            )
            ->where('status', 1)
            ->get();
    }

    public function createEmployee(array $data): Employee
    {
        $employee = new Employee;
        $employee->department_id = $data['department_id'];
        $employee->designation_id = $data['designation_id'];
        $employee->first_name = $data['first_name'];
        $employee->middle_name = $data['middle_name'] ?? null;
        $employee->last_name = $data['last_name'];
        $employee->email = $data['email'];
        $employee->mobile_number = $data['mobile_number'];
        $employee->password = Hash::make($data['password']);
        $employee->date_of_birth = $data['date_of_birth'];
        $employee->gender = $data['gender'];
        $employee->date_of_joining = $data['date_of_joining'];

        if (! empty($data['profile_picture'])) {
            $employee->profile_picture = $data['profile_picture']
                ->store('employees', 'public');
        }

        $employee->save();

        return $employee;
    }

    public function getEmployee(int $id): Employee
    {
        return Employee::with([
            'department:id,name',
            'designation:id,name',
        ])->findOrFail($id);
    }

    public function updateEmployee(int $id, array $data): Employee
    {
        $employee = Employee::findOrFail($id);

        $employee->department_id = $data['department_id'];
        $employee->designation_id = $data['designation_id'];
        $employee->first_name = $data['first_name'];
        $employee->middle_name = $data['middle_name'] ?? null;
        $employee->last_name = $data['last_name'];
        $employee->email = $data['email'];
        $employee->mobile_number = $data['mobile_number'];
        $employee->date_of_birth = $data['date_of_birth'];
        $employee->gender = $data['gender'];
        $employee->date_of_joining = $data['date_of_joining'];

        if (! empty($data['password'])) {
            $employee->password = Hash::make($data['password']);
        }

        if (! empty($data['profile_picture'])) {
            if ($employee->profile_picture) {
                Storage::disk('public')->delete($employee->profile_picture);
            }

            $employee->profile_picture = $data['profile_picture']
                ->store('employees', 'public');
        }

        $employee->save();

        return $employee;
    }

    public function deleteEmployee(int $id): void
    {
        $employee = Employee::findOrFail($id);

        if ($employee->profile_picture) {
            Storage::disk('public')->delete($employee->profile_picture);
        }

        $employee->delete();
    }

    public function toggleStatusEmployee(int $id): void
    {
        $employee = Employee::findOrFail($id);
        $employee->status = ! $employee->status;
        $employee->save();
    }
}
