<?php

namespace App\Http\Controllers\Rutinas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rutinas\RutinaStoreRequest;
use App\Models\Rutinas\Rutina;
use App\Services\Slugs\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RutinaController extends Controller
{
    protected $slugService;

    public function __construct(SlugService $slugService)
    {
        $this->slugService = $slugService;
    }

    public function index(Request $request)
    {
        return Inertia::render('Rutinas/Index', [
            'rutinas' => $this->obtenerRutinas($request),
        ]);
    }

    public function paginarRutinas(Request $request)
    {
        return $this->obtenerRutinas($request);
    }

    public function obtenerRutinas($request)
    {
        return Rutina::where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
    }

    public function create()
    {
        return Inertia::render('Rutinas/Create');
    }

    public function store(RutinaStoreRequest $request)
    {
        $rutina = new Rutina();
        $rutina->nombre = $request->nombre;
        $rutina->slug = $this->slugService->obtenerSlug($request->nombre);
        $rutina->descripcion = $request->descripcion;
        $rutina->user()->associate(Auth::id());
        $rutina->save();

        return redirect(route('rutinas.index'))
            ->with(['successMessage' => 'Rutina registrada con éxito!']);
    }

    public function edit(Rutina $rutina)
    {
        $this->authorize('update', $rutina);
        return Inertia::render('Rutinas/Edit', [
            'rutina' => $rutina,
        ]);
    }

    public function update(RutinaStoreRequest $request, Rutina $rutina)
    {
        $this->authorize('update', $rutina);
        $rutina->nombre = $request->nombre;
        $rutina->descripcion = $request->descripcion;
        $rutina->save();

        return redirect(route('rutinas.index'))
            ->with(['successMessage' => 'Rutina actualizada con éxito!']);
    }

    public function destroy(Rutina $rutina)
    {
        $this->authorize('delete', $rutina);
        Rutina::destroy($rutina->id);

        return redirect(route('rutinas.index'))
            ->with(['successMessage' => 'Rutina eliminada con éxito!']);
    }
}
