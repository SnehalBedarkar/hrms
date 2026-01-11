<?php

namespace App\Services;

use App\Models\Designation;

class DesignationService
{
    /**
     * Create a new designation.
     */
    public function createDesignation(array $data): void
    {
        $designation = new Designation;
        $designation->department_id = $data['department_id'];
        $designation->name = $data['name'];
        $designation->code = $data['code'] ?? null;
        $designation->is_active = $data['is_active'] ?? 1;
        $designation->sort_order = $data['sort_order'] ?? 0;
        $designation->save();
    }

    /**
     * Get a designation by ID.
     */
    public function getDesignationById(int $id): Designation
    {
        return Designation::select(
            'id', 'department_id', 'name', 'code', 'is_active', 'sort_order'
        )->findOrFail($id);
    }

    /**
     * Update an existing designation.
     */
    public function updateDesignation(int $id, array $data): void
    {
        $designation = Designation::findOrFail($id);
        $designation->department_id = $data['department_id'];
        $designation->name = $data['name'];
        $designation->code = $data['code'] ?? $designation->code;
        $designation->is_active = $data['is_active'] ?? $designation->is_active;
        $designation->sort_order = $data['sort_order'] ?? $designation->sort_order;
        $designation->save();
    }

    /**
     * Delete a designation by ID.
     */
    public function deleteDesignation(int $id): void
    {
        $designation = Designation::findOrFail($id);
        $designation->delete();
    }
}
