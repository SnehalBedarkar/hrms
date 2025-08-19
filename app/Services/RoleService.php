<?php

namespace App\Services;

use App\Models\Role;

class RoleService
{
    public function addRole($data)
    {
        $role = new Role();
        $role->name = $data['name'];
        $role->slug = $data['slug'];
        $role->group = $data['group'];
        $role->description = $data['description'] ?? null;

        $permissions = 
    }

    // public function editRole($id){
    // }
}
