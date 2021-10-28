<?php

namespace App\Http\Controllers\Ejercicios;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ejercicios\EjercicioStoreRequest;
use App\Http\Requests\Rutinas\RutinaStoreRequest;
use App\Models\Ejercicios\Ejercicio;
use App\Services\Slugs\SlugService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class EjercicioController extends Controller
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
        return Inertia::render('Ejercicios/Index', [
            'ejercicios' => Ejercicio::where('user_id', Auth::id())->orderBy('nombre')->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Ejercicios/Create');
    }

    public function store(EjercicioStoreRequest $request)
    {
        for ($i = 0; $i < count($request->ejercicios); $i++) { 
            $ejercicio = new Ejercicio();
            $ejercicio->nombre = $request->ejercicios[$i]['nombre'];
            $ejercicio->slug = $this->slugService->obtenerSlug($request->ejercicios[$i]['nombre']);
            $ejercicio->descripcion = $request->ejercicios[$i]['descripcion'];
            $ejercicio->user()->associate(Auth::id());
            $ejercicio->created_at = Carbon::now()->addSecond($i);
            $ejercicio->save();
        }

        return redirect(route('ejercicios.index'))
            ->with(['successMessage' => 'Ejercicio registrado con éxito!']);
    }

    public function edit($id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        $this->authorize('update', $ejercicio);

        return Inertia::render('Ejercicios/Edit', [
            'ejercicio' => $ejercicio,
        ]);
    }

    public function update(EjercicioStoreRequest $request, $id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        $this->authorize('update', $ejercicio);

        $ejercicio->nombre = $request->nombre;
        $ejercicio->descripcion = $request->descripcion;
        $ejercicio->save();

        return redirect(route('ejercicios.index'))
            ->with(['successMessage' => 'Ejercicio actualizado con éxito!']);
    }

    public function destroy($id)
    {
        $ejercicio = Ejercicio::findOrFail($id);
        $this->authorize('delete', $ejercicio);

        Ejercicio::destroy($ejercicio->id);
        return redirect(route('ejercicios.index'))
            ->with(['successMessage' => 'Ejercicio eliminado con éxito!']);
    }
}
