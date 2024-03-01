<?php

namespace App\Http\Controllers\metar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RecepcionRegistroModels;
use App\Models\EstacionTerminalModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MetarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       // $metars = RecepcionRegistroModels::all();

        $metars= RecepcionRegistroModels::select('recepcion_registro.*',  DB::raw('CONCAT(estacion_terminal.codigo_estacion , \' - \',estacion_terminal.nombre_estacion) AS estacion_terminal'))
        ->leftJoin('estacion_terminal', 'estacion_terminal.id', '=', 'recepcion_registro.id_estacion_terminal')
        ->orderBy('id', 'DESC')
         ->get();

        $estacion_terminal = EstacionTerminalModels::select("estacion_terminal.id",
        DB::raw("CONCAT(estacion_terminal.codigo_estacion,' -  ',estacion_terminal.nombre_estacion) as estacion_terminal"))->get();



      // dd($estacion_terminal);
        return view('metar.index', [
            'metars' => $metars,
            'estacion_terminal' => $estacion_terminal,
        ]);
    }

    public function storeMetar(Request $request)
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

            $new_metar =  RecepcionRegistroModels::create([
                'id_estacion_terminal' => $request->estacion_terminal,
                'id_usuario' =>  auth()->id(),
                'tipo_registro' => 1, //metar
                'nombre_registro' => 'ninguna',
                'fecha_recepcionado' => trim($request->fecha_registro),
                'mensaje' => trim($request->mensaje),
            ]);
            $metars = RecepcionRegistroModels::all();
            $estacion_terminal = EstacionTerminalModels::select("estacion_terminal.id",
            DB::raw("CONCAT(estacion_terminal.codigo_estacion,' -  ',estacion_terminal.nombre_estacion) as estacion_terminal"))->get();

            return view('metar.index', [
                'metars' => $metars,
                'estacion_terminal' => $estacion_terminal
            ]);

        } else {

            return response([
                'status' => false,
                'message' => 'Error 401 (Unauthorized)'
            ], 401);
        }
    }

    public function deleteMetar(Request $request)
    {


        $eliminar = DB::table('recepcion_registro')->whereId($request->id)->delete();
        return route('metar');
        // $metars = RecepcionRegistroModels::all();
        // $estacion_terminal = EstacionTerminalModels::select("estacion_terminal.id",
        // DB::raw("CONCAT(estacion_terminal.codigo_estacion,' -  ',estacion_terminal.nombre_estacion) as estacion_terminal"))->get();

        // return view('metar.index', [
        //     'metars' => $metars,
        //     'estacion_terminal' => $estacion_terminal
        // ]);

    }

}
