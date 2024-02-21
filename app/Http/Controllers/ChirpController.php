<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('chirps.index', [
            // 'chirps' => Chirp::all()
            // 'chirps' => Chirp::orderBy('created_at', 'desc')->get()
            // 'chirps' => Chirp::latest()->get()
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valida = $request->validate([
            'mensaje' => ['required', 'min:3', 'max:255'],
        ]);

        // return request();                // Regresa todos los datos pasados
        // return request('mensaje');       // Regresa solo la llave mensaje
        /*
        $mensaje = $request->get('mensaje');

        // Inserción de datos
        Chirp::create([                     // Inserta datos en la tabla mensaje
            'mensaje' => $mensaje,
            'user_id' => auth()->id(),
        ]);
        */

        $request->user()->chirps()->create($valida);

        /*
        $request->user()->chirps()->create([
            'mensaje' => $request->get('mensaje'),
        ]);
        */

        //session()->flash('status');
        //session()->flash('status', '¡Chirp creado exitosamente!');
        // return  to_route('chirps.index');            // Redirección por nombre

        return  to_route('chirps.index')
            ->with('status', __('Chirp created successfully!') );
            session()->flash('status', '¡Chirp creado exitosamente!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        $this->authorize('update', $chirp);

        /*
        if (auth()->user()->isNot($chirp->user)){
            abort(403);
        }
        */

         return view('chirps.edit', [
            'chirp' => $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {

        $this->authorize('update', $chirp);
        /*
        if (auth()->user()->isNot($chirp->user)){
            abort(403);
        }*/

        $valida = $request->validate([
            'mensaje' => ['required', 'min:3', 'max:255'],
        ]);

        $chirp->update($valida);

        return  to_route('chirps.index')
        ->with('status', __('Chirp updated successfully!') );
        session()->flash('status', '¡Chirp actualizado exitosamente!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $this->authorize('delete', $chirp);

        $chirp->delete();

        return  to_route('chirps.index')
        ->with('status', __('Chirp deleted successfully!'));
        session()->flash('status', '¡Chirp borrado exitosamente!');

    }
}
