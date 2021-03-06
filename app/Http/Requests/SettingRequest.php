<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class SettingRequest extends Request
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
          'imageurl'  => 'image',
          'firstname' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
          'lastname'  => 'required|min:2|max:50|regex:/^[\pL\s]+$/u',
          'city'      => 'min:2|max:50|regex:/^[\pL\s]+$/u',
          'username'  => 'min:2|max:15|alpha_num|unique:wishare_users',
          'email'     => 'email|unique:wishare_users',
          'facebook'  => 'min:3|max:50|',
          'birthdate' => 'date|before:tomorrow|date_format:Y-m-d',
        ];
    }
}
