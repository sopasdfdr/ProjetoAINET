<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimentoPost extends FormRequest
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
            'data'       => 'required|date',
            'valor'      => 'required|numeric',
            'tipo'       => 'required',
            'descricao'  => 'nullable|max:250',
            'imagem_doc' => 'nullable',
            'categoria'  => 'nullable|exists:categorias,id'
        ];
    }
}
