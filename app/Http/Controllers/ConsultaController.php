<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use App\Exports\ConsultaExports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use nilsenj\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;


class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ruta de la carpeta que deseas explorar
        $folderPath = public_path('uploads'); // Cambia esto según tu estructura

        // Obtener la lista de archivos y directorios
        $contents = scandir($folderPath);

        // Filtrar los elementos "." y ".."
        $archivos = array_diff($contents, ['.', '..']);

        // print_r($filteredContents);
        $message = 'Algun mensaje';

        // Muestra los datos en
        // C:\laragon\www\Visualizacion\storage\logs
        Log::info($archivos);

        // $archivos = Archivos::paginate(5);
        return view ('dashboard', ['archivos' => $archivos ], ['ruta' => $folderPath]);
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

    }

    /**
     * Export query table
     */
    public function exporta(Request $request)
    {

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
