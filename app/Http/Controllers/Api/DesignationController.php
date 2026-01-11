<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DesignationRequest;
use App\Models\Designation;
use App\Services\DesignationService;
use Illuminate\Support\Facades\Log;

class DesignationController extends Controller
{
    protected DesignationService $designationService;

    public function __construct(DesignationService $designationService)
    {
        $this->designationService = $designationService;
    }

    public function index()
    {
        $designations = Designation::select(
            'id', 'name', 'department_id', 'code', 'is_active', 'sort_order'
        )->with('department')->get();

        return response()->json([
            'success' => true,
            'designations' => $designations,
        ], 200);
    }

    public function store(DesignationRequest $request)
    {
        try {
            $data = $request->validated();
            $this->designationService->createDesignation($data);

            return response()->json([
                'success' => true,
                'message' => 'Designation added successfully',
            ], 200);
        } catch (\Throwable $th) {
            $error = 'Error in adding designation';
            Log::error($error.': '.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => $error,
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $designation = $this->designationService->getDesignationById($id);

            return response()->json([
                'success' => true,
                'designation' => $designation,
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in fetching designation: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in fetching designation',
            ], 500);
        }
    }

    public function update(DesignationRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $this->designationService->updateDesignation($id, $data);

            return response()->json([
                'success' => true,
                'message' => 'Designation updated successfully',
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in updating designation: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in updating designation',
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->designationService->deleteDesignation($id);

            return response()->json([
                'success' => true,
                'message' => 'Designation deleted successfully',
            ], 200);
        } catch (\Throwable $th) {
            Log::error('Error in deleting designation: '.$th->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error in deleting designation',
            ], 500);
        }
    }
}
