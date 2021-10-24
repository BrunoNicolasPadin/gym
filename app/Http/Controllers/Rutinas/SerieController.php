<?php

namespace App\Http\Controllers\Rutinas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rutinas\SerieStoreRequest;
use App\Models\Rutinas\DiaEjercicio;
use App\Models\Rutinas\DiaRutina;
use App\Models\Rutinas\EjercicioSerie;
use App\Models\Rutinas\Rutina;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SerieController extends Controller
{
    public function index($rutina_id, $dia_rutina_id, $dia_ejercicio_id)
    {
        return Inertia::render('Rutinas/Series/Index', [
            'rutina' => Rutina::findOrFail($rutina_id),
            'dia' => DiaRutina::findOrFail($dia_rutina_id),
            'diaEjercicio' => DiaEjercicio::with('ejercicio')->findOrFail($dia_ejercicio_id),
            'series' => EjercicioSerie::where('dia_ejercicio_id', $dia_ejercicio_id)->orderBy('numero')->get(),
        ]);
    }

    public function create($rutina_id, $dia_rutina_id, $dia_ejercicio_id)
    {
        return Inertia::render('Rutinas/Series/Create', [
            'rutina' => Rutina::findOrFail($rutina_id),
            'dia' => DiaRutina::findOrFail($dia_rutina_id),
            'diaEjercicio' => DiaEjercicio::with('ejercicio')->findOrFail($dia_ejercicio_id),
        ]);
    }

    public function store(SerieStoreRequest $request, $rutina_id, $dia_rutina_id, $dia_ejercicio_id)
    {
        for ($i = 0; $i < count($request->series); $i++) { 
            $ejercicioSerie = new EjercicioSerie();
            $ejercicioSerie->numero = $request->series[$i]['numero'];
            $ejercicioSerie->repeticiones = $request->series[$i]['repeticiones'];
            $ejercicioSerie->peso = $request->series[$i]['peso'];
            $ejercicioSerie->rpe = $request->series[$i]['rpe'];
            $ejercicioSerie->diaEjercicio()->associate($dia_ejercicio_id);
            $ejercicioSerie->save();
        }

        return redirect(route('series.index', [$rutina_id, $dia_rutina_id, $dia_ejercicio_id]))
            ->with(['successMessage' => 'Series registradas con éxito!']);
    }

    public function edit($rutina_id, $dia_rutina_id, $dia_ejercicio_id, $id)
    {
        return Inertia::render('Rutinas/Series/Edit', [
            'rutina' => Rutina::findOrFail($rutina_id),
            'dia' => DiaRutina::findOrFail($dia_rutina_id),
            'diaEjercicio' => DiaEjercicio::with('ejercicio')->findOrFail($dia_ejercicio_id),
            'serie' => EjercicioSerie::findOrFail($id),
        ]);
    }

    public function update(SerieStoreRequest $request, $rutina_id, $dia_rutina_id, $dia_ejercicio_id, $id)
    {
        $ejercicioSerie = EjercicioSerie::findOrFail($id);
        $ejercicioSerie->numero = $request->numero;
        $ejercicioSerie->repeticiones = $request->repeticiones;
        $ejercicioSerie->peso = $request->peso;
        $ejercicioSerie->rpe = $request->rpe;
        $ejercicioSerie->save();

        return redirect(route('series.index', [$rutina_id, $dia_rutina_id, $dia_ejercicio_id]))
            ->with(['successMessage' => 'Serie actualizada con éxito!']);
    }

    public function destroy($rutina_id, $dia_rutina_id, $dia_ejercicio_id, $id)
    {
        EjercicioSerie::destroy($id);
        return redirect(route('series.index', [$rutina_id, $dia_rutina_id, $dia_ejercicio_id]))
            ->with(['successMessage' => 'Serie eliminada con éxito!']);
    }
}
