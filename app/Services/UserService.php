<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    public function users()
    {
        $users = User::select('id', 'name', 'mobile_number', 'email')->get();
        return $users;
    }

    public function createUser($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'mobile_number' => $data['mobile_number']
        ]);

        $roles = $data['roles'];
        dd($roles);
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

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->deleted_by = auth()->id();
        $user->delete();
        $user->save();
    }
}
