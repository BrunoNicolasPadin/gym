<?php

namespace App\Http\Requests\Entrenamientos;

use Illuminate\Foundation\Http\FormRequest;

class EntrenamientoStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dia_rutina_id' => 'required|string|max:36',
        ];
    }
}
