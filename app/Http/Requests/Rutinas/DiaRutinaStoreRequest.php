<?php

namespace App\Http\Requests\Rutinas;

use Illuminate\Foundation\Http\FormRequest;

class DiaRutinaStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'dias.*.nombre' => 'required|string|max:255',
        ];
    }
}
