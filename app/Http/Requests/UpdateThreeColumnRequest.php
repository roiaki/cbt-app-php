<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateThreeColumnRequest extends FormRequest
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
            'emotion_name'       => 'required',
            'emotion_name.*'     => 'required|max:10',
            'emotion_strength'   => 'required',
            'emotion_strength.*' => 'required|int',
            'thinking'           => 'required|max:500'
        ];
    }
}
