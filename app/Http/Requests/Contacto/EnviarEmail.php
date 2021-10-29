<?php

namespace App\Http\Requests\Contacto;

use Illuminate\Foundation\Http\FormRequest;

class EnviarEmail extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'asunto' => 'required|string',
            'mensaje' => 'required|string',
        ];
    }
}
