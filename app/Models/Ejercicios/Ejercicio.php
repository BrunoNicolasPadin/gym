<?php

namespace App\Models\Ejercicios;

use App\Models\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{
    use Uuids;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
