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
            'email' => 'sfernandezf@cochabamba.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'ADMIN',
            'genero' => 'MASCULINO', //FEMENINO
            'ofice' => 'Departamento de Desarrollo de Sistemas DDSI',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'usuario 2',
            'email' => 'usuario1@cochabamba.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'ADMIN',
            'genero' => 'MASCULINO', //FEMENINO
            'ofice' => 'Departamento de Desarrollo de Sistemas DDSI',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'usuario 2',
            'email' => 'usuario2@cochabamba.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'ADMIN',
            'genero' => 'MASCULINO', //FEMENINO
            'ofice' => 'Departamento de Desarrollo de Sistemas DDSI',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'usuario 3',
            'email' => 'usuario3@cochabamba.bo',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'role' => 'ADMIN',
            'genero' => 'MASCULINO', //FEMENINO
            'ofice' => 'Departamento de Desarrollo de Sistemas DDSI',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
