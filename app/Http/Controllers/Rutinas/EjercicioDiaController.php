<?php

namespace App\Http\Controllers\Rutinas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rutinas\DiaEjercicioStoreRequest;
use App\Models\Ejercicios\Ejercicio;
use App\Models\Rutinas\DiaEjercicio;
use App\Models\Rutinas\DiaRutina;
use App\Models\Rutinas\Rutina;
use App\Services\Slugs\SlugService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EjercicioDiaController extends Controller
{
    protected $slugService;

    public function __construct(
        SlugService $slugService,
    )

    {
        $this->slugService = $slugService;
    }

    public function index($rutina_id, $dia_rutina_id)
    {
        return Inertia::render('Rutinas/DiaEjercicios/Index', [
            'rutina' => Rutina::findOrFail($rutina_id),
            'dia' => DiaRutina::findOrFail($dia_rutina_id),
            'diaEjercicios' => DiaEjercicio::where('dia_rutina_id', $dia_rutina_id)
                ->with('ejercicio')
                ->orderBy('created_at')->get(),
        ]);
    }

    public function create($rutina_id, $dia_rutina_id)
    {
        return Inertia::render('Rutinas/DiaEjercicios/Create', [
            'rutina' => Rutina::findOrFail($rutina_id),
            'dia' => DiaRutina::findOrFail($dia_rutina_id),
            'ejercicios' => Ejercicio::where('user_id', Auth::id())->orderBy('nombre')->get(),
        ]);
    }

    public function store(DiaEjercicioStoreRequest $request, $rutina_id, $dia_rutina_id)
    {
        for ($i = 0; $i < count($request->diaEjercicios); $i++) { 
            $diaEjercicio = new DiaEjercicio();
            $diaEjercicio->diaRutina()->associate($dia_rutina_id);
            $diaEjercicio->ejercicio()->associate($request->diaEjercicios[$i]['ejercicio_id']);
            $diaEjercicio->created_at = Carbon::now()->addMinute($i);
            $diaEjercicio->save();
        }

        return redirect(route('ejercicios-del-dia.index', [$rutina_id, $dia_rutina_id]))
            ->with(['successMessage' => 'Ejercicio del dia registrado con éxito!']);
    }

    public function edit($rutina_id, $dia_rutina_id, $id)
    {
        return Inertia::render('Rutinas/DiaEjercicios/Edit', [
            'rutina' => Rutina::findOrFail($rutina_id),
            'dia' => DiaRutina::findOrFail($dia_rutina_id),
            'ejercicios' => Ejercicio::where('user_id', Auth::id())->orderBy('nombre')->get(),
            'diaEjercicio' => DiaEjercicio::findOrFail($id),
        ]);
    }

    public function update(DiaEjercicioStoreRequest $request, $rutina_id, $dia_rutina_id, $id)
    {
        $diaEjercicio = DiaEjercicio::findOrFail($id);
        $diaEjercicio->ejercicio()->associate($request->ejercicio_id);
        $diaEjercicio->save();

        return redirect(route('ejercicios-del-dia.index', [$rutina_id, $dia_rutina_id]))
            ->with(['successMessage' => 'Ejercicio del dia actualizado con éxito!']);
    }

    public function destroy($rutina_id, $dia_rutina_id, $id)
    {
        DiaEjercicio::destroy($id);
        return redirect(route('ejercicios-del-dia.index', [$rutina_id, $dia_rutina_id]))
            ->with(['successMessage' => 'Ejercicio del dia eliminado con éxito!']);
    }
}
