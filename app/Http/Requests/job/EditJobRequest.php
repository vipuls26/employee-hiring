<?php

namespace App\Http\Requests\job;

use Illuminate\Foundation\Http\FormRequest;

class EditJobRequest extends FormRequest
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
            'type' => 'required|in:full-time,part-time,hybrid,internship',
            'status' => 'required|in:active,inActive'
        ];
    }

    public function messages()
    {
        return [
            // job name
            'name.required' => 'Job name is required',
            'name.string' => 'Job title must be a string',
            'name.min' => 'Job title must be at least 3 characters',
            'name.max' => 'Job title must not exceed 30 characters',

            // salary
            'salary.required' => 'Salary is required',
            'salary.numeric' => 'Salary must be a number',

            // type
            'type.required' => 'Job type is required',
            'type.in' => 'Job type must be one of: full-time, part-time, hybrid, internship',

            // status
            'status.required' => 'Job status is required',
            'status.in' => 'Job status must be either active or inactive',
        ];
    }
}
