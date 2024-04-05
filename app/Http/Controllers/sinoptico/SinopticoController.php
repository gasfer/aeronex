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
        ->where('id_tipo_registro', 2)
        ->orderBy('id', 'DESC')
         ->get();

        $estacion_terminal = EstacionTerminalModels::select("estacion_terminal.id",
        DB::raw("CONCAT(estacion_terminal.codigo_estacion,' -  ',estacion_terminal.nombre_estacion) as estacion_terminal"))->get();

        return view('sinoptico.index', [
            'sinopticos'  => $sinopticos,
            'estacion_terminal'  => $estacion_terminal,
        ]);
    }
    public function storeSinoptico(Request $request)
    {
        if ($request->isJson()) {
            $this->validate(
                $request,
                [
                    'fecha_registro' => 'required',
                    'mensaje' => 'required',
                    'estacion_terminal' => 'required',
                ],
                [
                    // 'fecha_registro.unique' => 'El campo fecha_registro: ' . $request->fecha_registro . ' ya se encuentra registrado!.',
                    'fecha_registro.required' => 'El campo fecha_registro es obligatorio!',

                    // 'msg.unique' => 'El campo Mensaje: ' . $request->msg . ' ya se encuentra registrado!.',
                    'mensaje.required' => 'El campo campo Mensaje es obligatorio!',
                    'estacion_terminal.required' => 'El campo Estacion Terminal es obligatorio!',
                ],
            );
            // $catalogo = CatalogoModels::create($request->all());

            $new_sinoptico =  RecepcionRegistroModels::create([
                'id_estacion_terminal' => $request->estacion_terminal,
                'id_usuario' =>  auth()->id(),
                'id_tipo_registro' => 2, //metar
                'nombre_registro' => 'ninguna',
                'fecha_recepcionado' => trim($request->fecha_registro),
                'mensaje' => trim($request->mensaje),
            ]);

          //  $id_metar =  (int)$new_sinoptico->id;


            $sinopticos = RecepcionRegistroModels::all();
            $estacion_terminal = EstacionTerminalModels::select("estacion_terminal.id",
            DB::raw("CONCAT(estacion_terminal.codigo_estacion,' -  ',estacion_terminal.nombre_estacion) as estacion_terminal"))->get();

            return view('sinoptico.index', [
                'sinopticos' => $sinopticos,
                'estacion_terminal' => $estacion_terminal
            ]);

        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }

    public function deleteSinoptico(Request $request)
    {


        $eliminar = DB::table('recepcion_registro')->whereId($request->id)->delete();
        return route('sinoptico');
        // $metars = RecepcionRegistroModels::all();
        // $estacion_terminal = EstacionTerminalModels::select("estacion_terminal.id",
        // DB::raw("CONCAT(estacion_terminal.codigo_estacion,' -  ',estacion_terminal.nombre_estacion) as estacion_terminal"))->get();

        // return view('metar.index', [
        //     'metars' => $metars,
        //     'estacion_terminal' => $estacion_terminal
        // ]);

    }
}
