<?php

namespace App\Http\Controllers\Rutinas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rutinas\DiaRutinaStoreRequest;
use App\Models\Rutinas\DiaRutina;
use App\Models\Rutinas\Rutina;
use App\Services\Slugs\SlugService;
use Carbon\Carbon;
use Inertia\Inertia;

class DiaRutinaController extends Controller
{
    protected $slugService;

    public function __construct(
        SlugService $slugService,
    )

    {
        $this->slugService = $slugService;
    }

    public function index($rutina_id)
    {
        return Inertia::render('Rutinas/Dias/Index', [
            'rutina' => Rutina::findOrFail($rutina_id),
            'dias' => DiaRutina::where('rutina_id', $rutina_id)->orderBy('created_at')->get(),
        ]);
    }

    public function create($rutina_id)
    {
        return Inertia::render('Rutinas/Dias/Create', [
            'rutina' => Rutina::findOrFail($rutina_id),
        ]);
    }

    public function store(DiaRutinaStoreRequest $request, $rutina_id)
    {
        for ($i = 0; $i < count($request->dias); $i++) { 
            $diaRutina = new DiaRutina();
            $diaRutina->nombre = $request->dias[$i]['nombre'];
            $diaRutina->slug = $this->slugService->obtenerSlug($request->dias[$i]['nombre']);
            $diaRutina->rutina()->associate($rutina_id);
            $diaRutina->created_at = Carbon::now()->addMinute($i);
            $diaRutina->save();
        }

        return redirect(route('dias.index', $rutina_id))
            ->with(['successMessage' => 'Día registrado con éxito!']);
    }

    public function edit($rutina_id, $id)
    {
        return Inertia::render('Rutinas/Dias/Edit', [
            'rutina' => Rutina::findOrFail($rutina_id),
            'diaRutina' => DiaRutina::findOrFail($id),
        ]);
    }

    public function update(DiaRutinaStoreRequest $request, $rutina_id, $id)
    {
        $diaRutina = DiaRutina::findOrFail($id);
        $diaRutina->nombre = $request->nombre;
        $diaRutina->save();

        return redirect(route('dias.index', $rutina_id))
            ->with(['successMessage' => 'Día actualizado con éxito!']);
    }

    public function destroy($rutina_id, $id)
    {
        DiaRutina::destroy($id);
        return redirect(route('dias.index', $rutina_id))
            ->with(['successMessage' => 'Día eliminado con éxito!']);
    }
}
