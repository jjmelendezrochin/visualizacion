<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exportas', function (Blueprint $table) {
            $table->id();
            $table->string('numinv');
            $table->string('codigo_del_bien_raiz');
            $table->string('descripcion');
            $table->string('num_activo');
            $table->string('num_comp');
            $table->string('descripcion_del_componente');
            $table->string('codigo_area');
            $table->string('area');
            $table->string('codigo_edificio');
            $table->string('edificio');
            $table->string('codigo_piso');
            $table->string('piso');
            $table->string('ubicacion_exacta');
            $table->string('num_empleado');
            $table->string('empleado');
            $table->string('rfc_de_empleado');
            $table->string('nivel_empleado');
            $table->string('observaciones');
            $table->string('usuario');
            $table->string('fecha_y_hora_levantamiento');
            $table->string('serie');
            $table->string('marca');
            $table->string('modelo');
            $table->string('placas');
            $table->string('status_baja');
            $table->string('status_bienes_no_contemplados');
            $table->string('status_duplicado');
            $table->string('status_etiqueta');
            $table->string('status_existencia_sistema');
            $table->string('status_sin_num_de_inventario');
            $table->string('status_edicion');
            $table->string('status_etiqueta_generada');
            $table->string('fecha_y_hora_comparacion');
            $table->string('folio_vale_de_resguardo');
            $table->string('status_adhesion_prog_bajas');
            $table->string('status_retiros');
            $table->string('status_reasignaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exportas');
    }
};
