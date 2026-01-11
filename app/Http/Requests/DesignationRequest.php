<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DesignationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        if ($this->filled('name')) {
            $this->merge([
                'slug' => Str::slug($this->name),
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $designationId = $this->route('id');

        return [
            'department_id' => 'required|integer|exists:departments,id',
            'name' => 'required|string|max:50',
            'slug' => [
                'required',
                'string',
                'max:50',
                Rule::unique('designations', 'slug')
                    ->ignore($designationId)
                    ->where(function ($query) {
                        $query->where('department_id', request('department_id'));
                    }),
            ],
            'code' => 'nullable|string|max:10',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ];

    }
}
