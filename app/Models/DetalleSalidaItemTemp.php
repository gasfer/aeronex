<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleSalidaItemTemp extends Model
{
    use HasFactory;
    protected $table = "detalle_salida_item_temp";   


    protected $fillable=[
        'id',
        'id_item_catalogo',
        'codigo',
        'id_detalle_ingreso',
        'id_ingreso',
        'descripcion_catalogo',
        'id_unidad_medida',
        'unidad_medida_text',
        'cantidad_salida',
        'precio',
        'detalle_item',
        'nro_ingreso',
        'estado'
    ];

    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = [];

}
