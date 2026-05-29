<?php

namespace App\Http\Requests\job;

use Illuminate\Foundation\Http\FormRequest;

class ApproveRejectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'action' => 'in:accept,reject',
            'reason' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            // accept or reject action
            'action.in' => 'Action Should be accept or reject',
            // reason
            'reason.string' => 'Reason must be a string',
            'reason.max' => 'Reason must not exceed 255 characters',
        ];
    }
}
