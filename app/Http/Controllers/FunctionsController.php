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

class FunctionsController extends Controller
{
    // ***************************
    // Función que realiza la consulta de los datos en una ruta
    public function Consulta($request, $laruta)
    {
        // Ruta de la carpeta que deseas explorar
        $folderPath = public_path($laruta);

        // Obtener la lista de archivos y directorios
        $contents = scandir($folderPath);
        $criterio = $folderPath . '\\*.*';
        $contents = glob($criterio);

        // Filtrar los elementos "." y ".."
        $archivos = array_diff($contents, ['.', '..','*.tiff']);

        // Truncado de tabla rutas
        Rutas::truncate();

        // Inserción de todos los arhcivos del directorio
        foreach ($archivos as &$archivo) {
            $rutas = new Rutas;
            $rutas->nivel = 1;
            $rutas->ruta =  $laruta;
            $rutas->archivo = str_replace($folderPath . "\\", '', $archivo);
            $rutas->save();
        }

        // Consulta los datos que cumplan con el criterio
        $consulta = "SELECT archivo FROM rutas WHERE archivo like '%" . $request->nombre_archivo . "%.pdf'";
        $resultados = DB::select($consulta);

        Rutas::truncate();

        // Inserción de datos en la tabla
        foreach ($resultados as $fila) {
            // Accede a las columnas específicas de cada fila
            $archivo = $fila->archivo;
            $rutas = new Rutas;
            $rutas->nivel = 1;
            $rutas->ruta =  $laruta;
            $rutas->archivo = $archivo;
            $rutas->save();
        }

        Log::info('consulta sql ' . $consulta);
        $rutas = Rutas::paginate(20);

        $datos = [
            $data   = $rutas,
            $param  = $request,
            $direc  = $laruta
        ];

        return $datos;
    }
}
