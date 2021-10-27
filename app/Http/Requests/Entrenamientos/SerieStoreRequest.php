<?php

namespace App\Http\Requests\Entrenamientos;

use Illuminate\Foundation\Http\FormRequest;

class SerieStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'repeticiones' => 'required|string|max:3',
            'peso' => 'required|string|max:6',
            'rpe' => 'nullable|string|max:5',
            'rm' => 'nullable|string|max:5',
        ];
    }
}
