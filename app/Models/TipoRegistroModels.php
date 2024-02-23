<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoRegistroModels extends Model
{
    use HasFactory;
    protected $table = "tipo_registro"; 

    protected $fillable = [
        'id',
        'nombre_registro',
        'codigo_registro',
        'estado'];
    
    protected $hiden = [
        'id',
        'updated_at'
    ];

    protected $guarded = [];
}
