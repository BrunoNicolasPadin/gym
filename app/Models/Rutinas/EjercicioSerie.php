<?php

namespace App\Models\Rutinas;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class EjercicioSerie extends Model
{
    use Uuids;

    protected $fillable = [
        'numero',
        'repeticiones',
        'peso',
        'rpe',
    ];

    public function diaEjercicio()
    {
        return $this->belongsTo(diaEjercicio::class);
    }
}
