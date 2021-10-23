<?php

namespace App\Models\Rutinas;

use App\Models\Ejercicios\Ejercicio;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class DiaEjercicio extends Model
{
    use Uuids;

    public function dia()
    {
        return $this->belongsTo(DiaRutina::class);
    }

    public function ejercicio()
    {
        return $this->belongsTo(Ejercicio::class);
    }
}
