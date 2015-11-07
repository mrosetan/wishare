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
          'firstname' => 'required|min:3|max:50|regex:/^[\pL\s]+$/u',
          'lastname' => 'required|min:2|max:50|regex:/^[\pL\s]+$/u',
          'city' => 'required|min:2|max:50|regex:/^[\pL\s]+$/u',
          'facebook' => 'required|min:3|max:50|',
          'birthdate' => 'required|date',
        ];
    }
}
