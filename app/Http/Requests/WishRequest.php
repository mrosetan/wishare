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
        return [
            'title'    => 'required|max:30',
            'due_date' => 'sometimes|after:yesterday',
            'wishimageurl' => 'image',
        ];

    }

    public function messages()
    {
        return [
            'title.required' => 'Wish title is required.',
            'title.max' => 'Wish title must not exceed 30 characters.',
            'due_date.required'  => 'Please add the date of when you would like to get this wish.',
            'due_date.after'  => 'Due date must not be before today.',
            'wishimageurl.image'  => 'File to be uploaded must be an image file (jpeg, png, bmp, gif, or svg).',
        ];
    }
}
