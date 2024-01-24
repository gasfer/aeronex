<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngresoModels extends Model
{
    use HasFactory;
    protected $table = "detalle_ingreso";   
    protected $fillable=[
        'id',
        'id_ingreso',
        'id_catalogo',
        'estado',
        'cantidad',
        'precio',
        'saldo_cant_ingreso',
        'saldo_stock',
        'entregado',
        'detalle_item',
    ];


    protected $guarded = [];
}
