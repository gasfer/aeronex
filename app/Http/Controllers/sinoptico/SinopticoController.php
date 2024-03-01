<?php

namespace App\Http\Controllers\sinoptico;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecepcionRegistroModels;
use App\Models\EstacionTerminalModels;
use Illuminate\Support\Facades\Auth;



class SinopticoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sinopticos = RecepcionRegistroModels::all();
        return view('sinoptico.index', [
            'sinopticos'  => $sinopticos,
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
