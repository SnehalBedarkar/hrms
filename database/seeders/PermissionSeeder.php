<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // [
            //     'name' => 'Manage Users',
            //     'slug' => 'manage_users',
            //     'group' => 'Users'
            // ],
            [
                'name' => 'View User',
                'slug' => 'view_user',
                'group' => 'Users'
            ]
        ];

        foreach ($permissions as $permission) {
            $permission = Permission::create($permission);
        }
    }
}
