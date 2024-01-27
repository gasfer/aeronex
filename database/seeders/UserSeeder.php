<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::raw('CREATE EXTENSION IF NOT EXISTS "pgcrypto"');
        DB::table('users')->insert([
            'name' => 'Gaston Fernandez Flores',
            'email' => 'gasfer@cochabamba.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'ADMIN',
            'genero' => 'MASCULINO', //FEMENINO
            'ofice' => 'ADMINISTRADOR SISTEMA',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Amadeo Rafael Arroyo',
            'email' => 'amadeo@cochabamba.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'ADMIN',
            'genero' => 'MASCULINO', //FEMENINO
            'ofice' => 'JEFE DE UNIDAD',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'USUARIO UNO',
            'email' => 'usuario1@cochabamba.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'USUARIO',
            'genero' => 'MASCULINO', //FEMENINO
            'ofice' => 'PROFECIONAL 1',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        DB::table('users')->insert([
            'name' => 'USUARIO DOS',
            'email' => 'usuario2@cochabamba.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'USUARIO',
            'genero' => 'MASCULINO', //FEMENINO
            'ofice' => 'PROFECIONAL 2',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'USUARIO TRES',
            'email' => 'usuario3@cochabamba.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('secret'),
            'role' => 'ADMIN',
            'genero' => 'MASCULINO', //FEMENINO
            'ofice' => 'PROFECIONAL 3',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
