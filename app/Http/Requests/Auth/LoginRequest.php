<?php

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => 'required|string|email|max:255',
            'password' => 'required|string|min:6|max:12',
        ];
    }


    public function messages()
    {
        return [

            // email
            'email.required' => 'email is required',
            'email.string' => 'email must be in string',
            'email.email' => 'email must be a valid email address',
            'email.max' => 'email must be at most 255 characters',
            'email.unique' => 'email already exists',

            // password
            'password' => 'password is required',
            'password.string' => 'password must be in string',
            'password.min' => 'password must be at least 6 characters',
            'password.max' => 'password must be at most 12 characters',
        ];
    }
}
