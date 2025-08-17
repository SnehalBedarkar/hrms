<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function index()
    {
        $users = $this->userService->users();

        return Inertia::render('users', [
            'users' => $users
        ]);
    }

    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();
            $this->userService->createUser(($data));

            return response()->json([
                'success' => true,
                'message' => 'Employee Added Succesfully'
            ], 201);
        } catch (\Throwable $th) {
            Log::error('Error in Adding Employee' . $th->getMessage());
            return response()->json([
                'success' => true,
                'error' => 'Error in Adding Employee'
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $employee = $this->userService->getUserById($id);
            return response()->json([
                'success' => true,
                'employee' => $employee
            ]);
        } catch (\Throwable $th) {
            Log::error('Error in Fetching Employee ' . $th->getMessage());
            return redirect()->json([
                'success' => false,
                'error' => "Error in Fetching Employee"
            ]);
        }
    }

    public function update($id){
        
    }
}
