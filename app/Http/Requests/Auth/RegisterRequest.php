<?php

namespace App\Http\Requests\Auth;


use Illuminate\Foundation\Http\FormRequest;
use Override;

class RegisterRequest extends FormRequest
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
            'name'     => 'required|string|min:2|max:30',
            'email'    => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|max:12|confirmed',
            'password_confirmation' => 'required|same:password',
            'role'     => 'required|string',
        ];
    }

    #[Override]
    public function messages()
    {
        return [
            // name
            'name.required' => 'name is required',
            'name.string' => 'name must be in string',
            'name.min' => 'name must be at least 2 characters',
            'name.max' => 'name must be at most 30 characters',

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
            'password.confirmed' => 'password confirmation does not match',

            'password_confirmation.required' => 'confirm password is required',
            'password_confirmation.same' => 'confirmed password must match to password',

            // role
            'role.required' => 'role is required',
        ];
    }
}
