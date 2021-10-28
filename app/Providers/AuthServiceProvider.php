<?php

namespace App\Providers;

use App\Models\Ejercicios\Ejercicio;
use App\Models\Entrenamientos\Entrenamiento;
use App\Models\Rutinas\DiaRutina;
use App\Models\Rutinas\Rutina;
use App\Policies\Ejercicios\EjercicioPolicy;
use App\Policies\Entrenamientos\EntrenamientoPolicy;
use App\Policies\Rutinas\RutinaPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Rutina::class => RutinaPolicy::class,
        Ejercicio::class => EjercicioPolicy::class,
        Entrenamiento::class => EntrenamientoPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
