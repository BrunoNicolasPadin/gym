<?php

namespace App\Models\Entrenamientos;

use App\Models\Rutinas\DiaRutina;
use App\Models\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    use Uuids;

    protected $fillable = [
        'fecha',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function diaRutina()
    {
        return $this->belongsTo(DiaRutina::class);
    }
}
