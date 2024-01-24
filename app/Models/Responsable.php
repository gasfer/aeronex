<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    use HasFactory;

    protected $table = 'responsable';
    protected $fillable = [
        'ci',
        'nombres',
        'primer_apellido',
        'segundo_apellido',
        'fecha_nacimiento',
        'telefono',
        'celular',
        'estado_civil',
        'genero',
        'email',
        'domicilio',
        'estado',
        'user_id',
        'created_at'
    ];

    protected $hiden = [
        'id',
        'updated_at'
    ];


    //generate ci reposnsable
    public function generateCiResponsable(){

        $ci = Responsable::select('ci')
                ->where('ci', 'ilike', "%SCR-0%")
                ->orderBy('ci', 'DESC')
                ->first();

         if($ci){
            $number = (int) str_replace('-','',filter_var($ci, FILTER_SANITIZE_NUMBER_INT)) + 1;
            return 'SCR-'.str_pad($number, 4, '0', STR_PAD_LEFT);
         }else{
             return 'SCR-0001';
         }   
    }

}
