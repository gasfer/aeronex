<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaModels extends Model
{
    use HasFactory;

    protected $table = "categoria";
    protected $fillable =
    [
        'id',
        'codigo',
        'nombre_categoria'
    ];
    protected $hidden = ['created_at', 'updated_at'];
}
