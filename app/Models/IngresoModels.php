<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngresoModels extends Model
{
    use HasFactory;
    protected $table = "ingreso";   
    protected $fillable = [
        'id',
        'nro_ingreso',
        'nro_egreso',
        'almacen',
        'funcionario',
        'id_usuario',
        'estado',
        'observaciones',
        'edicion',
        'fecha_cierre',
        'procedencia',
        'orden_compra'

    ];
    
    protected $hiden = [
        'id',
        'updated_at'
    ];

    protected $guarded = [];
}

