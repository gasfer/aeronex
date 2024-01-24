<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'Funcionarios';
    protected $fillable = [
        'id',
        'ci',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'telefono',
        'celular',
        'estado_civil',
        'genero',
        'email',
        'domicilio',
        'estado',
        'user_id',
        'created_at'
    ];
    

    protected $hiden = [
        'id',
        'created_at'
    ];

}
