<?php

namespace App\Http\Controllers\Entrenamientos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Entrenamientos\SerieStoreRequest;
use App\Models\Entrenamientos\EjercicioEntrenamiento;
use App\Models\Entrenamientos\Entrenamiento;
use App\Models\Entrenamientos\EntrenamientoSerie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EntrenamientoSerieController extends Controller
{
    public function index($entrenamiento_id, $ejercicio_entrenamiento_id)
    {
        return Inertia::render('Entrenamientos/Series/Index', [
            'entrenamiento' => Entrenamiento::findOrFail($entrenamiento_id),
            'ejercicioEntrenamiento' => EjercicioEntrenamiento::with('diaEjercicio.ejercicio')
                ->findOrFail($ejercicio_entrenamiento_id),
            'series' => EntrenamientoSerie::where('ejercicio_entrenamiento_id', $ejercicio_entrenamiento_id)->orderBy('created_at')->get(),
        ]);
    }

    public function store(SerieStoreRequest $request, $entrenamiento_id, $ejercicio_entrenamiento_id)
    {
        $serie = new EntrenamientoSerie();
        $serie->repeticiones = $request->repeticiones;
        $serie->peso = $request->peso;
        $serie->rpe = $request->rpe;
        $serie->rm = $request->rm;
        $serie->ejercicioEntrenamiento()->associate($ejercicio_entrenamiento_id);
        $serie->save();

        return redirect(route('series.index', [$entrenamiento_id, $ejercicio_entrenamiento_id]))
            ->with(['successMessage' => 'Serie agreada con éxito!']);
    }

    public function edit($entrenamiento_id, $ejercicio_entrenamiento_id, $id)
    {
        return Inertia::render('Entrenamientos/Series/Edit', [
            'entrenamiento' => Entrenamiento::findOrFail($entrenamiento_id),
            'ejercicioEntrenamiento' => EjercicioEntrenamiento::with('diaEjercicio.ejercicio')
                ->findOrFail($ejercicio_entrenamiento_id),
            'serie' => EntrenamientoSerie::findOrFail($id),
        ]);
    }

    public function update(Request $request, $entrenamiento_id, $ejercicio_entrenamiento_id, $id)
    {
        $serie = EntrenamientoSerie::findOrFail($id);
        $serie->repeticiones = $request->repeticiones;
        $serie->peso = $request->peso;
        $serie->rpe = $request->rpe;
        $serie->rm = $request->rm;
        $serie->save();

        return redirect(route('series.index', [$entrenamiento_id, $ejercicio_entrenamiento_id]))
            ->with(['successMessage' => 'Serie actualizada con éxito!']);
    }

    public function destroy($entrenamiento_id, $ejercicio_entrenamiento_id, $id)
    {
        EntrenamientoSerie::destroy($id);
        return redirect(route('series.index', [$entrenamiento_id, $ejercicio_entrenamiento_id]))
            ->with(['successMessage' => 'Serie eliminada con éxito!']);
    }
}
