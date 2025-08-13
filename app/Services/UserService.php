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

    public function updateUser($id, $data)
    {
        $user = User::findOrFail($id);
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->mobile_number = $data['mobile_number'];
        $user->save();
    }
}
