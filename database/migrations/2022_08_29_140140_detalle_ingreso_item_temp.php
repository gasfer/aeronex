<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetalleIngresoItemTemp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ingreso_item_temp', function (Blueprint $table) {
            $table->id();
            $table->integer('id_item_catalogo'); 
            $table->integer('id_detalle_ingreso'); 
            $table->integer('id_ingreso'); 
            $table->string('codigo');
            $table->text('descripcion_catalogo');
            $table->integer('id_unidad_medida'); 
            $table->decimal('cantidad_ingreso', 9, 2);      
            $table->decimal('precio_ingreso', 9, 2);
            $table->text('detalle_item');
            $table->string('nro_ingreso');
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
        Schema::dropIfExists('detalle_ingreso_item_temp');
        //
    }
}
