<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponsableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsable', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ci',10);           
            $table->string('nombres',50);
            $table->string('primer_apellido',50)->nullable();
            $table->string('segundo_apellido',50)->nullable();
            $table->date('fecha_nacimiento');
            $table->integer('telefono')->nullable();
            $table->integer('celular')->nullable();
            $table->string('estado_civil');
            $table->string('genero')->nullable();

            $table->string('email')->unique()->nullable();
            $table->string('domicilio', 200); 
            $table->string('estado',10)->default('ACTIVO');
            $table->integer('user_id');
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
        Schema::dropIfExists('responsable');
    }
}
