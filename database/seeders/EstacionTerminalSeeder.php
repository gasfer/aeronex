<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstacionTerminalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::raw('CREATE EXTENSION IF NOT EXISTS "pgcrypto"');

        DB::table('estacion_terminal')->insert([
             'nombre_estacion' => 'LA PAZ',
             'codigo_estacion' => 'SLLP',
             'descripcion' => 'EJE TONCAL LA PAZ',
             'tipo' => 1,
             'created_at' => now(),
             'updated_at' => now()
         ]);
        DB::table('estacion_terminal')->insert([
            'nombre_estacion' => 'SANTA CRUZ',
            'codigo_estacion' => 'SLVR',
            'descripcion' => 'EJE TRONCAL SANTA CRUZ ',
            'tipo' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('estacion_terminal')->insert([
            'nombre_estacion' => 'COCHABAMBA',
            'codigo_estacion' => 'SLCB',
            'descripcion' => 'ESTACION TERMINAL COCHABAMBA',
            'tipo' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);
           DB::table('estacion_terminal')->insert([
            'nombre_estacion' => 'ALCANTARI',
            'codigo_estacion' => 'SLAL',
            'descripcion' => 'ESTACION TERMINAL ALCANTARI',
            'tipo' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
           DB::table('estacion_terminal')->insert([
            'nombre_estacion' => 'POTOSI',
            'codigo_estacion' => 'SLPO',
            'descripcion' => 'ESTACION TERMINAL POTOSI',
            'tipo' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
           DB::table('estacion_terminal')->insert([
            'nombre_estacion' => 'MOTEAGUDO',
            'codigo_estacion' => 'SLAG',
            'descripcion' => 'ESTACION TERMINAL MOTEAGUDO',
            'tipo' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
          DB::table('estacion_terminal')->insert([
            'nombre_estacion' => 'VILLAMONTES',
            'codigo_estacion' => 'SLVM',
            'descripcion' => 'ESTACION TERMINAL VILLAMONTES',
            'tipo' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
          DB::table('estacion_terminal')->insert([
            'nombre_estacion' => 'TARIJA',
            'codigo_estacion' => 'SLTJ',
            'descripcion' => 'ESTACION TERMINAL TARIJA',
            'tipo' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
          DB::table('estacion_terminal')->insert([
            'nombre_estacion' => 'BERMEJO',
            'codigo_estacion' => 'SLBJ',
            'descripcion' => 'ESTACION TERMINAL BERMEJO',
            'tipo' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

          DB::table('estacion_terminal')->insert([
            'nombre_estacion' => 'CHIMORE',
            'codigo_estacion' => 'SLHI',
            'descripcion' => 'ESTACION TERMINAL CHIMORE',
            'tipo' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
          DB::table('estacion_terminal')->insert([
            'nombre_estacion' => 'YACUIBA',
            'codigo_estacion' => 'SLYA',
            'descripcion' => 'ESTACION TERMINAL YACUIBA',
            'tipo' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}
