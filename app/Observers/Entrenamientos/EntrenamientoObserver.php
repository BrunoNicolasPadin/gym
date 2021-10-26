<?php

namespace App\Observers\Entrenamientos;

use App\Models\Entrenamientos\Entrenamiento;
use App\Models\Rutinas\DiaEjercicio;

class EntrenamientoObserver
{
    public function created(Entrenamiento $entrenamiento)
    {
        $diaEjercicios = DiaEjercicio::select('id')->where('dia_rutina_id', $entrenamiento->dia_rutina_id)->get();

        foreach ($diaEjercicios as $diaEjercicio) {
            # code...
        }
    }

    /**
     * Handle the Entrenamiento "updated" event.
     *
     * @param  \App\Models\Entrenamientos\Entrenamiento  $entrenamiento
     * @return void
     */
    public function updated(Entrenamiento $entrenamiento)
    {
        //
    }

    /**
     * Handle the Entrenamiento "deleted" event.
     *
     * @param  \App\Models\Entrenamientos\Entrenamiento  $entrenamiento
     * @return void
     */
    public function deleted(Entrenamiento $entrenamiento)
    {
        //
    }

    /**
     * Handle the Entrenamiento "restored" event.
     *
     * @param  \App\Models\Entrenamientos\Entrenamiento  $entrenamiento
     * @return void
     */
    public function restored(Entrenamiento $entrenamiento)
    {
        //
    }

    /**
     * Handle the Entrenamiento "force deleted" event.
     *
     * @param  \App\Models\Entrenamientos\Entrenamiento  $entrenamiento
     * @return void
     */
    public function forceDeleted(Entrenamiento $entrenamiento)
    {
        //
    }
}
