<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DefaultWishlistRequest extends Request
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
            'title' => 'required|min:2|max:20',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Default wishlist title is required.',
            'title.min' => 'Default wishlist title must be at least 2 characters.',
            'title.max' => 'Default wishlist title may not be greater than 20 characters.',
        ];
    }
}
