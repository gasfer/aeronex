<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecepcionRegistroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcion_registro', function (Blueprint $table) {
            $table->unsignedBigInteger('id_estacion_terminal')->nullable();            
            $table->unsignedBigInteger('id_user')->nullable();            
            $table->unsignedBigInteger('id_tipo_registro')->nullable();            

            $table->string('nombre_registro');
            $table->timestamp('fecha_recepcionado');
            $table->text('mensaje');
            $table->enum('estado', ['AC', 'DC'])->default('AC');  
           
            $table->timestamps();
            $table->foreign('id_estacion_terminal')->references('id')->on('estacion_terminal');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_tipo_registro')->references('id')->on('registro_tipo_registro');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recepcion_registro');
    }
}
