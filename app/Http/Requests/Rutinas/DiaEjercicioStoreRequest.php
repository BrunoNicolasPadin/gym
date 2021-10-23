<?php

namespace App\Http\Requests\Rutinas;

use Illuminate\Foundation\Http\FormRequest;

class DiaEjercicioStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'diaEjercicios.*.ejercicio_id' => 'required|string|max:36',
        ];
    }
}
