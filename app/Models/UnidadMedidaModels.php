<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnidadMedidaModels extends Model
{
    use HasFactory;
    protected $table = "unidad_medida";

    protected $fillable =
    [
        'id',
        'codigo',
        'descripcion_unidad_medida',
        'id_usuario',
        'fecha'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = [];
}
