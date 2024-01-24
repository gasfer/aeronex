<?php

namespace App\Http\Controllers\Reportes;

use App\Http\Controllers\Controller;
use App\Models\SalidaModels;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function reporte(Request $request)
    {
        $Salidas = SalidaModels::all();
        return view('reportes.index', [
            'Salidas'  => $Salidas,
        ]);
    }
    public function reporteIngreso(Request $request)
    {
        echo 'reporteIngreso';
    }
    public function reporteSalida(Request $request)
    {
        echo 'reporteSalida';
    }
}
