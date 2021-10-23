<?php

namespace App\Http\Controllers\Rutinas;

use App\Http\Controllers\Controller;
use App\Http\Requests\Rutinas\RutinaStoreRequest;
use App\Models\Rutinas\Rutina;
use App\Services\Slugs\SlugService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RutinaController extends Controller
{
    protected $slugService;

    public function __construct(
        SlugService $slugService,
    )

    {
        $this->slugService = $slugService;
    }

    public function index()
    {
        return Inertia::render('Rutinas/Index', [
            'rutinas' => Rutina::select('id', 'nombre', 'slug')->where('user_id', Auth::id())->get(),
        ]);
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

    public function edit($id)
    {
        return Inertia::render('Rutinas/Edit', [
            'rutina' => Rutina::findOrFail($id),
        ]);
    }

    public function update(RutinaStoreRequest $request, $id)
    {
        $rutina = Rutina::findOrFail($id);
        $rutina->nombre = $request->nombre;
        $rutina->descripcion = $request->descripcion;
        $rutina->save();

        return redirect(route('rutinas.index'))
            ->with(['successMessage' => 'Rutina actualizada con éxito!']);
    }

    public function destroy($id)
    {
        Rutina::destroy($id);
        return redirect(route('rutinas.index'))
            ->with(['successMessage' => 'Rutina eliminada con éxito!']);
    }
}
