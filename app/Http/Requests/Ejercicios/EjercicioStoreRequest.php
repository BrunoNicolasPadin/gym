<?php

namespace App\Http\Requests\Ejercicios;

use Illuminate\Foundation\Http\FormRequest;

class EjercicioStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'ejercicios.*.nombre' => 'required|string|max:255',
            'ejercicios.*.descripcion' => 'nullable|string|max:1000',
        ];
    }
}
