<?php

namespace App\Http\Requests\job;

use Illuminate\Foundation\Http\FormRequest;

class AddJobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:30',
            'salary' => 'required|numeric',
            'type' => 'required',
        ];
    }


    public function messages()
    {
        return [
            // name
            'name.required' => 'Job title required',
            'name.string' => 'Job title must be a string',
            'name.min' => 'Job title must be at least 3 characters',
            'name.max' => 'Job title must not exceed 30 characters',

            // salary
            'salary.required' => 'Salary required',
            'salary.numeric' => 'Salary must be a number',

            // type
            'type.required' => 'Job type required',
        ];
    }
}
