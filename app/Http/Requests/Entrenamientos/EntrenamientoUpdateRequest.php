<?php

namespace App\Http\Requests\Entrenamientos;

use Illuminate\Foundation\Http\FormRequest;

class EntrenamientoUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'fecha' => 'required|string|max:10',
        ];
    }
}
