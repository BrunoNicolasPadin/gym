<?php

namespace App\Models\Entrenamientos;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class EntrenamientoSerie extends Model
{
    use Uuids;

    protected $table = 'entrenamientos_series';

    protected $fillable = [
        'repeticiones',
        'peso',
        'rpe',
        'rm',
    ];

    public function ejercicioEntrenamiento()
    {
        return $this->belongsTo(EjercicioEntrenamiento::class);
    }
}
