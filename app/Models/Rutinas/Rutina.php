<?php

namespace App\Models\Rutinas;

use App\Models\User;
use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Rutina extends Model
{
    use Uuids;

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
