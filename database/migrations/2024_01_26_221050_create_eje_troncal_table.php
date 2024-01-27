<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEjeTroncalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eje_troncal', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_eje_troncal');
            $table->string('codigo_eje_troncal');
            $table->enum('estado', ['AC', 'DC'])->default('AC');
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
        Schema::dropIfExists('eje_troncal');
    }
}
