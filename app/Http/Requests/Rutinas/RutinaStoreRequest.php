<?php

namespace App\Http\Requests\Rutinas;

use Illuminate\Foundation\Http\FormRequest;

class RutinaStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:1000',
        ];
    }
}
