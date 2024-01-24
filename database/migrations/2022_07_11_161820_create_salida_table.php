<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salida', function (Blueprint $table) {
            $table->id();
            $table->string('nro_boleta');
            $table->timestamp('fecha_salida');
            $table->string('tipo_salida');
            $table->string('proyecto');
            $table->string('estructura');
            $table->string('direccion');
            $table->string('distrito');            
            $table->string('estado_salida');
            $table->string('id_usuario');       
            $table->string('descripcion_trabajo');
            $table->string('entregado');
            $table->integer('edicion');
            $table->integer('edicionreingreso');
            $table->enum('estado', ['AC', 'DC'])->default('AC');
            $table->timestamp('fecha_cierre_edicion');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salida');
    }
}
