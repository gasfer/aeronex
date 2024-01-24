<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleSalidaItemTemp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_salida_item_temp', function (Blueprint $table) {
            $table->id();
            $table->integer('id_item_catalogo');            
            $table->string('codigo');            
            $table->integer('id_detalle_ingreso');            
            $table->integer('id_ingreso');    
            $table->text('descripcion_catalogo');
            $table->integer('id_unidad_medida'); 
            $table->string('unidad_medida_text'); 
            $table->decimal('cantidad_salida', 9, 2);      
            $table->decimal('precio', 9, 2);
            $table->text('detalle_item');
            $table->string('nro_ingreso');        
            $table->string('estado');

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
        Schema::dropIfExists('detalle_salida_item_temp');
    }
}
