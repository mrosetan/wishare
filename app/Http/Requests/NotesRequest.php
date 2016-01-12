<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NotesRequest extends Request
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
            'message' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'message.required'  => 'Please add the content of your note.',
            'message.max'  => 'Your note must not be greater than 255 characters.',
        ];
    }
}
