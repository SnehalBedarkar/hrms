<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $employeeId = $this->route('id');

        return [
            'department_id' => 'required|exists:departments,id',
            'designation_id' => 'required|exists:designations,id',
            'first_name' => 'required|string|max:50',
            'middle_name' => 'nullable|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|string|unique:employees,email,'.$employeeId,
            'mobile_number' => 'required|string|unique:employees,mobile_number,'.$employeeId,
            'password' => $employeeId ? 'nullable|string|min:6|max:12' : 'required|string|min:6|max:12',
            'date_of_birth' => 'required|date|before_or_equal:'.now()->subYears(18)->toDateString(),
            'profile_picture' => 'required|image|mimes:jpg,jpeg,png,webp|max:4048',
            'gender' => 'required|integer',
            'date_of_joining' => 'required|date',
            'exit_date' => 'nullable|date',
        ];
    }
}
