<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogoModels extends Model
{
    use HasFactory;
    protected $table = "catalogo";
    protected $fillable =
    [
        'id', 'codigo', 'descripcion_catalogo', 'id_unidad_medida', 'id_categoria', 'estado'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    protected $guarded = [];
}
