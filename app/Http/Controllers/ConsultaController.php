<?php

namespace App\Http\Controllers;

use App\Models\Rutas;
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
    public function index(Request $request)
    {
        if (!is_null($request->ruta))
        {
            $laruta = $request->ruta;

            // Ruta de la carpeta que deseas explorar
            $folderPath = public_path($laruta); // Cambia esto según tu estructura

            // Obtener la lista de archivos y directorios
            $contents = scandir($folderPath);
            $criterio = $folderPath . '\\' . $request->nombre_archivo . '*';
            $contents = glob($criterio);

            Log::info($request->nombre_archivo);
            Log::info($criterio);


            // Filtrar los elementos "." y ".."
            $archivos = array_diff($contents, ['.', '..']);

            // Muestra los datos en
            // C:\laragon\www\Visualizacion\storage\logs

            // Log::info($archivos);

            // Truncado de tabla rutas
            Rutas::truncate();

            // Inserción de datos en un modelo
            foreach ($archivos as &$archivo) {
                //Log::info($archivo);
                // Log::info(str_replace($folderPath."\\" , '', $archivo));
                $rutas = new Rutas;
                $rutas->nivel = 1;
                $rutas->ruta =  $laruta;
                $rutas->archivo = str_replace($folderPath."\\" , '', $archivo);
                $rutas->save();
            }


            // $rutas = RutasDB::select('select * from rutas where archivo like ?', $request->nombre_archivo);
            // $rutas = Rutas::select('select * from rutas where archivo like ?', $request->nombre_archivo);
            $rutas = Rutas::where('archivo', 'like', $request->nombre_archivo . '%');
            $rutas = Rutas::paginate(10);

            $datos = [
                $data   = $rutas,
                $param  = $request,
                $direc  = $laruta
            ];

            return view ('dashboard', compact('datos'));
        }
        elseif (!is_null($request->laruta))
        {
            $laruta = $request->laruta;

        // Ruta de la carpeta que deseas explorar
        $folderPath = public_path($laruta); // Cambia esto según tu estructura

            // Obtener la lista de archivos y directorios
            $contents = scandir($folderPath);
            $criterio = $folderPath . '\\' . $request->nombre_archivo . '*';
            $contents = glob($criterio);

            Log::info($request->nombre_archivo);
            Log::info($criterio);


            // Filtrar los elementos "." y ".."
            $archivos = array_diff($contents, ['.', '..']);

            // Muestra los datos en
            // C:\laragon\www\Visualizacion\storage\logs

            // Log::info($archivos);

            // Truncado de tabla rutas
            Rutas::truncate();

            // Inserción de datos en un modelo
            foreach ($archivos as &$archivo) {
                //Log::info($archivo);
                // Log::info(str_replace($folderPath."\\" , '', $archivo));
                $rutas = new Rutas;
                $rutas->nivel = 1;
                $rutas->ruta =  $laruta;
                $rutas->archivo = str_replace($folderPath."\\" , '', $archivo);
                $rutas->save();
            }


            // $rutas = RutasDB::select('select * from rutas where archivo like ?', $request->nombre_archivo);
            // $rutas = Rutas::select('select * from rutas where archivo like ?', $request->nombre_archivo);
            $rutas = Rutas::where('archivo', 'like', $request->nombre_archivo . '%');
            $rutas = Rutas::paginate(10);

            $datos = [
                $data   = $rutas,
                $param  = $request,
                $direc  = $laruta
            ];

        return view ('dashboard', compact('datos'));
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
