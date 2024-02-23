<?php

namespace App\Http\Controllers\metar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecepcionRegistroModels;
use App\Models\EstacionTerminalModels;
use Illuminate\Support\Facades\Auth;



class MetarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $metars = RecepcionRegistroModels::all();
        return view('metar.index', [
            'metars'  => $metars,
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
