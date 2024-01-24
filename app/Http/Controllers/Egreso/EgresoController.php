<?php

namespace App\Http\Controllers\Egreso;

use App\Http\Controllers\Controller;
use App\Models\CatalogoModels;
use App\Models\DetalleSalidaModels;
use App\Models\SalidaModels;
use App\Models\DetalleIngresoModels;
use App\Models\DetalleSalidaItemTemp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class EgresoController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // DB::table('detalle_salida_item_temp')->delete();
        $Salidas = SalidaModels::all();
        return view('egreso.index', [
            'Salidas'  => $Salidas,
        ]);
    }

    public function create()
    {
        // $Catalogos = CatalogoModels::all();

        // $Catalogos = DetalleIngresoModels::select('catalogo.descripcion_catalogo', 'catalogo.id')
        //     ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
        //     ->get();
        // ->where('detalle_ingreso.entregado', 'NO')
        // ->where('detalle_ingreso.saldo_cant_ingreso', '>', 0)

        $Catalogos = DetalleIngresoModels::select('catalogo.descripcion_catalogo', 'catalogo.id')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            // ->where('catalogo.estado', 'AC')
            ->groupBy('catalogo.id')
            ->havingRaw('SUM(detalle_ingreso.saldo_cant_ingreso) > 0')
            ->get();
        $Salidas = SalidaModels::all();
        $Name = Auth::user()->name;
        // DB::table('detalle_salida_item_temp')->delete();

        return view('egreso.create', [
            'Catalogos' => $Catalogos,
            'Salidas'  => $Salidas,
            'Name'      => $Name,
        ]);
    }

    public function storeitems(Request $request)
    {
        SalidaModels::create($request->all());
        $Salidas = SalidaModels::all();
        $Catalogos = CatalogoModels::all();

        $Name = Auth::user()->name;
        return view('egreso.create', [

            'Catalogos' => $Catalogos,
            'Salidas'   => $Salidas,
            'Name'      => $Name,
        ]);
    }
    public function storedetallesalida(Request $request)
    {

        $Catalogos = DetalleIngresoModels::select('catalogo.descripcion_catalogo', 'catalogo.id')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->groupBy('catalogo.id')
            ->havingRaw('SUM(detalle_ingreso.saldo_cant_ingreso) > 0')
            ->get();


        $Salidas = SalidaModels::all();
        $DetalleSalida = DetalleSalidaModels::create($request->all());
        //dd($request->all());
        //return $DetalleIngrso;
        $Name = Auth::user()->name;
        return view('egreso.create', [

            'Catalogos' => $Catalogos,
            'Salidas' => $Salidas,
            'Name'      => $Name,
        ]);
    }

    public function llenarCatalogoSalida(Request $request)
    {
        // var_dump($request->select_id_catalogo_Modal);die;
        $CatalogosLlenar = CatalogoModels::select('catalogo.id', 'catalogo.codigo', 'catalogo.estado', 'unidad_medida.descripcion_unidad_medida', 'unidad_medida.id as id_unidad_medida', 'catalogo.descripcion_catalogo', 'detalle_ingreso.saldo_cant_ingreso', 'detalle_ingreso.precio', 'detalle_ingreso.id_ingreso', 'detalle_ingreso.detalle_item', 'detalle_ingreso.id as id_detalle_ingreso')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->join('detalle_ingreso', 'detalle_ingreso.id_catalogo', '=', 'catalogo.id')
            ->where('catalogo.id', intval($request->select_id_catalogo_Modal))
            ->where('detalle_ingreso.entregado', 'NO')
            // ->where('catalogo.estado', 'AC')
            ->get();


        $cantidad_existente = CatalogoModels::select(DB::raw('SUM(detalle_ingreso.saldo_cant_ingreso) as saldo_cant_ingreso'))
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->join('detalle_ingreso', 'detalle_ingreso.id_catalogo', '=', 'catalogo.id')
            ->where('detalle_ingreso.entregado', '=', 'NO')
            ->where('catalogo.id', $request->select_id_catalogo_Modal)
            // ->where('catalogo.estado', 'AC')
            ->groupBy('catalogo.id')
            ->get();

        // var_dump($cantidad_existente);die;
        // return $CatalogosLlenar;
        return response([
            'catalogosLlenar' => $CatalogosLlenar,
            'cantidad_existente' => round($cantidad_existente[0]->saldo_cant_ingreso, 2),
        ]);
    }
    // guardamos la salida
    public function guardarItemSalida(Request $request)
    {
        if ($request->isJson()) {
            $this->validate($request, [
                'fecha_salida' => 'required',
                'tipo_proyecto' => 'required',
                'proyecto' => 'required',
                'estructura' => 'required',
                'direccion' => 'required',
                'distrito' => 'required',
                'descripcion_trabajo' => 'required',
            ], [
                'nro_boleta.required' => 'El campo :attribute es requerido.',
                'tipo_proyecto.required' => 'El campo :attribute es requerido.',
                'proyecto.required' => 'El campo :attribute es requerido.',
                'estructura.required' => 'El campo :attribute es requerido.',
                'direccion.required' => 'El campo :attribute es requerido.',
                'distrito.required' => 'El campo :attribute es requerido.',
                'descripcion_trabajo.required' => 'El campo :attribute es requerido.',
            ]);

            $SalidasArray = SalidaModels::all();
            $num_reg_mant_prev = count($SalidasArray);
            $num_reg_mant_prev = $num_reg_mant_prev + 1;
            $numero_salida = str_pad($num_reg_mant_prev, 5, "0", STR_PAD_LEFT);


            $user = User::select('*')
                ->where(['id' => intval(auth()->id())])
                ->first();
            $fecha_salida = $request->fecha_salida == '' ? date("Y-m-d H:i:s") : $request->fecha_salida;
            $tipo_proyecto = $request->tipo_proyecto == '' ? '' : $request->tipo_proyecto;
            $proyecto = $request->proyecto == '' ? '' : $request->proyecto;
            $estructura = $request->estructura == '' ? '' : $request->estructura;
            $direccion = $request->direccion == '' ? '' : $request->direccion;
            $distrito = $request->distrito == '' ? 0 : $request->distrito;
            $descripcion_trabajo = $request->descripcion_trabajo == '' ? '' : $request->descripcion_trabajo;

            $salida = new SalidaModels;
            $salida->nro_boleta = $numero_salida;
            $salida->fecha_salida = $fecha_salida;
            $salida->tipo_salida = $tipo_proyecto;
            $salida->proyecto = $proyecto;
            $salida->estructura = $estructura;
            $salida->direccion = $direccion;
            $salida->distrito = $distrito;
            $salida->estado_salida = $descripcion_trabajo;
            $salida->id_usuario = $user->name;
            $salida->descripcion_trabajo = $descripcion_trabajo;
            $salida->edicion = 1;
            $salida->edicionreingreso = 1;
            $salida->entregado = 'NO';
            $salida->estado = 'AC';
            $salida->fecha_cierre_edicion = date("Y-m-d H:i:s");
            $salida->save();

            /** registramos el detalle slaida */
            $detalle_salida_temp = DetalleSalidaItemTemp::all();
            $num_items = count($detalle_salida_temp);
            $cantidad_solicitado_contando = 0;

            for ($i = 0; $i < $num_items; $i++) {
                //while ($cantidad_solicitado_contando <= $detalle_salida_temp[$i]->cantidad_salida) {
                $detalleSalida =  DB::table('detalle_salida')->insert([
                    'id_salida' => $salida->id,
                    'id_detalle_ingreso' => $detalle_salida_temp[$i]->id_detalle_ingreso,
                    'cantidad_salida' => round($detalle_salida_temp[$i]->cantidad_salida, 2),
                    'cantidad_reingreso' => 0,
                    'entregado' => 'NO',
                    'estado' => 'AC',
                    'cerrarEdicionReingreso' => 1,
                    'fecha_reingreso' => date("Y-m-d H:i:s"),
                    'created_at' => date("Y-m-d H:i:s"),
                ]);
            }
            // DB::table('detalle_salida_item_temp')->delete();

            return route('salida.updateSalida', $salida->id);
            //return $this->getUpdateSalida($salida->id);
            // return redirect()->route('user.profile', ['step' => $step, 'id' => $id]);
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }
    public function guardarItemSalidaTemp(Request $request)
    {

        $detalle_ingreso = DetalleIngresoModels::select('detalle_ingreso.saldo_cant_ingreso', 'detalle_ingreso.id', 'detalle_ingreso.id_ingreso', 'detalle_ingreso.detalle_item', 'ingreso.nro_ingreso')
            ->join('ingreso', 'ingreso.id', '=', 'detalle_ingreso.id_ingreso')
            ->where(['detalle_ingreso.id_catalogo' => intval($request->id_item_catalogo), 'detalle_ingreso.entregado' => 'NO'])
            ->where('detalle_ingreso.saldo_cant_ingreso', '>', 0)
            ->orderBy('detalle_ingreso.id', 'ASC')
            ->get();

        $num_items = count($detalle_ingreso);
        $cant_total_salida = intval($request->cant_solicitada);
        for ($i = 0; $i < $num_items; $i++) {
            if ($cant_total_salida >= 0) {

                if ($cant_total_salida == $detalle_ingreso[$i]->saldo_cant_ingreso) {
                    $detallesalidaTemp =  DB::table('detalle_salida_item_temp')->insert([
                        'id_item_catalogo' => (int)$request->id_item_catalogo,
                        'id_detalle_ingreso' => $detalle_ingreso[$i]->id,
                        'id_ingreso' => $detalle_ingreso[$i]->id_ingreso,
                        'descripcion_catalogo' => $request->item_detalle,
                        'id_unidad_medida' => $request->id_unidad_medida,
                        'unidad_medida_text' => $request->unidad_medida_text,
                        'cantidad_salida' => round($detalle_ingreso[$i]->saldo_cant_ingreso, 2),
                        'codigo' => $request->codigo,
                        'precio' => $request->precio,
                        'detalle_item' => trim($detalle_ingreso[$i]->detalle_item),
                        'nro_ingreso' => $detalle_ingreso[$i]->nro_ingreso,
                        'estado' => 'AC',
                    ]);
                    $ingreso = DetalleIngresoModels::where(['id' =>  $detalle_ingreso[$i]->id])
                        ->update([
                            'saldo_cant_ingreso' => $detalle_ingreso[$i]->saldo_cant_ingreso - $cant_total_salida,
                            'entregado' => 'NO',
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                    $cant_total_salida =    round($cant_total_salida - $detalle_ingreso[$i]->saldo_cant_ingreso, 2);
                } elseif ($cant_total_salida < $detalle_ingreso[$i]->saldo_cant_ingreso) {
                    $cant_salida_actual = round($cant_total_salida, 2);

                    $detallesalidaTemp =  DB::table('detalle_salida_item_temp')->insert([
                        'id_item_catalogo' => (int)$request->id_item_catalogo,
                        'id_detalle_ingreso' => $detalle_ingreso[$i]->id,
                        'id_ingreso' => $detalle_ingreso[$i]->id_ingreso,
                        'descripcion_catalogo' => $request->item_detalle,
                        'id_unidad_medida' => $request->id_unidad_medida,
                        'unidad_medida_text' => $request->unidad_medida_text,
                        'cantidad_salida' => $cant_salida_actual,
                        'codigo' => $request->codigo,
                        'precio' => $request->precio,
                        'detalle_item' => trim($detalle_ingreso[$i]->detalle_item),
                        'nro_ingreso' => $detalle_ingreso[$i]->nro_ingreso,
                        'estado' => 'AC',
                    ]);
                    $ingreso = DB::table('detalle_ingreso')
                        ->where('id', $detalle_ingreso[$i]->id)
                        ->update([
                            'saldo_cant_ingreso' => round(($detalle_ingreso[$i]->saldo_cant_ingreso - $cant_salida_actual), 2),
                            'entregado' => 'NO',
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                    $cant_total_salida = $cant_total_salida - $cant_salida_actual;
                } elseif ($cant_total_salida > $detalle_ingreso[$i]->saldo_cant_ingreso) {
                    $cant_salida_actual = $cant_total_salida;
                    $detallesalidaTemp =  DB::table('detalle_salida_item_temp')->insert([
                        'id_item_catalogo' => (int)$request->id_item_catalogo,
                        'id_detalle_ingreso' => $detalle_ingreso[$i]->id,
                        'id_ingreso' => $detalle_ingreso[$i]->id_ingreso,
                        'descripcion_catalogo' => $request->item_detalle,
                        'id_unidad_medida' => $request->id_unidad_medida,
                        'unidad_medida_text' => $request->unidad_medida_text,
                        'cantidad_salida' => round($detalle_ingreso[$i]->saldo_cant_ingreso, 2),
                        'codigo' => $request->codigo,
                        'precio' => $request->precio,
                        'detalle_item' => trim($detalle_ingreso[$i]->detalle_item),
                        'nro_ingreso' => $detalle_ingreso[$i]->nro_ingreso,
                        'estado' => 'AC',
                        'estado' => 'AC',
                    ]);
                    $ingreso = DB::table('detalle_ingreso')
                        ->where('id', $detalle_ingreso[$i]->id)
                        ->update([
                            'saldo_cant_ingreso' => 0,
                            'entregado' => 'NO',
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);

                    $cant_total_salida =    $cant_total_salida - ($detalle_ingreso[$i]->saldo_cant_ingreso);
                }
            }
        }
        return $detallesalidaTemp;
    }
    public function guardarItemSalidaUpdate(Request $request)
    {
        if ($request->isJson()) {
            $this->validate($request, [
                'fecha_salida' => 'required',
                'tipo_proyecto' => 'required',
                'proyecto' => 'required',
                'estructura' => 'required',
                'direccion' => 'required',
                'distrito' => 'required',
                'descripcion_trabajo' => 'required',
            ], [
                'nro_boleta.required' => 'El campo :attribute es requerido.',
                'tipo_proyecto.required' => 'El campo :attribute es requerido.',
                'proyecto.required' => 'El campo :attribute es requerido.',
                'estructura.required' => 'El campo :attribute es requerido.',
                'direccion.required' => 'El campo :attribute es requerido.',
                'distrito.required' => 'El campo :attribute es requerido.',
                'descripcion_trabajo.required' => 'El campo :attribute es requerido.',
            ]);
            //actualizacmos los campos salida
            $salidaUpdate = SalidaModels::where(['id' => $request->id_salida])
                ->update([
                    'fecha_salida' => ($request->fecha_salida),
                    'tipo_salida' => ($request->tipo_proyecto),
                    'proyecto' => ($request->proyecto),
                    'estructura' => ($request->estructura),
                    'direccion' => ($request->direccion),
                    'distrito' => ($request->distrito),
                    // 'estado_salida' => ($request->saldo_cant_ingreso),
                    'id_usuario' => auth()->id(),
                    'descripcion_trabajo' => ($request->descripcion_trabajo),
                    'edicion' => 1,
                    // 'entregado' => 'SI',
                    'fecha_cierre_edicion' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);


            return route('salida.updateSalida', $request->id_salida);
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }

    public function guardarDetalleItemUpdate(Request $request)
    {
        // var_dump($request->all());die;
        // if ($request->isJson()) {
        if ($request->all()) {

            $this->validate($request, [
                'id_salida' => 'required',
                'id_detalle_ingreso' => 'required',
                'cant_solicitada' => 'required',
                'id_item_catalogo' => 'required',
            ], [
                'id_salida_reingreso.required' => 'El campo :attribute es requerido.',
                'id_detalle_ingreso.required' => 'El campo :attribute es requerido.',
                'cant_reingreso.required' => 'El campo :attribute es requerido.',
                'id_item_catalogo.required' => 'El campo :attribute es requerido.',
            ]);

            $detalle_ingreso = DetalleIngresoModels::select('detalle_ingreso.saldo_cant_ingreso', 'detalle_ingreso.id', 'detalle_ingreso.id_ingreso', 'detalle_ingreso.detalle_item', 'ingreso.nro_ingreso')
                ->join('ingreso', 'ingreso.id', '=', 'detalle_ingreso.id_ingreso')
                ->where(['detalle_ingreso.id_catalogo' => intval($request->id_item_catalogo), 'detalle_ingreso.entregado' => 'NO'])
                ->where('detalle_ingreso.saldo_cant_ingreso', '>', 0)
                ->orderBy('detalle_ingreso.id', 'ASC')
                ->get();

            $num_items = count($detalle_ingreso);
            $cant_total_salida = round($request->cant_solicitada, 2);
            for ($i = 0; $i < $num_items; $i++) {
                if ($cant_total_salida >= 0) {

                    if ($cant_total_salida == $detalle_ingreso[$i]->saldo_cant_ingreso) {

                        $salidaItemUpdate = new DetalleSalidaModels;
                        $salidaItemUpdate->id_salida = $request->id_salida;
                        $salidaItemUpdate->id_detalle_ingreso = $detalle_ingreso[$i]->id;
                        $salidaItemUpdate->cantidad_salida = round($request->cant_solicitada, 2);
                        $salidaItemUpdate->estado = 'AC';
                        $salidaItemUpdate->entregado = 'NO';
                        $salidaItemUpdate->created_at = date("Y-m-d H:i:s");
                        $salidaItemUpdate->cantidad_reingreso = 0;
                        $salidaItemUpdate->save();

                        $ingreso = DetalleIngresoModels::where(['id' =>  $detalle_ingreso[$i]->id])
                            ->update([
                                'saldo_cant_ingreso' => round(($detalle_ingreso[$i]->saldo_cant_ingreso - $cant_total_salida), 2),
                                'entregado' => 'NO',
                                'updated_at' => date("Y-m-d H:i:s")
                            ]);
                        $cant_total_salida =    round(($cant_total_salida - $detalle_ingreso[$i]->saldo_cant_ingreso), 2);
                    } elseif ($cant_total_salida < $detalle_ingreso[$i]->saldo_cant_ingreso) {
                        $cant_salida_actual = $cant_total_salida;

                        $salidaItemUpdate = new DetalleSalidaModels;
                        $salidaItemUpdate->id_salida = $request->id_salida;
                        $salidaItemUpdate->id_detalle_ingreso = $request->id_detalle_ingreso;
                        $salidaItemUpdate->cantidad_salida = $cant_salida_actual;
                        $salidaItemUpdate->estado = 'AC';
                        $salidaItemUpdate->entregado = 'NO';
                        $salidaItemUpdate->created_at = date("Y-m-d H:i:s");
                        $salidaItemUpdate->cantidad_reingreso = 0;
                        $salidaItemUpdate->save();

                        $ingreso = DB::table('detalle_ingreso')
                            ->where('id', $detalle_ingreso[$i]->id)
                            ->update([
                                'saldo_cant_ingreso' => round(($detalle_ingreso[$i]->saldo_cant_ingreso - $cant_salida_actual), 2),
                                'entregado' => 'NO',
                                'updated_at' => date("Y-m-d H:i:s")
                            ]);
                        $cant_total_salida = round(($cant_total_salida - $cant_salida_actual), 2);
                    } elseif ($cant_total_salida > $detalle_ingreso[$i]->saldo_cant_ingreso) {
                        $cant_salida_actual = $cant_total_salida;

                        $salidaItemUpdate = new DetalleSalidaModels;
                        $salidaItemUpdate->id_salida = $request->id_salida;
                        $salidaItemUpdate->id_detalle_ingreso = $request->id_detalle_ingreso;
                        $salidaItemUpdate->cantidad_salida = round($detalle_ingreso[$i]->saldo_cant_ingreso, 2);
                        $salidaItemUpdate->estado = 'AC';
                        $salidaItemUpdate->entregado = 'NO';
                        $salidaItemUpdate->created_at = date("Y-m-d H:i:s");
                        $salidaItemUpdate->cantidad_reingreso = 0;
                        $salidaItemUpdate->save();

                        $ingreso = DB::table('detalle_ingreso')
                            ->where('id', $detalle_ingreso[$i]->id)
                            ->update([
                                'saldo_cant_ingreso' => 0,
                                'entregado' => 'NO',
                                'updated_at' => date("Y-m-d H:i:s")
                            ]);

                        $cant_total_salida =    round(($cant_total_salida - ($detalle_ingreso[$i]->saldo_cant_ingreso)), 2);
                    }
                }
            }


            return $salidaItemUpdate;
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }
    public function updateReingreso(Request $request)
    {
        if ($request->all()) {

            $this->validate($request, [
                'id_salida_reingreso' => 'required',
                'id_detalle_ingreso' => 'required',
                'id_detalle_salida' => 'required',
                'cant_reingreso' => 'required',
            ], [
                'id_salida_reingreso.required' => 'El campo :attribute es requerido.',
                'id_detalle_ingreso.required' => 'El campo :attribute es requerido.',
                'id_detalle_salida.required' => 'El campo :attribute es requerido.',
                'cant_reingreso.required' => 'El campo :attribute es requerido.',
            ]);
            //actualizacmos los campos salida
            $salidaUpdate = DetalleSalidaModels::where(['id' => $request->id_detalle_salida, 'id_salida' => $request->id_salida_reingreso])
                ->update([
                    'cantidad_reingreso' => round($request->cant_reingreso, 2),
                    'fecha_reingreso' => date("Y-m-d H:i:s"),
                ]);


            return $salidaUpdate;
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }
    public function guardarItemEdicionAbierta(Request $request)
    {
        $detallesalidaUpdate = false;
        if ($request->all()) {

            $this->validate($request, [
                'id_salida_reingreso' => 'required',
                'id_detalle_ingreso' => 'required',
                'id_detalle_salida' => 'required',
                'cant_reingreso' => 'required',
            ], [
                'id_salida_reingreso.required' => 'El campo :attribute es requerido.',
                'id_detalle_ingreso.required' => 'El campo :attribute es requerido.',
                'id_detalle_salida.required' => 'El campo :attribute es requerido.',
                'cant_reingreso.required' => 'El campo :attribute es requerido.',
            ]);
            //actualizacmos los campos salida
            // $salidaUpdate = DetalleSalidaModels::where(['id' => $request->id_detalle_salida, 'id_salida' => $request->id_salida_reingreso])
            //     ->update([
            //         'cantidad_reingreso' => ($request->cant_reingreso),
            //         'fecha_reingreso' => date("Y-m-d H:i:s"),
            //     ]);

            $detallesalidaUpdate =  DB::table('detalle_salida')->insert([
                'id_salida' => (int)$request->id_item_catalogo,
                'id_detalle_ingreso' => $request->id_detalle_ingreso,
                'cantidad_salida' => round($request->cant_solicitada, 2),
                'estado' => 'AC',
                'entregado' => $request->id_ingreso,
                'cantidad_reingreso' => 0,
                'fecha_reingreso' => date("Y-m-d H:i:s")
            ]);


            return $detallesalidaUpdate;
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }

    public function getUpdateSalida($id)
    {
        $SalidasArray = SalidaModels::Select('*')
            ->where('salida.id', $id)
            ->get();

        $edicion = $SalidasArray[0]->edicion;
        $edicionreingreso = $SalidasArray[0]->edicionreingreso;

        $Catalogos = CatalogoModels::select('catalogo.id', 'catalogo.descripcion_catalogo')
            ->join('detalle_ingreso', 'detalle_ingreso.id_catalogo', '=', 'catalogo.id')
            ->where('detalle_ingreso.saldo_cant_ingreso', '>', 0)
            ->where('detalle_ingreso.entregado', 'NO')
            ->get();
        $Name = Auth::user()->name;
        // $ingresos = IngresoModels::Select('ingreso.*')
        //     ->where('id', $id)
        //     ->get();
        // $edicion = $salidaArray->edicion;

        //limpiamos la tabla temp
        //registramos a la tabla temporal.
        $detalle_ingresos = DetalleSalidaModels::select('*')
            ->join('detalle_ingreso', 'detalle_ingreso.id', '=', 'detalle_salida.id_detalle_ingreso')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->join('categoria', 'categoria.id', '=', 'catalogo.id_categoria')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->where('detalle_salida.id_salida', $id)
            ->get();
        // $detalle_ingreso_item_temp = DB::table('detalle_ingreso_item_temp')->delete();

        return view('egreso.updateSalida', [
            'salidas' => $SalidasArray,
            'detalle_ingresos'  => $detalle_ingresos,
            'catalogos'      => $Catalogos,
            'Name'      => $Name,
            'edicion'      => $edicion,
            'edicionreingreso'      => $edicionreingreso,
        ]);
        // return response([
        //     'status' => true,
        //     'response' => $detalle_ingresos
        // ], 200);
    }
    public function getReingresoSalida($id)
    {
        $data = [];

        // $ingresos = IngresoModels::Select('ingreso.*')
        //     ->where('id', $id)
        //     ->get();
        // $edicion = $salidaArray->edicion;

        $Catalogos = DetalleIngresoModels::select('catalogo.descripcion_catalogo', 'catalogo.id')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->groupBy('catalogo.id')
            ->havingRaw('SUM(detalle_ingreso.saldo_cant_ingreso) > 0')
            ->get();


        //limpiamos la tabla temp
        //registramos a la tabla temporal.
        $data = DetalleSalidaModels::select('detalle_salida.id', 'salida.id_usuario', 'salida.id as id_salida', 'detalle_salida.cantidad_salida', 'ingreso.nro_ingreso', 'salida.nro_boleta', 'salida.edicion', 'catalogo.descripcion_catalogo', 'unidad_medida.descripcion_unidad_medida',)
            ->join('salida', 'salida.id', '=', 'detalle_salida.id_salida')
            ->join('detalle_ingreso', 'detalle_ingreso.id', '=', 'detalle_salida.id_detalle_ingreso')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->join('ingreso', 'ingreso.id', '=', 'detalle_ingreso.id_ingreso')
            ->where('salida.id', $id)
            ->get();

        // $nameUser = User::select('users.name')
        // ->where(['id' => intval($data[0]->id_usuario)])
        // ->first();
        //  var_dump($nameUser);die;
        //    $Name = $nameUser->name;

        // $detalle_ingreso_item_temp = DB::table('detalle_ingreso_item_temp')->delete();

        $id_salida = $id;

        // $SalidasArray = SalidaModels::Select('*')
        //     ->join('detalle_salida', 'detalle_salida.id_salida', '=', 'salida.id')
        //     ->where('salida.id', $id)
        //     ->get();


        $salidas = DB::table('salida')
            ->where('salida.id', $id)
            ->get();


        $edicionReingreso = $salidas[0]->edicionreingreso;
        //  var_dump($salidas[0]->edicionreingreso);die;
        return view('reingreso.reingresoSalida', [
            'salidas' => $salidas,
            'CatalogosLlenar'  => $data,
            // 'nameUser'      => 'sdfsdfsd',
            'catalogos' => $Catalogos,
            'edicionReingreso'      => $edicionReingreso,
            'id_salida'      => $id,
        ]);
        // return response([
        //     'status' => true,
        //     'response' => $detalle_ingresos
        // ], 200);
    }

    public function catalogotempSalida()
    {
        $data = DB::table('detalle_salida_item_temp')->get();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function dataTabledetalleSalida(Request $request)
    {
        $id_salida = intval($request->id);
        //console.log($id_salida);
        $data = DetalleSalidaModels::select('detalle_salida.id', 'detalle_salida.cantidad_salida', 'ingreso.nro_ingreso', 'salida.nro_boleta', 'salida.edicion', 'catalogo.descripcion_catalogo', 'unidad_medida.descripcion_unidad_medida',)
            ->join('salida', 'salida.id', '=', 'detalle_salida.id_salida')
            ->join('detalle_ingreso', 'detalle_ingreso.id', '=', 'detalle_salida.id_detalle_ingreso')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->join('ingreso', 'ingreso.id', '=', 'detalle_ingreso.id_ingreso')
            ->where('salida.id', $id_salida)
            ->get();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function dataTabledetalleSalidaReingreso(Request $request)
    {
        $id_salida = intval($request->id);
        //console.log($id_salida);
        $data = DetalleSalidaModels::select('detalle_salida.id', 'salida.edicionreingreso', 'detalle_salida.cantidad_salida', 'detalle_salida.cantidad_reingreso', 'ingreso.nro_ingreso', 'salida.nro_boleta', 'salida.edicion', 'catalogo.descripcion_catalogo', 'unidad_medida.descripcion_unidad_medida',)
            ->join('detalle_ingreso', 'detalle_ingreso.id', '=', 'detalle_salida.id_detalle_ingreso')
            ->join('salida', 'salida.id', '=', 'detalle_salida.id_salida')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->join('ingreso', 'ingreso.id', '=', 'detalle_ingreso.id_ingreso')
            ->where('detalle_salida.id_salida', $id_salida)
            ->get();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    public function getItemSalidareingreso(Request $request)
    {
        //console.log($id_salida);
        $data = DetalleSalidaModels::select('detalle_salida.*', 'detalle_salida.id as id_detalle_salida', 'catalogo.*', 'catalogo.id as id_catalogo', 'unidad_medida.descripcion_unidad_medida', 'detalle_ingreso.detalle_item')
            ->join('salida', 'salida.id', '=', 'detalle_salida.id_salida')
            ->join('detalle_ingreso', 'detalle_ingreso.id', '=', 'detalle_salida.id_detalle_ingreso')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->where('detalle_salida.id', intval($request->id))
            ->get();
        return $data;
    }

    public function eliminarItemDetalleIngreso(Request $request)
    {

        // obtenemos  con el id salida_temp id_detalle_ingreso y la cantidad de salida
        $detalle_ingreso_temp = DetalleSalidaItemTemp::select('cantidad_salida', 'id_detalle_ingreso')
            ->where(['id' => intval($request->id)])
            ->first();


        $detalle_ingreso = DB::table('detalle_ingreso')->select('saldo_cant_ingreso')
            ->where(['id' => intval($detalle_ingreso_temp->id_detalle_ingreso)])
            ->first();

        //  var_dump($detalle_ingreso_temp->saldo_cant_ingreso);die;

        $ingreso = DetalleIngresoModels::where(['id' => intval($detalle_ingreso_temp->id_detalle_ingreso)])
            ->update([
                'saldo_cant_ingreso' => round(($detalle_ingreso->saldo_cant_ingreso +  $detalle_ingreso_temp->cantidad_salida), 2),
                'entregado' => 'NO',
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        $eliminar = DB::table('detalle_salida_item_temp')->whereId($request->id)->delete();

        return $eliminar;
    }
    public function cancelarItemSalidaTemp(Request $request)
    {
        // var_dump($request->id_detalle_ingreso);die;
        if ($request->id_detalle_ingreso != '0') {
            $detalle_ingreso_temp = DetalleSalidaItemTemp::select('cantidad_salida', 'id_detalle_ingreso')
                ->where(['id_detalle_ingreso' => intval($request->id_detalle_ingreso)])
                ->first();

            if ($detalle_ingreso_temp) {
                $num_items = count($detalle_ingreso_temp);
                for ($i = 0; $i < $num_items; $i++) {

                    $detalle_ingreso = DB::table('detalle_ingreso')->select('saldo_cant_ingreso')
                        ->where(['id' => intval($detalle_ingreso_temp[$i]->id_detalle_ingreso)])
                        ->first();

                    //  var_dump($detalle_ingreso_temp[$i]->saldo_cant_ingreso);die;

                    $ingreso = DetalleIngresoModels::where(['id' => intval($request->id_detalle_ingreso)])
                        ->update([
                            'saldo_cant_ingreso' => round(($detalle_ingreso->saldo_cant_ingreso +  $detalle_ingreso_temp[$i]->cantidad_salida), 2),
                            'entregado' => 'NO',
                            'updated_at' => date("Y-m-d H:i:s")
                        ]);
                }
            }
            $eliminar = DB::table('detalle_salida_item_temp')->whereId($request->id)->delete();
            return redirect()->route('egreso');
        } else {
            $ruta = route('egreso');
            return $ruta;
        }
    }
    public function eliminarItemDetalleIngresoUpdate(Request $request)
    {
        // obtenemos  con el id salida_temp id_detalle_ingreso y la cantidad de salida
        $detalle_salida_update = DetalleSalidaModels::select('cantidad_salida', 'id_detalle_ingreso')
            ->where(['id' => intval($request->id)])
            ->first();
        $detalle_ingreso = DB::table('detalle_ingreso')->select('saldo_cant_ingreso')
            ->where(['id' => intval($detalle_salida_update->id_detalle_ingreso)])
            ->first();
        $ingreso = DetalleIngresoModels::where(['id' => intval($detalle_salida_update->id_detalle_ingreso)])
            ->update([
                'saldo_cant_ingreso' => round(($detalle_ingreso->saldo_cant_ingreso +  $detalle_salida_update->cantidad_salida), 2),
                'entregado' => 'NO',
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        $eliminar = DB::table('detalle_salida')->whereId($request->id)->delete();


        return $eliminar;
    }

    public function cerrarEdicionSalida(Request $request)
    {
        //$request->all();die;
        if ($request->id_salida) {
            $salidas = SalidaModels::where(['id' => $request->id_salida])
                ->update([
                    'edicion' => 0,
                    'entregado' => 'SI',
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            DB::table('detalle_salida_item_temp')->delete();
            return $salidas;
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }

    public function cerrarEdicionReingreso(Request $request)
    {
        // $id_detalle_salida = $request->id_detalle_salida;
        // $id_detalle_ingreso = $request->id_detalle_ingreso;
        // $id_salida = $request->id_salida;
        // $cant_reingreso = $request->cant_reingreso;
        //$request->all();die;
        if ($request->all()) {
            $salidasDetalle = DetalleSalidaModels::where(['id' => $request->id_detalle_salida])
                ->update([
                    'cerrarEdicionReingreso' => 0,
                    'entregado' => 'SI',
                    'fecha_reingreso' => date("Y-m-d H:i:s")
                ]);
            $salidas = SalidaModels::where(['id' => $request->id_salida])
                ->update([
                    'edicionreingreso' => 0,
                    'entregado' => 'SI',
                    'updated_at' => date("Y-m-d H:i:s")
                ]);

            $ingresoDetalle = DetalleIngresoModels::select('saldo_cant_ingreso')
                ->where(['id' => intval($request->id_detalle_ingreso)])
                ->orderBy('created_at', 'DESC')
                ->first();

            $cant_reingreso = ($request->cant_reingreso == null) ? 0 : $request->cant_reingreso;

            $detalleIngreso = DetalleIngresoModels::where(['id' => $request->id_detalle_ingreso])
                ->update([
                    'entregado' => 'NO',
                    'saldo_cant_ingreso' => round(($ingresoDetalle->saldo_cant_ingreso +  $cant_reingreso), 2),
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            DB::table('detalle_salida_item_temp')->delete();

            return $detalleIngreso;
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }
    public function limpiarSalida(Request $request)
    {
        //obtenemos todas las items salidas registradas en la tabla temp
        $detalle_ingreso_temp  = DetalleSalidaItemTemp::all();
        // var_dump($detalle_ingreso_temp);die;
        if ($detalle_ingreso_temp) {
            $num_items = count($detalle_ingreso_temp);
            for ($i = 0; $i < $num_items; $i++) {
                $detalle_ingreso = DB::table('detalle_ingreso')->select('saldo_cant_ingreso')
                    ->where(['id' => intval($detalle_ingreso_temp[$i]->id_detalle_ingreso)])
                    ->first();
                //  var_dump($detalle_ingreso_temp->saldo_cant_ingreso);die;
                $ingreso = DetalleIngresoModels::where(['id' => intval($detalle_ingreso_temp[$i]->id_detalle_ingreso)])
                    ->update([
                        'saldo_cant_ingreso' => round(($detalle_ingreso->saldo_cant_ingreso + $detalle_ingreso_temp[$i]->cantidad_salida), 2),
                        'entregado' => 'NO',
                        'updated_at' => date("Y-m-d H:i:s")
                    ]);
            }
            $eliminar = DB::table('detalle_salida_item_temp')->delete();
            return $eliminar;
        } else {
            return 0;
        }
    }
    public function detallesalida(Request $request)
    {

        $DetalleSalidas = DetalleSalidaModels::Select(
            'detalle_salida.id',
            'salida.nro_boleta',
            'catalogo.descripcion_catalogo',
            'detalle_salida.estado',
            'detalle_salida.cantidad',
            'detalle_salida.saldo',
        )
            ->join('catalogo', 'detalle_salida.id_catalogo', '=', 'catalogo.id')
            ->join('salida', 'detalle_salida.id_salida', '=', 'salida.id')
            ->where('salida.nro_boleta', $request->nro_boleta_salida)
            ->groupBy(
                'detalle_salida.id',
                'salida.nro_boleta',
                'catalogo.descripcion_catalogo',
                'detalle_salida.estado',
                'detalle_salida.cantidad',
                'detalle_salida.saldo'
            )
            ->get();
        //dd($DetalleSalidas);
        return DataTables()->of($DetalleSalidas)->toJson();
    }

    public function listaSalida(Request $request)
    {

        $DetalleSalidas  = SalidaModels::all();
        //dd($DetalleSalidas);
        return DataTables()->of($DetalleSalidas)->toJson();
    }


    public function  salidasChartjs(Request $request)
    {
        $DetalleSalidas  = SalidaModels::all();
        //dd($DetalleSalidas);
        return DataTables()->of($DetalleSalidas)->toJson();
    }
}
