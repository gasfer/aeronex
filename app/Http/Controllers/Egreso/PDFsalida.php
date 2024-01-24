<?php

namespace App\Http\Controllers\Egreso;

use App\Http\Controllers\Controller;
use App\Models\DetalleSalidaModels;
use App\Models\SalidaModels;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use PDF;


class PDFsalida extends Controller
{

    public function printSalidaItem(Request $request)
    {

        //  var_dump($request->id);die;
        $salidas = SalidaModels::select('*')
            ->where('id', $request->id)
            ->get();

        $dataDetalleSalida = DetalleSalidaModels::select(
            'catalogo.codigo',
            'catalogo.descripcion_catalogo',
            'unidad_medida.descripcion_unidad_medida',
            'unidad_medida.descripcion_unidad_medida',
            'detalle_salida.cantidad_salida',
            'detalle_salida.cantidad_reingreso',
            'detalle_ingreso.precio',
            'ingreso.nro_ingreso'
        )
            ->join('detalle_ingreso', 'detalle_ingreso.id', '=', 'detalle_salida.id_detalle_ingreso')
            ->join('ingreso', 'ingreso.id', '=', 'detalle_ingreso.id_ingreso')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->join('categoria', 'categoria.id', '=', 'catalogo.id_categoria')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->where('detalle_salida.id_salida', $request->id)
            ->get();

        // $detalle = $dataDetalleSalida->toArray();
        //    $pdf = new PDF();
        //    $pdf = PDF::setPaper('a4', 'landscape');
        $pdf = PDF::loadView('egreso/PDFsalidaItem', compact('salidas', 'dataDetalleSalida'))->setPaper('letter');
        return  $pdf->stream("IngresoItem.pdf", array("Attachment" => false));
    }
    public function pdfSalidaReingreso(Request $request)
    {

        //  var_dump($request->id);die;
        $salidas = SalidaModels::select('*')
            ->where('id', $request->id)
            ->get();

        $dataDetalleSalida = DetalleSalidaModels::select(
            'catalogo.codigo',
            'catalogo.descripcion_catalogo',
            'unidad_medida.descripcion_unidad_medida',
            'unidad_medida.descripcion_unidad_medida',
            'detalle_salida.cantidad_salida',
            'detalle_salida.cantidad_reingreso',
            'detalle_ingreso.precio',
            'ingreso.nro_ingreso'
        )
            ->join('detalle_ingreso', 'detalle_ingreso.id', '=', 'detalle_salida.id_detalle_ingreso')
            ->join('ingreso', 'ingreso.id', '=', 'detalle_ingreso.id_ingreso')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->join('categoria', 'categoria.id', '=', 'catalogo.id_categoria')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->where('detalle_salida.id_salida', $request->id)
            ->get();

        // $detalle = $dataDetalleSalida->toArray();
        //    $pdf = new PDF();
        //    $pdf = PDF::setPaper('a4', 'landscape');
        $pdf = PDF::loadView('egreso/PDFsalidaItemReingreso', compact('salidas', 'dataDetalleSalida'))->setPaper('letter');
        return  $pdf->stream("IngresoItem.pdf", array("Attachment" => false));
    }
}
