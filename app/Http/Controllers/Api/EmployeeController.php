<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        try {
            $employees = $this->employeeService->getEmployees();

            return response()->json([
                'success' => true,
                'employees' => $employees,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in fetching employees'.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in fetching employees',
            ], 500);
        }
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $data = $request->validated();

            $this->employeeService->createEmployee($data);

            return response()->json([
                'success' => true,
                'message' => 'Employee Added Successfully',
            ], 201);

        } catch (\Throwable $th) {
            Log::error('Error in adding employee'.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in adding employee',
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $employee = $this->employeeService->getEmployee($id);

            return response()->json([
                'success' => true,
                'employee' => $employee,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in fetching employee'.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in fetching employee',
            ], 500);
        }
    }

    public function update(EmployeeRequest $request, int $id)
    {
        $data = $request->validated();
        try {
            $this->employeeService->updateEmployee($id, $data);

            return response()->json([
                'success' => true,
                'message' => 'Employee Updated successfully',
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in updating employee', $th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in updating employee',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->employeeService->deleteEmployee($id);

            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in deleting employee'.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in deleting employee',
            ], 500);
        }
    }

    public function statusToggle($id)
    {
        try {
            $this->employeeService->toggleStatusEmployee($id);

            return response()->json([
                'success' => true,
                'message' => 'Employee Status changed',
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in status changing'.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in status toggle',
            ], 500);
        }
    }
}
