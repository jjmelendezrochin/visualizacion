<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Exports\ConsultaExports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use nilsenj\Toastr\Facades\Toastr;

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
        /*
        $validated = $request->validate([
            'numinv' => 'required',
            'descripcion' => 'required',
            'area' => 'required',
            'edificio' => 'required',
            'piso' => 'required',
            'empleado' => 'required',
            'numempleado' => 'required',
            'serie' => 'required'
        ]);
        */

        // *************************************
        // Obteniendo fecha máxima de consulta
        $sql0 = 'select fecha_y_hora_levantamiento from consultas c where id = (select max(id) from consultas c2);';
        $fecha_maxima = DB::select($sql0);        
        
        $sql = "Call Proc_Consulta1('" 
        . $request->numinv   . "','"  
        . $request->descripcion . "','" 
        . $request->area     . "','" 
        . $request->edificio . "','" 
        . $request->piso     . "','"
        . $request->empleado . "','"
        . $request->numempleado . "','"
        . $request->serie    . "');";

        $resultado = DB::select($sql);
        $cta = count($resultado);


        if($resultado==null)
        {
            $datos = [
                $data   = null,
                $param  = $request,
                $cuenta = $cta,
                $Fecha  = $fecha_maxima[0]->fecha_y_hora_levantamiento
            ];
        }
        else{
            $datos = [
                $data   = $resultado,
                $param  = $request,
                $cuenta = $cta,
                $Fecha  = $fecha_maxima[0]->fecha_y_hora_levantamiento
            ];
        }

        // Toastr::info('This is a test');
        // toastr.success('Consulta de datos', 'Atención');
        // toast()->success('Consulta exitosa', 'Info');
        
        // echo "<script>";
        // echo "toastr.success('consulta exitosa', 'Atención');";
        // echo "</script>";

        return view ('querys.index',  compact('datos'))
        ->with('status', __('Chirp created successfully!'));;
    }

    /**
     * Export query table
     */
    public function exporta(Request $request)
    {        
        $proceso = '"C:\Trabajo\CargaDatosInventarioaLaravel\bin\Release\CargaDatosInventarioaLaravel.exe" "'. 
        $request->numinv . '" "'. 
        $request->descripcion . '" "'. 
        $request->area . '" "'. 
        $request->edificio . '" "'. 
        $request->piso . '" "'. 
        $request->empleado . '" "'. 
        $request->numempleado . '" "'.
        $request->serie . '"';
        
        exec($proceso);
        
        return redirect('http://172.19.11.54/Exportacion/Exporta_parcial.xlsx');
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
