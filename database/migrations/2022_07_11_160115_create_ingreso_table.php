<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingreso', function (Blueprint $table) {
            $table->id();
            $table->string('nro_ingreso')->unique();
            $table->string('nro_egreso');
            $table->string('almacen');
            $table->string('funcionario');
            $table->enum('estado', ['AC', 'DC'])->default('AC');
            $table->text('observaciones');
            $table->integer('id_usuario');
            $table->integer('edicion');
            $table->timestamp('fecha_cierre');
            $table->string('procedencia');
            $table->string('orden_compra');
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('users');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingreso');
    }
}
