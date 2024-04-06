<?php

namespace App\Exports;

use App\User;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ConsultaExports implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'id',
            'numinv',
            'codigo_del_bien_raiz',
            'descripcion',
            'num_activo',
            'num_comp',
            'descripcion_del_componente',
            'codigo_area',
            'area',
            'codigo_edificio',
            'edificio',
            'codigo_piso',
            'piso',
            'ubicacion_exacta',
            'num_empleado',
            'empleado',
            'rfc_de_empleado',
            'nivel_empleado',
            'observaciones',
            // 'usuario',
            // 'fecha_y_hora_levantamiento',
            'serie',
            'marca',
            'modelo',
            'placas',
            'status_baja',
            'status_bienes_no_contemplados',
            'status_duplicado',
            'status_etiqueta',
            'status_existencia_sistema',
            'status_sin_num_de_inventario',
            'status_edicion',
            'status_etiqueta_generada',
            // 'fecha_y_hora_comparacion',
            'folio_vale_de_resguardo',
            'status_adhesion_prog_bajas',
            'status_retiros',
            'status_reasignaciones'
        ];
    }
    public function collection()
    {
        $consultas = DB::table('exportas')
            ->select('id',
            'numinv',
            'codigo_del_bien_raiz',
            'descripcion',
            'num_activo',
            'num_comp',
            'descripcion_del_componente',
            'codigo_area',
            'area',
            'codigo_edificio',
            'edificio',
            'codigo_piso',
            'piso',
            'ubicacion_exacta',
            'num_empleado',
            'empleado',
            'rfc_de_empleado',
            'nivel_empleado',
            'observaciones',
            // 'usuario',
            // 'fecha_y_hora_levantamiento',
            'serie',
            'marca',
            'modelo',
            'placas',
            'status_baja',
            'status_bienes_no_contemplados',
            'status_duplicado',
            'status_etiqueta',
            'status_existencia_sistema',
            'status_sin_num_de_inventario',
            'status_edicion',
            'status_etiqueta_generada',
            // 'fecha_y_hora_comparacion',
            'folio_vale_de_resguardo',
            'status_adhesion_prog_bajas',
            'status_retiros',
            'status_reasignaciones')->get();
        return $consultas;
    }
}
