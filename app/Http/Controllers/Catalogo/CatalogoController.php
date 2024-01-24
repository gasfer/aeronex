<?php

namespace App\Http\Controllers\Catalogo;

use App\Http\Controllers\Controller;
use App\Models\CatalogoModels;
use App\Models\DetalleIngresoItemTemp;
use App\Models\CategoriaModels;
use App\Models\DetalleIngresoModels;
use App\Models\UnidadMedidaModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatalogoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $UnidadMedidas = UnidadMedidaModels::all();
        $categoria = CategoriaModels::all();
        $list_catalogo = CatalogoModels::select(
            'catalogo.id',
            'catalogo.codigo',
            'catalogo.estado',
            'unidad_medida.descripcion_unidad_medida',
            'catalogo.descripcion_catalogo',
            'categoria.nombre_categoria',
        )
            ->join('unidad_medida', 'catalogo.id_unidad_medida', '=', 'unidad_medida.id')
            ->join('categoria', 'categoria.id', '=', 'catalogo.id_categoria')
            ->get();


        //       var_dump($list_catalogo);die;
        $Name = Auth::user()->name;
        return view('admin.catalogo.index', [

            'UnidadMedidas' => $UnidadMedidas,
            'categoria' => $categoria,
            'Name' => $Name,
            'list_catalogo' => $list_catalogo
        ]);
    }

    public function createItem(Request $request)
    {
        if ($request->isJson()) {
            $this->validate($request, [
                'codigo' => 'required|unique:catalogo|max:9',
                'descripcion_catalogo' => 'required',
                'id_unidad_medida' => 'required',
                'id_categoria' => 'required',

            ], [
                'codigo.unique' => 'El código: ' . $request->codigo . ' ya se encuentra en uso!.',
                'codigo.required'    => 'El campo código de del catalogo es obligatorio!',

                'descripcion_catalogo.required'  => 'El campo descripcion del catalogo  es obligatorio!',
                'min' => 'El :attribute debe tener al menos 8 caracteres.',
                'id_unidad_medida.required' => 'El campo :attribute es requerido.',
                'id_categoria.required' => 'El campo :attribute es requerido.'
            ]);
            // $catalogo = CatalogoModels::create($request->all());
            $new_catologo =  CatalogoModels::create([
                'codigo' => trim($request->codigo),
                'descripcion_catalogo' => trim($request->descripcion_catalogo),
                'id_unidad_medida' => trim($request->id_unidad_medida),
                'id_categoria' => trim($request->id_categoria),
            ]);
            return response([
                'status' => true,
                'response' => $new_catologo
            ], 201);
        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }

    public function store(Request $request)
    {

        $catalogo = CatalogoModels::create($request->all());
        $UnidadMedidas = UnidadMedidaModels::all();
        //return $catalogo;   

        $Name = Auth::user()->name;
        return view('admin.catalogo.index', [
            'UnidadMedidas' => $UnidadMedidas,
            'Name' => $Name,
        ]);
    }
    public function updateCatalogo(Request $request)
    {

        $this->validate($request, [
            'codigo' => 'required|max:9',
            'descripcion_catalogo' => 'required',
            'id_unidad_medida' => 'required',
            'id_categoria' => 'required',
            'id_catalogo' => 'required',

        ], [
            'codigo.unique' => 'El código: ' . $request->codigo . ' ya se encuentra en uso!.',
            'codigo.required'    => 'El campo código de del catalogo es obligatorio!',
            'descripcion_catalogo.required'  => 'El campo descripcion del catalogo  es obligatorio!',
            'min' => 'El :attribute debe tener al menos 8 caracteres.',
            'id_unidad_medida.required' => 'El campo :attribute es requerido.',
            'id_categoria.required' => 'El campo :attribute es requerido.'
        ]);

        $catalogoUpdate =  CatalogoModels::where('id', $request->id_catalogo)
            ->update([
                'codigo' => trim($request->codigo),
                'descripcion_catalogo' => trim($request->descripcion_catalogo),
                'id_unidad_medida' => trim($request->id_unidad_medida),
                'id_categoria' => trim($request->id_categoria),
                // 'estado' => $request->estado_edit,
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        return response([
            'status' => true,
            'response' => 'done'
        ], 200);
    }
    public function getEditItem($id)
    {
        $catalogos = CatalogoModels::Select(
            'catalogo.id',
            'catalogo.codigo',
            'catalogo.descripcion_catalogo',
            'catalogo.estado',
            'unidad_medida.descripcion_unidad_medida',
            'catalogo.id_categoria',
            'catalogo.id_unidad_medida',
        )->join('unidad_medida', 'catalogo.id_unidad_medida', '=', 'unidad_medida.id')
            ->join('categoria', 'categoria.id', '=', 'catalogo.id_categoria')
            ->where('catalogo.id', $id)
            ->get();
        // var_dump($catalogos);die;
        return response([
            'status' => true,
            'response' => $catalogos
        ], 200);
    }
    public function disableItem($id)
    {

        $existeCatalogos = DetalleIngresoModels::select('catalogo.descripcion_catalogo', 'catalogo.id')
            ->join('catalogo', 'catalogo.id', '=', 'detalle_ingreso.id_catalogo')
            ->where('catalogo.id',$id)
            ->groupBy('catalogo.id','detalle_ingreso.saldo_cant_ingreso')
            ->havingRaw('SUM(detalle_ingreso.saldo_cant_ingreso) > 0')
            ->exists();
        // var_dump($existeCatalogos);die;
        if ($existeCatalogos == true) {
            return response(['status' => false, 'response' => '!No es posible, desactivar, devidoa que el stock es > 0.'], 200);
        } else {
            $item = CatalogoModels::select()
                ->where('id', $id)
                ->first();
            if ($item->estado == 'AC') {

                $disable_item =  CatalogoModels::where('id', $item->id)
                    ->update(['estado' => 'DC']);

                return response(['status' => true, 'response' => '!item desactivado!'], 200);
            } else {
                CatalogoModels::where(['id' => $item->id])
                    ->update(['estado' => 'AC']);

                return response([
                    'status' => true,
                    'response' => '!item desactivado!'
                ], 200);
            }
        }
    }
    public function catalogo()
    {
        $catalogos = CatalogoModels::Select(
            'catalogo.id',
            'catalogo.codigo',
            'catalogo.descripcion_catalogo',
            'unidad_medida.descripcion_unidad_medida',
            'categoria.codigo'
        )->join(
            'unidad_medida',
            'catalogo.id_unidad_medida',
            '=',
            'unidad_medida.id'
        )
            ->join(
                'categoria',
                'catalogo.id_categoria',
                '=',
                'categoria.id'
            )
            ->get();

        return $catalogos->toJson();
    }

    public function catalogotemp()
    {
        $detalleIngresoTemp = DetalleIngresoItemTemp::Select(
            'id',
            'codigo',
            'descripcion_catalogo',
            'id_unidad_medida',
            'cantidad_ingreso',
            'precio_ingreso'
        )->get();
        return $detalleIngresoTemp->toJson();
    }
}
