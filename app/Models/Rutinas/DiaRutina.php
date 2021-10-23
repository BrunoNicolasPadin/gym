<?php

namespace App\Models\Rutinas;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class DiaRutina extends Model
{
    use Uuids;

    protected $fillable = [
        'nombre',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function rutina()
    {
        return $this->belongsTo(Rutina::class);
    }
}
