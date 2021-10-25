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
            'diaEjercicios.*.series' => 'nullable|string|max:50',
            'diaEjercicios.*.repeticiones' => 'nullable|string|max:50',
            'diaEjercicios.*.peso' => 'nullable|string|max:50',
            'diaEjercicios.*.rpe' => 'nullable|string|max:50',
            'diaEjercicios.*.cadencia' => 'nullable|string|max:50',
            'diaEjercicios.*.descanso' => 'nullable|string|max:50',
        ];
    }
}
