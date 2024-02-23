<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecepcionRegistroModels extends Model
{
    use HasFactory;
    protected $table = "recepcion_registro"; 

    protected $fillable = [
        'id',
        'id_estacion_terminal',
        'id_user',
        'id_tipo_registro',
        'nombre_registro',
        'fecha_recepcionado',
        'mensaje',
        'estado'];
    
    protected $hiden = [
        'id',
        'updated_at'
    ];

    protected $guarded = [];
}
