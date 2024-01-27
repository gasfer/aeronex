<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstacionTerminalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estacion_terminal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_eje_troncal')->nullable();            

            $table->string('nombre_estacion');
            $table->string('codigo_estacion');
            $table->text('descripcion');
            $table->enum('estado', ['AC', 'DC'])->default('AC');  
            $table->timestamps();
            $table->foreign('id_eje_troncal')->references('id')->on('eje_troncal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estacion_terminal');
    }
}
