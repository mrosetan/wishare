<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SetPasswordRequest extends Request
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
            'username' => 'required|min:3|max:15|alpha_num|unique:wishare_users',
            'password' => 'confirmed|required|min:3|max:30|alpha_num',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least 3 characters.',
            'username.max' => 'Username may not be greater than 15 characters.',
            'username.alpha_num' => 'Username may only contain letters and numbers.',
            'username.unique' => 'Username has already been taken.',

            'password.confirmed' => 'Password confirmation does not match',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 3 characters.',
            'password.max' => 'Password may not be greater than 30 characters.',
            'password.alpha_num' => 'Password may only contain letters and numbers.',
        ];
    }
}
