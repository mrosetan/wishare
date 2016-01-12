<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GrantWishRequest extends Request
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
            'grantedimageurl' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'grantedimageurl.image'  => 'File to be uploaded must be an image file (jpeg, png, bmp, gif, or svg).',
        ];
    }
}
