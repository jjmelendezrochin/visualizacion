<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rutas;
use App\Exports\ConsultaExports;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use nilsenj\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Log;


class CarpetasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $laruta = '.';

        // Ruta de la carpeta que deseas explorar
        $folderPath = public_path($laruta); // Cambia esto según tu estructura

        // Obtener la lista de archivos y directorios
        $contents = scandir($folderPath);

        // Filtrar los elementos
        $archivos = array_diff($contents, ['.', '..','.htaccess','build','images','js']);

        // Muestra los datos en
        // C:\laragon\www\Visualizacion\storage\logs

        // Truncado de tabla rutas
        Rutas::truncate();
        Log::info('********************');

        // Inserción de datos en un modelo
        foreach ($archivos as &$archivo) {

            if (strpos($archivo, '.') == false) {
                $rutas = new Rutas;
                $rutas->nivel = 1;
                $rutas->ruta =  $laruta;
                $rutas->archivo = str_replace($folderPath."\\" , '', $archivo);
                $rutas->save();
            }
        }

        //$rutas = Rutas::where('archivo', 'like', $request->nombre_archivo . '%');
        $rutas = Rutas::paginate(10);

        $datos = [
            $data   = $rutas,
            $direc  = $laruta
        ];

        //return view ('dashboard', compact('datos'));
        return view ('Carpetas', compact('datos'));
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
        $laruta = '.';

        // Ruta de la carpeta que deseas explorar
        $folderPath = public_path($laruta); // Cambia esto según tu estructura

        // Obtener la lista de archivos y directorios
        $contents = scandir($folderPath);

        // Filtrar los elementos
        $archivos = array_diff($contents, ['.', '..','.htaccess','build','images','js']);

        // Muestra los datos en
        // C:\laragon\www\Visualizacion\storage\logs

        // Truncado de tabla rutas
        Rutas::truncate();
        Log::info('********************');

        // Inserción de datos en un modelo
        foreach ($archivos as &$archivo) {

            if (strpos($archivo, '.') == false) {
                $rutas = new Rutas;
                $rutas->nivel = 1;
                $rutas->ruta =  $laruta;
                $rutas->archivo = str_replace($folderPath."\\" , '', $archivo);
                $rutas->save();
            }
        }

        // Consulta los datos que cumplan con el criterio
        $consulta = "SELECT archivo FROM rutas WHERE archivo like '%" . $request->nombre_archivo . "%'";
        $resultados = DB::select($consulta);
        
        Log::info('consulta sql ' . $consulta);

        //Trunca las tablas luego del select
        Rutas::truncate();

        // Inserción de datos en un modelo
        foreach ($resultados as $fila) {
            $archivo = $fila->archivo;
            $rutas = new Rutas;
            $rutas->nivel = 1;
            $rutas->ruta =  $laruta;
            $rutas->archivo = str_replace($folderPath . "\\", '', $archivo);
            $rutas->save();
        }

        //$rutas = Rutas::where('archivo', 'like', $request->nombre_archivo . '%');
        $rutas = Rutas::paginate(10);

        $datos = [
            $data   = $rutas,
            $direc  = $laruta,
            $datoconsulta = $request->nombre_archivo
        ];

        //return view ('dashboard', compact('datos'));
        return view ('Carpetas', compact('datos'));
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
