<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up():void
    {
        // Obtener todos los datos de CentrosCivicos y mapearlos correctamente
        $centrosCivicos = DB::table('CentrosCivicos')->get()->map(function ($centro) {
            return [
                'nombre' => $centro->nombre,
                'direccion' => $centro->direccion,
                'telefono' => $centro->telefono,
                'horario' => $centro->horario,
                'foto' => 'foto.jpg', // Valor por defecto
            ];
        })->toArray();

        // Insertar los datos en la tabla centros si hay registros para migrar
        if (!empty($centrosCivicos)) {
            DB::table('centros')->insert($centrosCivicos);
        }
    }
    /**
     * Reverse the migrations.
     */
    public function down():void
    {
        // En caso de revertir, eliminamos los datos migrados
        DB::table('centros')->truncate();
    }
};
