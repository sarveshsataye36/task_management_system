<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'fname'=>'required',
            'email'=> 'required|email|unique:users,email',
            'password'=>'required',
            'mobile'=>'required|numeric|unique:users,mobile',
            'cnf_pass'=>'required|same:password',
            'role'=>'required',
        ];
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'fname.required' => 'First name is required',
            'email.required' => 'EmailID is required',
            'mobile.required' => 'Mobile is required',
            'password.required' => 'Password is required',
            'cnf_pass.required' => 'Confirm password is required',
            'role.required' => 'Select a role',
        ];
    }
}
