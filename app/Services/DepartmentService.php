<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function create(array $data): Department
    {
        $department = new Department;
        $department->name = $data['name'];
        $department->description = $data['description'] ?? null;
        $department->is_active = $data['status'] ?? 1;
        $department->sort_order = $data['sort_order'] ?? 0;
        $department->save();

        return $department;
    }

    public function getDepartment($id)
    {
        $department = Department::select(
            'id', 'name', 'description',
            'is_active', 'sort_order'
        )->findOrFail($id);

        return $department;
    }

    public function updateDepartment($data, $id)
    {
        $department = Department::findOrFail($id);

        $department->name = $data['name'];
        $department->description = $data['description'];
        $department->is_active = $data['status'];
        $department->sort_order = $data['sort_order'];
        $department->save();

        return $department;

    }

    public function deleteDepartment($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
    }
}
