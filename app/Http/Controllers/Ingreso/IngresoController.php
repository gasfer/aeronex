<?php

namespace App\Http\Controllers\Ingreso;

use DataTables;
use App\Http\Controllers\Controller;
use App\Models\CatalogoModels;
use App\Models\DetalleIngresoItemTemp;
use App\Models\DetalleIngresoModels;
use App\Models\IngresoModels;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IngresoController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $Ingresos = IngresoModels::all();
        return view('ingreso.index', [
            'Ingresos'  => $Ingresos,
        ]);
    }
    public function create()
    {
        $Catalogos = CatalogoModels::select('catalogo.id', 'catalogo.codigo', 'catalogo.estado','catalogo.descripcion_catalogo')
        ->where('catalogo.estado', 'AC')
        ->get();

        $Ingresos = IngresoModels::all();
        $Name = Auth::user()->name;
        DB::table('detalle_ingreso_item_temp')->delete();
        return view('ingreso.create', [
            'Catalogos' => $Catalogos,
            'Ingresos'  => $Ingresos,
            'Name'      => $Name,
        ]);
    }

    public function storedetalleingreso(Request $request)
    {
        if ($request->isJson()) {
            //dd($request->all());
            $this->validate($request, [
                'codigo' => 'required',
                'select_id_catalogo_Modal' => 'required',
                'descripcion_catalogo' => 'required|max:10',
                'id_unidad_medida' => 'required',
                'cantidad_ingreso' => 'required',
                'precio_ingreso' => 'required',
            ], [
                'select_id_catalogo_Modal.required'    => 'Es necesario seleccionar un item!',
                'codigo.required'    => 'El campo Número de Ingreso es obligatorio!',
                'descripcion_catalogo.required'    => 'El campo de la descripcion es obligatorio!',
                'cantidad_ingreso.required'  => 'El campo cantidad es obligatorio!',
                'precio_ingreso.required' => 'El campo :attribute es requerido.',
            ]);
            $Catalogos = CatalogoModels::select('catalogo.id', 'catalogo.codigo', 'catalogo.estado','catalogo.descripcion_catalogo')
            ->where('catalogo.estado', 'AC')
            ->get();            $Ingresos = IngresoModels::all();
            $DetalleIngrso = DetalleIngresoModels::create($request->all());

            return response([
                'status' => true,
                'response' => $DetalleIngrso
            ], 201);
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }

        //return $DetalleIngrso;
        // $Name = Auth::user()->name;
        // return view('Items.Ingreso.create', [
        //     'Catalogos' => $Catalogos,
        //     'Ingresos' => $Ingresos,
        //     'Name'      => $Name,
        // ]);
    }
    public function storeitems(Request $request)
    {

        if ($request->isJson()) {
            $this->validate($request, [
                'nro_ingreso' => 'required|unique:ingreso|max:9',
                'nro_egreso' => 'required|unique:ingreso|max:9',
                'almacen' => 'required',
                'observaciones' => 'required',
                'procedencia' => 'required',
                'orden_compra' => 'required',
                
            ], [
                'nro_ingreso.unique' => 'El campo Número de Ingreso: ' . $request->nro_ingreso . ' ya se encuentra en uso!.',
                'nro_ingreso.required'    => 'El campo Número de Ingreso es obligatorio!',

                'nro_egreso.unique' => 'El campo Número de Egreso: ' . $request->nro_egreso . ' ya se encuentra en uso!.',
                'nro_egreso.required'    => 'El campo campo Número de Egreso es obligatorio!',

                'descripcion_catalogo.required'  => 'El campo descripcion del Ingreso de Item es obligatorio!',
                'almacen.required' => 'El campo :attribute es requerido.',
                'observaciones.required' => 'El campo :attribute es requerido.',
                'orden_compra.required' => 'El campo :attribute es requerido.',
                'procedencia.required' => 'El campo :attribute es requerido.',
            ]);
            $LisCatalogos = CatalogoModels::all();
            $Ingresos = IngresoModels::all();
            $Name = Auth::user()->name;


            $CatalogosTemp = DetalleIngresoItemTemp::all();
            if ($CatalogosTemp->isEmpty()) { //si es vacio
                $request->session()->flash('alert', 'es necesario ingresar items.');
                return view('Items.Ingreso.create', [
                    'Catalogos' => $LisCatalogos,
                    'Ingresos' => $Ingresos,
                    'Name'      => $Name,
                ]);
            } else { //si CatalogosTemp no es vacio 

                $ingreso = new IngresoModels;
                $ingreso->nro_ingreso = $request->nro_ingreso;
                $ingreso->nro_egreso = $request->nro_egreso;
                $ingreso->almacen = $request->almacen;
                $ingreso->funcionario = $request->funcionario;
                $ingreso->id_usuario = auth()->id();
                $ingreso->estado = 'AC';
                $ingreso->observaciones = $request->observaciones;
                $ingreso->edicion = 1;
                $ingreso->fecha_cierre = date("Y-m-d H:i:s");
                $ingreso->orden_compra = $request->orden_compra;
                $ingreso->procedencia = $request->procedencia;
                $ingreso->save();

                $id_ingreso =  (int)$ingreso->id;

                $num_items = sizeof($CatalogosTemp);
                $item = new DetalleIngresoModels;
                //var_dump($ingreso);die;
                for ($i = 0; $i < $num_items; $i++) {
                    $detalleIngrso =  DB::table('detalle_ingreso')->insert([
                        'id_ingreso' => $id_ingreso,
                        //'id_detalle_ingreso' => $CatalogosTemp[$i]->id,
                        'id_catalogo' => $CatalogosTemp[$i]->id_item_catalogo,
                        'cantidad' => round($CatalogosTemp[$i]->cantidad_ingreso, 2),
                        'precio' => round($CatalogosTemp[$i]->precio_ingreso, 2),
                        'saldo_cant_ingreso' => round($CatalogosTemp[$i]->cantidad_ingreso, 2),
                        'saldo_stock' => (DetalleIngresoModels::Select('cantidad')->where('id', $CatalogosTemp[$i]->id)->sum('cantidad')) + $CatalogosTemp[$i]->item_cantidad,
                        'detalle_item' => trim($CatalogosTemp[$i]->detalle_item),
                        'created_at' => date("Y-m-d H:i:s"),
                    ]);
                }
                // return view('ingreso.edit', [
                //     'ingresos' => $Ingresos,
                //     'detalle_ingresos'  => $detalle_ingresos,
                //     'Catalogos'      => $LisCatalogos,
                //     'Name'      => $Name,
                // ]);
                return route('ingreso.edit', $id_ingreso);
            }
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }
    public function cerrarEdicionIngreso(Request $request)
    {
        //$request->all();die;
        if ($request->id_ingreso) {

            $ingreso = IngresoModels::where(['id' => $request->id_ingreso])
                ->update([
                    'edicion' => 0,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            return $ingreso;
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }
    public function storeitemsUpdate(Request $request)
    {
        if ($request->isJson()) {
            $this->validate($request, [
                'id_ingreso' => 'required',
                'nro_ingreso' => 'required:ingreso|max:9',
                'nro_egreso' => 'required:ingreso|max:9',
                'almacen' => 'required',
                'observaciones' => 'required',
                'procedencia' => 'required',
                'orden_compra' => 'required',

            ], [
                'nro_ingreso.required'    => 'El campo Número de Ingreso es obligatorio!',

                'nro_egreso.required'    => 'El campo campo Número de Egreso es obligatorio!',

                'descripcion_catalogo.required'  => 'El campo descripcion del Ingreso de Item es obligatorio!',
                'almacen.required' => 'El campo :attribute es requerido.',
                'procedencia.required' => 'El campo :attribute es requerido.',
                'orden_compra.required' => 'El campo :attribute es requerido.',
            ]);

            $CatalogosTemp = DetalleIngresoItemTemp::all();
            if ($CatalogosTemp->isEmpty()) {
                $LisCatalogos = DetalleIngresoItemTemp::all();
                $Ingresos = IngresoModels::all();
                $Name = Auth::user()->name;
                return view('Items.Ingreso.create', [
                    'Catalogos' => $LisCatalogos,
                    'Ingresos' => $Ingresos,
                    'Name'      => $Name,
                ]);
            } else {
                $ingreso = IngresoModels::where(['id' => $request->id_ingreso])
                    ->update([
                        'nro_ingreso' => trim($request->nro_ingreso),
                        'nro_egreso' => trim($request->nro_egreso),
                        'almacen' => trim($request->almacen),
                        'funcionario' => trim($request->funcionario),
                        'observaciones' => trim($request->observaciones),
                        'orden_compra' => trim($request->orden_compra),
                        'procedencia' => trim($request->procedencia),
                        // 'detalle_item' => trim($request->detalle_item),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ]);
                return route('ingreso.edit', $request->id_ingreso);
            }
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }

    public function llenarCatalogo(Request $request)
    {
        $CatalogosLlenar = CatalogoModels::select('catalogo.id', 'catalogo.codigo', 'catalogo.estado', 'id_unidad_medida', 'unidad_medida.descripcion_unidad_medida', 'catalogo.descripcion_catalogo', 'catalogo.id')
            ->join('unidad_medida', 'catalogo.id_unidad_medida', '=', 'unidad_medida.id')
            ->where('catalogo.id', $request->select_id_catalogo)
            ->where('catalogo.estado', 'AC')
            ->get();
        // dd($CatalogosLlenar->toJson());
        return $CatalogosLlenar;
    }

    public function catalogotemp()
    {
        $data = DetalleIngresoItemTemp::select('*');
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
    //datatable update
    public function detalleIngresoUpdate(Request $request)
    {
        $data = DB::table('detalle_ingreso')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->join('categoria', 'categoria.id', '=', 'catalogo.id_categoria')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->where('id_ingreso', $request->id)
            ->select(
                'detalle_ingreso.id_ingreso',
                'detalle_ingreso.id',
                'detalle_ingreso.cantidad',
                'detalle_ingreso.id as id_detalle_ingreso',
                'detalle_ingreso.precio',
                'detalle_ingreso.saldo_cant_ingreso',
                'detalle_ingreso.saldo_stock',
                'detalle_ingreso.entregado',
                'catalogo.descripcion_catalogo',
                'catalogo.codigo',
                'categoria.nombre_categoria',
                'unidad_medida.descripcion_unidad_medida',
                'unidad_medida.id as id_unidad'
            )->get();
        return datatables::of($data)
            ->addIndexColumn()
            ->make(true);
    }

    public function geteditIngreso($id)
    {
        // $Catalogos = CatalogoModels::all();
        // var_dump($ingresos);die;
        $Catalogos = CatalogoModels::all();
        $Name = Auth::user()->name;
        $ingresos = IngresoModels::Select('ingreso.*')
            ->where('id', $id)
            ->get();
        $edicion = $ingresos[0]->edicion;

        //limpiamos la tabla temp
        //registramos a la tabla temporal. 
        $detalle_ingresos = DB::table('detalle_ingreso')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->join('categoria', 'categoria.id', '=', 'catalogo.id_categoria')
            ->join('unidad_medida', 'unidad_medida.id', '=', 'catalogo.id_unidad_medida')
            ->where('id_ingreso', $id)
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
        $detalle_ingreso_item_temp = DB::table('detalle_ingreso_item_temp')->delete();


        $item_detalle_temp = new DetalleIngresoItemTemp();
        $num_items = sizeof($detalle_ingresos);
        //var_dump($ingreso);die;
        for ($i = 0; $i < $num_items; $i++) {

            DB::table('detalle_ingreso_item_temp')->insert([
                'id_item_catalogo' => $detalle_ingresos[$i]->id,
                'id_detalle_ingreso' => $detalle_ingresos[$i]->id_detalle_ingreso,
                'codigo' => $detalle_ingresos[$i]->codigo,
                'descripcion_catalogo' => $detalle_ingresos[$i]->descripcion_catalogo,
                'id_unidad_medida' => $detalle_ingresos[$i]->id_unidad,
                'cantidad_ingreso' => round($detalle_ingresos[$i]->cantidad, 2),
                'id_ingreso' => $detalle_ingresos[$i]->id_ingreso,
                'precio_ingreso' => $detalle_ingresos[$i]->precio,
                'detalle_item' => $detalle_ingresos[$i]->detalle_item,
                'nro_ingreso' => '',
            ]);
        }


        $this->catalogotemp();
        return view('ingreso.edit', [
            'ingresos' => $ingresos,
            'detalle_ingresos'  => $detalle_ingresos,
            'Catalogos'      => $Catalogos,
            'Name'      => $Name,
            'edicion'      => $edicion,
        ]);
        // return response([
        //     'status' => true,
        //     'response' => $detalle_ingresos
        // ], 200);
    }
    public function guardarItem(Request $request)
    {
        $codigo = $request->codigo;
        $item_descripcion = $request->item_descripcion;
        $unidad_medida_modal = $request->unidad_medida_modal;
        $cantidad_ingreso = round($request->cantidad_ingreso, 2);
        $precio_ingreso = $request->precio_ingreso;
        $id_unidad_medida_temp = (int)$request->id_unidad_medida_temp;
        $id_item_catalogo = (int)$request->id_item_catalogo;
        $detalle_item = trim($request->detalle_item);

        //dd($id_unidad_medida_temp);
        $detalleIngrso =  DB::table('detalle_ingreso_item_temp')->insert([
            'codigo' => $codigo,
            'id_item_catalogo' => $id_item_catalogo,
            'descripcion_catalogo' => $item_descripcion,
            'id_unidad_medida' => $id_unidad_medida_temp,
            'cantidad_ingreso' => $cantidad_ingreso,
            'precio_ingreso' => $precio_ingreso,
            'id_detalle_ingreso' => 0,
            'id_ingreso' => 0,
            'detalle_item' => $detalle_item,
            'nro_ingreso' => ''
        ]);
        return $detalleIngrso;
    }
    public function guardarItemEdicionAbierta(Request $request)
    {
        $detalle_ingreso  =  DB::table('detalle_ingreso')->insert([
            'id_ingreso' => $request->id_ingreso,
            'id_catalogo' => $request->id_item_catalogo,
            'cantidad' => round($request->cantidad_ingreso, 2),
            'precio' => round($request->precio_ingreso, 2),
            'saldo_cant_ingreso' => round($request->cantidad_ingreso, 2),
            'saldo_stock' => (DetalleIngresoModels::Select('cantidad')->where('id', $request->id)->sum('cantidad')) + $request->item_cantidad,
            'entregado' => 'NO',
            'detalle_item' => $request->detalle_item,
            'created_at' => date("Y-m-d H:i:s"),
        ]);

        return $detalle_ingreso;
        // return $detalleIngrso;
    }
    public function eliminarItemDetalleIngreso(Request $request)
    {
        $id = (int)$request->id;
        $model = DetalleIngresoItemTemp::find($id);
        $model->delete();
        return $id;
    }
    public function eliminarItemDetalleIngresoUpdate(Request $request)
    {
        $id = (int)$request->id;
        $model = DetalleIngresoModels::find($id);
        $model->delete();
        return $id;
    }
}
