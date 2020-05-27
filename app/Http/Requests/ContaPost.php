<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContaPost extends FormRequest
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
        //dd($this->id);
        return [
            'nome' =>         ['required','string','max:20', Rule::unique('contas', 'nome')->where($this->id)],
            'descricao' =>    'max:255',
            'saldo_atual' =>  'required|numeric',
            //new rule para o unique do nome de utilizador
        ];
    }
}
