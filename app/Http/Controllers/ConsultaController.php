<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('querys.index');
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
        // Aqui se hace la consulta del número de inventario
        $resultado = DB::table('consultas')
        ->where('numinv', $request->numinv)
        ->first();

        if($resultado==null)
        {
            $data = array(
                'title' => 'Welcome to Laravel',
                'services' => [
                    $request->numinv,
                    'N/E',
                    'N/E',
                    'N/E',
                    'N/E',
                    'N/E']
            );
        }
        else{
            $data = array(
                'title' => 'Welcome to Laravel',
                'services' => [
                    $request->numinv,
                    $resultado->descripcion,
                    $resultado->area,
                    $resultado->edificio,
                    $resultado->piso,
                    $resultado->empleado,
                    ]
            );
        }



        // return $request->numinv;
        //return view ('querys.index', ['dato' => $request->numinv]);
        return view ('querys.index',  compact('data'))
        ->with('status', __('Chirp created successfully!'));;
    }

    /**
     * Display the specified resource.
     */
    public function show(Consulta $consulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consulta $consulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consulta $consulta)
    {
        //
    }
}
