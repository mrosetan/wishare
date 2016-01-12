<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditAdminRequest extends Request
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
          'lastname' => 'required|min:2|max:50|regex:/^[\pL\s]+$/u',
          'firstname' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
          'username' => 'required|min:3|max:15|alpha_num|unique:wishare_users',
          'password' => 'required|min:3|max:30|alpha_num',
          'email' => 'required|email|unique:wishare_users',
        ];
    }

    public function messages()
    {
        return [
            'lastname.required' => 'Last name is required.',
            'lastname.min' => 'Last name must be at least 2 characters.',
            'lastname.max' => 'Last name may not be greater than 50 characters.',
            'lastname.regex' => 'Last name may only contain letters.',

            'firstname.required' => 'First name is required.',
            'firstname.min' => 'First name must be at least 3 characters.',
            'firstname.max' => 'First name may not be greater than 50 characters.',
            'firstname.regex' => 'First name may only contain letters.',

            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 3 characters.',
            'username.max' => 'Username may not be greater than 15 characters.',
            'username.alpha_num' => 'Username may only contain letters and numbers.',
            'username.unique' => 'Username has already been taken.',

            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 3 characters.',
            'password.max' => 'Password may not be greater than 30 characters.',
            'password.alpha_num' => 'Password may only contain letters and numbers.',

            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email has already been taken.',
        ];
    }
}
