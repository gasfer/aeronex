<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalidaModels extends Model
{
    use HasFactory;
    protected $table = "salida";
    protected $fillable = [
        'id',
        'nro_boleta',
        'fecha_salida',
        'tipo_salida',
        'proyecto',
        'estructura',
        'direccion',
        'distrito',
        'estado_salida',
        'id_usuario',
        'descripcion_trabajo',
        'edicion',
        'edicionreingreso',
        'fecha_cierre_edicion'
    ];
    protected $guarded = [];
}

