<?php

namespace App\Http\Controllers\sinoptico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecepcionRegistroModels;
use App\Models\EstacionTerminalModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class SinopticoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sinopticos= RecepcionRegistroModels::select('recepcion_registro.*',  DB::raw('CONCAT(estacion_terminal.codigo_estacion , \' - \',estacion_terminal.nombre_estacion) AS estacion_terminal'))
        ->Join('estacion_terminal', 'estacion_terminal.id', '=', 'recepcion_registro.id_estacion_terminal')
        ->orderBy('id', 'DESC')
         ->get();

        $estacion_terminal = EstacionTerminalModels::select("estacion_terminal.id",
        DB::raw("CONCAT(estacion_terminal.codigo_estacion,' -  ',estacion_terminal.nombre_estacion) as estacion_terminal"))->get();

        return view('sinoptico.index', [
            'sinopticos'  => $sinopticos,
            'estacion_terminal'  => $estacion_terminal,
        ]);
    }
    public function create()
    {
        $estacion = EstacionTerminalModels::select()
        ->where('estado', 'AC')
        ->get();
// dd($estacion);
        $metars = RecepcionRegistroModels::all();
        $Name = Auth::user()->name;
        return view('metar.create', [
            'estacion' => $estacion,
            'metars'  => $metars,
            'Name'      => $Name,
        ]);
    }
}
