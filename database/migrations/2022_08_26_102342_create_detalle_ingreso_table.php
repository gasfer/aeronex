<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleIngresoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_ingreso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ingreso')->nullable();            
            $table->unsignedBigInteger('id_catalogo')->nullable();  
            $table->enum('estado', ['AC', 'DC'])->default('AC');
            $table->decimal('cantidad',9,2);
            $table->decimal('precio',9,2);
            $table->decimal('saldo_cant_ingreso',9,2);
            $table->integer('saldo_stock');
            $table->enum('entregado', ['SI', 'NO'])->default('NO');
            $table->text('detalle_item');

            $table->timestamps();
            $table->foreign('id_ingreso')->references('id')->on('ingreso');
            $table->foreign('id_catalogo')->references('id')->on('catalogo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_ingreso');
    }
}
