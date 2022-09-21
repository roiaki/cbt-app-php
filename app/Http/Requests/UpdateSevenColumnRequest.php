<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSevenColumnRequest extends FormRequest
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
        // @check 動的フォームのバリデーション
        return  [
            'basis_thinking'         => 'required|max:500',
            'opposite_fact'          => 'required|max:500',
            'new_thinking'           => 'required|max:500',
            'new_emotion_strength00' => 'required'
        ];
    }
}
