<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SignUpValidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:3|max:255',
            'last_name' => 'required|min:3|max:255',
            'password' => 'required|min:3',
            // 'password' => 'required|min:3|confirmed',
            'email' => 'required|unique:users,email',
        ];
    }

    public function message()
    {
        return [
            'first_name.required' => 'First Name is required.',
            'first_name.min' => 'First Name must be at least three characters long.',
            'first_name.max' => 'First Name must be at least three characters long.',
            'last_name.required' => 'Last Name is required.',
            'last_name.min' => 'Last Name must be at least three characters long.',
            'last_name.max' => 'Last Name must be at least three characters long.',
            'password.required' => 'Email is required.',
            'password.min' => 'Email must be more than 3 characters long.',
            'email.required' => 'Email is required.',
            'email.email_address' => 'Not in an email address format.',
            'email.unique' => 'Email has already been registered.'
        ];

    }
}
