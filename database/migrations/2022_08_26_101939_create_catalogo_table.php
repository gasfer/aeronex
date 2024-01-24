<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('catalogo', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->text('descripcion_catalogo');
            $table->unsignedBigInteger('id_unidad_medida')->nullable();
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->enum('estado', ['AC', 'DC'])->default('AC');
            $table->timestamps();

            $table->foreign('id_categoria')->references('id')->on('categoria');
            $table->foreign('id_unidad_medida')->references('id')->on('unidad_medida');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogo');
    }
}
