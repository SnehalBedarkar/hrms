<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest;
use App\Services\DepartmentService;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    protected DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function store(DepartmentRequest $request)
    {
        try {
            $data = $request->validated();

            $this->departmentService->create($data);

            return response()->json([
                'success' => true,
                'message' => 'Department Added Successfully',
            ], 200);

        } catch (\Throwable $th) {
            Log::error('Error in adding department'.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in adding department',
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $department = $this->departmentService->getDepartment($id);

            return response()->json([
                'success' => true,
                'department' => $department,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in fetching department'.$th->getMessage());

            return response()->json([
                'success' => false,
                'department',
            ], 500);
        }
    }

    public function update(DepartmentRequest $request, $id)
    {
        $data = $request->validated();

        try {
            $this->departmentService->updateDepartment($data, $id);

            return response()->json([
                'success' => true,
                'message' => 'Department Updated Successfully',
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in updating department'.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in updating department',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->departmentService->deleteDepartment($id);

            return response()->json([
                'success' => true,
                'message' => 'Department Deleted Successfully',
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in deleting department'.$th->getMessage());

            return response()->json([
                'success' => false,
                'error ' => 'Error in deleting department',
            ], 500);
        }
    }
}
