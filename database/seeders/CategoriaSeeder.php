<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // DB::raw('CREATE EXTENSION IF NOT EXISTS "pgcrypto"');
        DB::table('categoria')->insert([
            'codigo' => 'FERRE',
            'nombre_categoria' => 'FERRETERIA',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categoria')->insert([
            'codigo' => 'PINT',
            'nombre_categoria' => 'PINTURAS',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categoria')->insert([
            'codigo' => 'SEÑA',
            'nombre_categoria' => 'MATERIAL SEÑALIZACION',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categoria')->insert([
            'codigo' => 'ET',
            'nombre_categoria' => ' ESTRUCTURA Y TABIQUERÍA ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categoria')->insert([
            'codigo' => 'CUB',
            'nombre_categoria' => 'CUBIERTAS',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categoria')->insert([
            'codigo' => 'EVA',
            'nombre_categoria' => 'EVACUACION',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('categoria')->insert([
            'codigo' => 'UTC',
            'nombre_categoria' => 'UTILES DE CONSTRUCCIÓN ',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
