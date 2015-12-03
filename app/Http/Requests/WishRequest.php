<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class WishRequest extends Request
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
        $currentDate = date('Y-m-d');
        return [
            'title'    => '',
            'due_date' => 'required|after:yesterday',
            'wishimageurl' => 'image',
        ];

    }
}
