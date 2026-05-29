<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'     => 'required|string|min:2|max:30',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:12|confirmed',
            'password_confirmation' => 'required|same:password',
            'role'     => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            // name
            'name.required' => 'Name is required',
            'name.string' => 'Name must be in string',
            'name.min' => 'Name must be at least 2 characters',
            'name.max' => 'Name must be at most 30 characters',

            // email
            'email.required' => 'Email is required',
            'email.string' => 'Email must be in string',
            'email.email' => 'Email must be a valid email address',
            'email.max' => 'Email must be at most 255 characters',
            'email.unique' => 'Email already exists',

            // password
            'password' => 'Password is required',
            'password.string' => 'Password must be in string',
            'password.min' => 'Password must be at least 6 characters',
            'password.max' => 'Password must be at most 12 characters',
            'password.confirmed' => 'Password confirmation does not match',

            // confirm password
            'password_confirmation.required' => 'Confirm password is required',
            'password_confirmation.same' => 'Confirmed password must match to password',

            // role
            'role.required' => 'Role is required',
        ];
    }
}
