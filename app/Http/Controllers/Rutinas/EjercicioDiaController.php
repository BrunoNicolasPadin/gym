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
        $rutina = Rutina::findOrFail($rutina_id);
        $this->authorize('viewAny', $rutina);

        return Inertia::render('Rutinas/DiaEjercicios/Index', [
            'rutina' => $rutina,
            'dia' => DiaRutina::findOrFail($dia_rutina_id),
            'diaEjercicios' => DiaEjercicio::where('dia_rutina_id', $dia_rutina_id)
                ->with('ejercicio')
                ->orderBy('created_at')->get(),
        ]);
    }

    public function create($rutina_id, $dia_rutina_id)
    {
        $rutina = Rutina::findOrFail($rutina_id);
        $this->authorize('create', $rutina);
    
        return Inertia::render('Rutinas/DiaEjercicios/Create', [
            'rutina' => $rutina,
            'dia' => DiaRutina::findOrFail($dia_rutina_id),
            'ejercicios' => Ejercicio::where('user_id', Auth::id())->orderBy('nombre')->get(),
        ]);
    }

    public function store(DiaEjercicioStoreRequest $request, $rutina_id, $dia_rutina_id)
    {
        $rutina = Rutina::findOrFail($rutina_id);
        $this->authorize('create', $rutina);

        for ($i = 0; $i < count($request->diaEjercicios); $i++) { 
            $diaEjercicio = new DiaEjercicio();
            $diaEjercicio->diaRutina()->associate($dia_rutina_id);
            $diaEjercicio->ejercicio()->associate($request->diaEjercicios[$i]['ejercicio_id']);
            $diaEjercicio->series = $request->diaEjercicios[$i]['series'];
            $diaEjercicio->repeticiones = $request->diaEjercicios[$i]['repeticiones'];
            $diaEjercicio->peso = $request->diaEjercicios[$i]['peso'];
            $diaEjercicio->rpe = $request->diaEjercicios[$i]['rpe'];
            $diaEjercicio->cadencia = $request->diaEjercicios[$i]['cadencia'];
            $diaEjercicio->descanso = $request->diaEjercicios[$i]['descanso'];
            $diaEjercicio->created_at = Carbon::now()->addMinute($i);
            $diaEjercicio->save();
        }

        return redirect(route('ejercicios-del-dia.index', [$rutina_id, $dia_rutina_id]))
            ->with(['successMessage' => 'Ejercicio del d??a registrado con ??xito!']);
    }

    public function edit($rutina_id, $dia_rutina_id, $id)
    {
        $rutina = Rutina::findOrFail($rutina_id);
        $this->authorize('update', $rutina);

        return Inertia::render('Rutinas/DiaEjercicios/Edit', [
            'rutina' => $rutina,
            'dia' => DiaRutina::findOrFail($dia_rutina_id),
            'ejercicios' => Ejercicio::where('user_id', Auth::id())->orderBy('nombre')->get(),
            'diaEjercicio' => DiaEjercicio::findOrFail($id),
        ]);
    }

    public function update(DiaEjercicioStoreRequest $request, $rutina_id, $dia_rutina_id, $id)
    {
        $rutina = Rutina::findOrFail($rutina_id);
        $this->authorize('update', $rutina);

        $diaEjercicio = DiaEjercicio::findOrFail($id);
        $diaEjercicio->ejercicio()->associate($request->ejercicio_id);
        $diaEjercicio->series = $request->series;
        $diaEjercicio->repeticiones = $request->repeticiones;
        $diaEjercicio->peso = $request->peso;
        $diaEjercicio->rpe = $request->rpe;
        $diaEjercicio->cadencia = $request->cadencia;
        $diaEjercicio->descanso = $request->descanso;
        $diaEjercicio->save();

        return redirect(route('ejercicios-del-dia.index', [$rutina_id, $dia_rutina_id]))
            ->with(['successMessage' => 'Ejercicio del d??a actualizado con ??xito!']);
    }

    public function destroy($rutina_id, $dia_rutina_id, $id)
    {
        $rutina = Rutina::findOrFail($rutina_id);
        $this->authorize('delete', $rutina);

        DiaEjercicio::destroy($id);
        return redirect(route('ejercicios-del-dia.index', [$rutina_id, $dia_rutina_id]))
            ->with(['successMessage' => 'Ejercicio del d??a eliminado con ??xito!']);
    }
}
