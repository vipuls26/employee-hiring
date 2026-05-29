<?php

namespace App\Http\Requests\employee;

use Illuminate\Foundation\Http\FormRequest;

class ResumeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ];
    }

    public function messages()
    {
        return [
            // resume
            'resume.required' => 'Resume is required',
            'resume.mimes' => 'Resume must be a file of type: pdf, doc, docx',
            'resume.max' => 'Resume must not be greater than 2MB',
        ];
    }
}
