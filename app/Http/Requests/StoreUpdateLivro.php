<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateLivro extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'titulo'=>'required | max:100 | min:3',
            'isbn' => 'required | max:13 | min:10',
            'ano' => 'required | Integer',
            'idioma' => 'required | min:5',
            'editora_id'=>'required'
        ];
    }
}
