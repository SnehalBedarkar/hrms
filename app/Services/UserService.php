<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function createUser($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'mobile_number' => $data['mobile_number']
        ]);
    }

    public function getUserById($id)
    {
        $employee = User::findOrFail($id);
        return $employee;
    }
}
