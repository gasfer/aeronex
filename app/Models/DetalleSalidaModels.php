<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSalidaModels extends Model
{
    use HasFactory;
    protected $table = "detalle_salida";   
    protected $fillable = [
        'id',
        'id_salida',
        'id_detalle_ingreso',
        'cantidad_salida',
        'saldo',
        'estado',
        'entregado',
        'cantidad_reingreso',
        'fecha_reingreso',
        'cerrarEdicionReingreso',
        'created_at'
    ];
    

    protected $guarded = [];
}
