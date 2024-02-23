<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstacionTerminalModels extends Model
{
    use HasFactory;
    protected $table = "estacion_terminal"; 

    protected $fillable = [
        'id',
        'nombre_estacion',
        'codigo_estacion',
        'descripcion',
        'tipo',
        'estado'];
    
    protected $hiden = [
        'id',
        'updated_at'
    ];

    protected $guarded = [];
}
