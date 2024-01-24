<?php

namespace App\Http\Controllers\Ingreso;

use App\Http\Controllers\Controller;
use App\Models\IngresoModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class PDFingreso extends Controller
{

    public function printIngresoItem(Request $request)
    {

        // var_dump($request->id);die;
        $dataIngresoItem = DB::table('detalle_ingreso')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->join('categoria', 'categoria.id', '=', 'catalogo.id_categoria')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->where('id_ingreso', $request->id)
            ->select(
                'detalle_ingreso.id_ingreso',
                // 'detalle_ingreso.id',
                'detalle_ingreso.cantidad',
                'detalle_ingreso.id as id_detalle_ingreso',
                'detalle_ingreso.precio',
                'detalle_ingreso.saldo_cant_ingreso',
                'detalle_ingreso.saldo_stock',
                'detalle_ingreso.entregado',
                'detalle_ingreso.detalle_item',
                'catalogo.descripcion_catalogo',
                'catalogo.codigo',
                'catalogo.id',
                'categoria.nombre_categoria',
                'unidad_medida.descripcion_unidad_medida',
                'unidad_medida.id as id_unidad'
            )
            ->get();

        $ingresos = IngresoModels::Select('ingreso.*')
            ->where('id', $request->id)
            ->get();

        //  var_dump($ingresos);
        // die;


        //    $pdf = new PDF();
        //    $pdf = PDF::setPaper('a4', 'landscape');
        $pdf = PDF::loadView('ingreso/reportePDFingresoItem', compact(['dataIngresoItem', 'ingresos']))->setPaper('letter');
        return  $pdf->stream("IngresoItem.pdf", array("Attachment" => false));
    }
}
