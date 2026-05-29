<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCompany extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:5|max:25|unique:company,name',
            'email' => 'required|email|unique:company,email',
            'phone' => 'required|numeric|digits:10|unique:company,phone',
            'website' => 'required|unique:company,website',
            'description' => 'required|max:250',
            'location' => 'required|min:3|max:25'
        ];
    }


    public function messages()
    {
        return [
            // company name
            'name.required' => 'Company name required',
            'name.string' => 'Company name must be a string',
            'name.min' => 'Company name must be at least 5 characters',
            'name.max' => 'Company name must be less than 25 characters',
            'name.unique' => 'Company name already exists',

            // company email
            'email.required' => 'Company email required',
            'email.email' => 'Company email must be a valid email address',
            'email.unique' => 'Company email already exists',

            // phone
            'phone.required' => 'Company phone number required',
            'phone.numeric' => 'Company phone number must be numeric',
            'phone.digits' => 'Company phone number must be 10 digits',
            'phone.unique' => 'Company phone number already exists',

            // website
            'website.required' => 'Company website required',
            'website.unique' => 'Company website already exists',

            // description
            'description.required' => 'Company description required',
            'description.max' => 'Company description must be less than 250 characters',

            // location
            'location.required' => 'Company location required',
            'location.min' => 'Company location must be at least 3 characters',
            'location.max' => 'Company location must be less than 25 characters',
        ];
    }
}
