<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailPost extends FormRequest
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
            'email' => 'required|email',
            'so_leitura' => 'required|in:0,1'
        ];
    }
}
