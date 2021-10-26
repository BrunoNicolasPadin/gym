<?php

namespace App\Models\Entrenamientos;

use App\Models\Rutinas\DiaEjercicio;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class EjercicioEntrenamiento extends Model
{
    use Uuids;

    protected $table = 'ejercicios_entrenamientos';

    public function diaEjercicio()
    {
        return $this->belongsTo(DiaEjercicio::class);
    }

    public function entrenamiento()
    {
        return $this->belongsTo(Entrenamiento::class);
    }
}
