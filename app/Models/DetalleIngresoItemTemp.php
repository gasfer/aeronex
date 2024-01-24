<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngresoItemTemp extends Model
{
    use HasFactory;
    protected $table = "detalle_ingreso_item_temp";   

             protected $fillable=[
                 'id',
                 'id_item_catalogo',
                 'id_detalle_ingreso',
                 'id_ingreso',
                 'codigo',
                 'descripcion_catalogo',
                 'id_unidad_medida',
                 'cantidad_ingreso',
                 'precio_ingreso',
                 'detalle_item',
                 'nro_ingreso'
             ];
             protected $hidden = ['created_at', 'updated_at'];
             protected $guarded = [];
}
