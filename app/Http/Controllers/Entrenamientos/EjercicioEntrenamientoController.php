<?php

namespace App\Http\Controllers\Entrenamientos;

use App\Http\Controllers\Controller;
use App\Models\Entrenamientos\EjercicioEntrenamiento;
use App\Models\Entrenamientos\Entrenamiento;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EjercicioEntrenamientoController extends Controller
{
    public function index($entrenamiento_id)
    {
        return Inertia::render('Entrenamientos/Ejercicios/Index', [
            'entrenamiento' => Entrenamiento::findOrFail($entrenamiento_id),
            'ejerciciosEntrenamiento' => EjercicioEntrenamiento::where('entrenamiento_id', $entrenamiento_id)
                ->with('diaEjercicio.ejercicio')
                ->get()
        ]);
    }

    public function destroy($entrenamiento_id, $id)
    {
        EjercicioEntrenamiento::destroy($id);
        return redirect(route('ejercicios-del-entrenamiento.index', $entrenamiento_id))
            ->with(['successMessage' => 'Ejercicio eliminado del entrenamiento con éxito!']);
    }
}