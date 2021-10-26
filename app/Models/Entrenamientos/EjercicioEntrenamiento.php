<?php

namespace App\Models\Entrenamientos;

use App\Models\Ejercicios\Ejercicio;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class EjercicioEntrenamiento extends Model
{
    use Uuids;

    protected $table = 'ejercicios_entrenamientos';

    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class);
    }

    public function entrenamiento()
    {
        return $this->belongsTo(Entrenamiento::class);
    }
}
