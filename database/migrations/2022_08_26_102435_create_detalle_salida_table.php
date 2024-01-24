<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_salida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_salida')->nullable();            
            $table->integer('id_detalle_ingreso')->nullable();            
            $table->decimal('cantidad_salida',9,2);
            $table->enum('estado', ['AC', 'DC'])->default('AC');
            $table->enum('entregado', ['SI', 'NO'])->default('NO');
            $table->decimal('cantidad_reingreso', 9,2);  
            $table->timestamp('fecha_reingreso');
            $table->integer('cerrarEdicionReingreso');            
            $table->timestamps();
            $table->foreign('id_salida')->references('id')->on('salida');
            $table->foreign('id_detalle_ingreso')->references('id')->on('detalle_ingreso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_salida');
    }
}
