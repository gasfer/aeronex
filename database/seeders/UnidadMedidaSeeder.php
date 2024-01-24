<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadMedidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidad_medida')->insert([
            'codigo' => 'PZ',
            'descripcion_unidad_medida' => 'PIEZA',
            'id_usuario' => 1,
            'fecha' => '2022/07/12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('unidad_medida')->insert([
            'codigo' => 'Kgr',
            'descripcion_unidad_medida' => 'KILOGRAMO',
            'id_usuario' => 1,
            'fecha' => '2022/07/12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('unidad_medida')->insert([
            'codigo' => 'UN',
            'descripcion_unidad_medida' => 'UNIDAD',
            'id_usuario' => 1,
            'fecha' => '2022/07/12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('unidad_medida')->insert([
            'codigo' => 'Caja',
            'descripcion_unidad_medida' => 'CAJA',
            'id_usuario' => 1,
            'fecha' => '2022/07/12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('unidad_medida')->insert([
            'codigo' => 'bolsa',
            'descripcion_unidad_medida' => 'BOLSA',
            'id_usuario' => 1,
            'fecha' => '2022/07/12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('unidad_medida')->insert([
            'codigo' => 'barra',
            'descripcion_unidad_medida' => 'BARRA',
            'id_usuario' => 1,
            'fecha' => '2022/07/12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('unidad_medida')->insert([
            'codigo' => 'juego',
            'descripcion_unidad_medida' => 'JUEGO',
            'id_usuario' => 1,
            'fecha' => '2022/07/12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('unidad_medida')->insert([
            'codigo' => 'valde',
            'descripcion_unidad_medida' => 'VALDE',
            'id_usuario' => 1,
            'fecha' => '2022/07/12',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
