<?php

namespace App\Http\Controllers\Entrenamientos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Entrenamientos\EntrenamientoStoreRequest;
use App\Http\Requests\Entrenamientos\EntrenamientoUpdateRequest;
use App\Models\Entrenamientos\Entrenamiento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EntrenamientoController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Entrenamientos/Index', [
            'entrenamientos' => $this->obtenerEntrenamientos($request),
        ]);
    }

    public function paginarEntrenamientos(Request $request)
    {
        return $this->obtenerEntrenamientos($request);
    }

    public function obtenerEntrenamientos($request)
    {
        return Entrenamiento::with('diaRutina.rutina')
        ->where('user_id', Auth::id())
        ->paginate(20);
    }

    public function store(EntrenamientoStoreRequest $request)
    {
        $entrenamiento = new Entrenamiento();
        $fecha = Carbon::now('America/Argentina/Buenos_Aires');
        $entrenamiento->fecha = $fecha->toDateString();
        $entrenamiento->user()->associate(Auth::id());
        $entrenamiento->diaRutina()->associate($request->dia_rutina_id);
        $entrenamiento->save();

        return redirect(route('entrenamientos.index'))
            ->with(['successMessage' => 'Entrenamiento registrado con éxito!']);
    }

    public function edit($id)
    {
        return Inertia::render('Entrenamientos/Edit', [
            'entrenamiento' => Entrenamiento::findOrFail($id),
        ]);
    }

    public function update(EntrenamientoUpdateRequest $request, $id)
    {
        $entrenamiento = Entrenamiento::findOrFail($id);
        $entrenamiento->fecha = $request->fecha;
        $entrenamiento->save();

        return redirect(route('entrenamientos.index'))
            ->with(['successMessage' => 'Entrenamiento actualizado con éxito!']);
    }

    public function destroy($id)
    {
        Entrenamiento::destroy($id);
        return redirect(route('entrenamientos.index'))
            ->with(['successMessage' => 'Entrenamiento eliminado con éxito!']);
    }
}
