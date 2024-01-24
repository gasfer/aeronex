<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DetalleIngresoItemTemp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $salidas = $this->getTotalReporteSlidas();
        $ingresos = $this->getTotalReporteIngresos();
        $items = $this->getTotalReporteItems();
        $reingreso = $this->getTotalReporteReingreso();
        return view('home', compact('salidas', 'ingresos', 'items', 'reingreso'));
    }

    public function getTotalReporteSlidas()
    {

        $data = DB::table('detalle_salida')->select(DB::raw('count(*) as salidas'))
            // ->where('detalle_salida.entregado', '=', 'SI')
            ->get();


        return $data[0]->salidas;
    }
    public function getTotalReporteIngresos()
    {

        $data = DB::table('detalle_ingreso')->select(DB::raw('count(*) as ingresos'))
            // ->where('entregado', '=', 'SI')
            ->get();


        return $data[0]->ingresos;
    }
    public function getTotalReporteItems()
    {

        $data = DB::table('catalogo')->select(DB::raw('count(*) as items'))
            // ->where('entregado', '=', 'SI')
            ->get();


        return $data[0]->items;
    }
    public function getTotalReporteReingreso()
    {

        $data = DB::table('detalle_salida')->select(DB::raw('count(*) as reingreso'))
            ->where('detalle_salida.cantidad_reingreso', '>', 0)
            ->get();


        return $data[0]->reingreso;
    }
}
