<?php

namespace App\Http\Requests\Rutinas;

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
            'series.*.numero' => 'required|string|max:2',
            'series.*.repeticiones' => 'required|string|max:3',
            'series.*.peso' => 'required|string|max:5',
            'series.*.rpe' => 'nullable|string|max:3',
        ];
    }
}
