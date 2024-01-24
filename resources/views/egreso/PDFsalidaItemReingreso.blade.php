<!DOCTYPE html>

<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
            font-size: 12px;

        }

        @page {
            margin: 160px 50px;
        }

        header {
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px;
            position: fixed;
            left: 0px;
            top: -120px;
            right: 0px;
            height: 100px;

            text-align: center;
        }

        table {
            width: 100%;

        }

        /* header h1{
        margin: 10px 0;
            }
            header h2{
            margin: 0 0 10px 0;
            } */
        footer {
            position: fixed;
            left: 0px;
            bottom: -80px;
            right: 0px;
            height: 30px;
            border-bottom: 2px solid #ddd;
        }

        footer .page:after {
            content: counter(page);
        }

        footer table {
            width: 100%;
        }

        .table_foot {
            font-size: 10px;
            position: absolute;
            left: 0px;
            bottom: -50px;
            right: 0;
            height: 30px;
        }

        footer div {
            text-align: right;
        }

        footer .izq {
            text-align: left;
        }

        .txthead {
            font-size: 10px;
            text-align: center;
        }

        .txtadd {
            font-size: 10px;
            font-weight: 200;
        }

        .txtred {
            font-size: 12px;
            font-weight: bold;
            color: red;

        }

        .rotulo {
            font-size: 15px;
            font-weight: bold;
            font-style: italic;

        }

        .bold {
            font-size: 12px;
            font-weight: bold;
            font-style: italic;

        }




        .info tr:nth-child(even) {
            background: rgb(250, 250, 250)
        }

        .info tr:nth-child(odd) {
            background: #edeef0
        }

        table thead tr th {
            background-color: rgba(43, 72, 105, 0.3);
            /* padding: 5px; */
            border-collapse: collapse;
            color: rgb(4, 2, 24);

        }

        .info th,
        .info td {
            border: 0.8px rgb(218, 215, 215) solid;
            text-align: center;
            font-size: 9px;

        }

        #footer .page:after {
            content: counter(page, decimal);
        }

        .page {
            text-align: center;
            font-size: 9px;
        }

        .container {
            display: grid;
            grid-template-columns: 10fr;
            grid-template-rows: 10fr;
            grid-auto-columns: 10fr;
            grid-auto-rows: 10fr;
            gap: 50px 50px;
            grid-auto-flow: row;
            justify-items: center;
            align-items: center;
            grid-template-areas:
                ".";
        }

        .nro-css {
            color: red;
            font-size: 12px;
            background-color: #ffcaca;
            padding: 10px;
            border-radius: 5px 5px 5px;
            border: 1px solid red;
        }

        .firmas {
            width: 100%;
            height: 30px;
            /* border: 1px solid red; */
            margin: 50 auto;
            bottom: -1px;
            position: absolute;


        }

        .tbl_firma {
            width: 100%;
            height: 30px;
            /* border-top: 1px solid; */
            padding: 2px;
            /* float: left; */
            margin: 0 0 0 0;

            border-top-style: dotted;
            border-top-width: 1px;
        }

        .tbl_firma_1 {
            width: 30%;
            height: 30px;
            /* border-top: 1px solid; */
            padding: 2px;
            /* float: left; */
            margin: -53 0 0 0%;
            text-align: center;
            border-top-style: dotted;
            border-top-width: 1px;
        }

        .tbl_firma_2 {
            width: 30%;
            height: 30px;
            /* border-top: 1px solid; */
            padding: 2px;
            /* float: left; */
            margin: -54 0 0 50%;
            text-align: center;
            float: right;
            border-top-style: dotted;
            border-top-width: 1px;
        }

        .tbl_firma1 {
            width: 30%;
            height: 30px;
            /* border-top: 1px solid; */
            /* float: left; */
            margin: -53 0 0 35%;
            padding: 2px;
            text-align: center;
            border-top-style: dotted;
            border-top-width: 1px;
        }

        .tbl_firma2 {
            width: 30%;
            height: 30px;
            /* border-top: 1px solid; */
            padding: 2px;
            /* margin: -54 0 0 69%; */
            /* float: right; */
            text-align: center;
            border-top-style: dotted;
            border-top-width: 1px;
        }



        /* #table_detalle {
            width: 100%;
            border: 1px solid #000;
        }

        #table_detalle,th,
        #table_detalle,td {
            text-align: left;
            vertical-align: top;
            border: 1px solid #000;
            border-collapse: collapse;
        } */
    </style>
</head>

<body>
    <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
    <header>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td width="20%">
                    <img src="{{ public_path('/img/admin/logogamc.png') }}" style="width: 80px; height: 80px">
                </td>
                <td width="50%" class="txthead">
                    <span class="txthead"><b>GOBIERNO AUTONOMO MUNICIPAL DE COCHABAMBA</b> <br>
                        DEPARTAMENTO DE SEMAFORIZACION Y SEÑALIZACION<br>
                        <b>Semaforización / Señalización</b></span>
            
                    @if ($salidas[0]->edicion == 1)
                    <b style="color: red;">( Edición abierta)</b></span>
                    @endif
                </td>
                <td width="20%">
                    {{-- <img src="{{ 'https://www.imgonline.com.ua/examples/qr-code-url.png' }}" width="80" height="80" /> --}}
                    {{-- <div style="align: right; padding-left:45px; border:0px; color:black">
                        {!! QrCode::size(300)->backgroundColor(255, 185, 0)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') !!}
                    </div> --}}

                </td>
                <td width="10%">
                    <span class="txthead" align="right"> <b>Fecha salida:</b> <br>{{ $salidas[0]->fecha_salida }} <br>
                    </span>
                </td>
            </tr>
        </table>
    </header>

    <main>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th width=80% style="text-align: left;">
                    <h3>FORMULARIO DE REINGRESO DE ÍTEM </h3>
                </th>
                <th width=20%>
                    <h3 style="text-align: right;">Nro Salida: <span
                            class="nro-css">{{ $salidas[0]->nro_boleta }}</span> </h3>
                </th>
            </tr>
        </table>
        <fieldset>
            <legend><b>Informacón de la salida </b></legend>
            <div class="container">
                <?php
                $cont = 0;
                ?>
                @foreach ($salidas as $salida)
                    @php
                        // var_dump($salidas);die;
                        $cont++;
                    @endphp
                    <table>
                        <tr>
                            <td>
                                <span><b>Tipo de salida:
                                    </b>{{ $salida->tipo_salida ?? '' }}</span>
                            </td>
                            <td>
                                <span><b>Funcionario:
                                    </b>{{ $salida->id_usuario ?? 'almacen A' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>Proyecto: </b> {{ $salida->proyecto }}</span>
                            </td>
                            <td style="text-align: left;">
                                <span><b>Estructura: </b>{{ $salida->estructura }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>Direccion: </b> {{ $salida->direccion }}</span>
                            </td>
                            <td style="text-align: left;">
                                <span><b>Distrito: </b>{{ 'Distrito - ' . $salida->distrito }} </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span><b>Descripción trabajo/Obra: </b>{{ $salida->descripcion_trabajo }}</span>
                            </td>
                        </tr>

                    </table>
                @endforeach
            </div>
        </fieldset>

        <fieldset>

            <legend><b>Información detalle salida </b></legend>
            <table border="1">
                <thead>

                    <th>Nro</th>
                    <th>Nro Ingreso</th>
                    <th>Código</th>
                    <th>Ítem</th>
                    <th>Unidad medida</th>
                    <th>Cantidad salida</th>
                    <th>Cantidad reingreso</th>
                    <th>Total Salida</th>
                    {{-- <th>Precio</th>
                    <th>Total salida</th> --}}
                </thead>

                <tbody>
                    @php
                        $nro = 1;
                        $total_salida = 0;
                        $salida_detalle = json_decode($dataDetalleSalida);
                        //   var_dump($salida_detalle);die;
                    @endphp
                    @foreach ($salida_detalle as $sal)
                        <tr style="text-align: center;">
                            <td>{{ $nro ?? '' }}</td>
                            <td>{{ trim($sal->nro_ingreso) ?? '' }}</td>
                            <td>{{ trim($sal->codigo) ?? '' }}</td>
                            <td>{{ trim($sal->descripcion_catalogo) ?? '' }}</td>
                            <td>{{ trim($sal->descripcion_unidad_medida) ?? '' }}</td>
                            <td>{{ trim($sal->cantidad_salida) ?? 0 }}</td>
                            <td>{{ trim($sal->cantidad_reingreso) ?? 0 }}</td>
                            <td>{{ trim($sal->cantidad_salida - $sal->cantidad_reingreso) ?? 0 }}</td>
                            {{-- <td>{{ $sal->precio ?? '' }}</td>
                            <td>{{ $total = $sal->cantidad_salida * $sal->precio ?? '' }}</td> --}}
                        </tr>
                        @php
                            $nro = $nro + 1;
                            // $total_salida = $total_salida + $total;
                        @endphp
                    @endforeach

                </tbody>

                <tfoot>
                    {{-- <tr style="text-align: left;">
                        <th colspan="7">Total Salida</th>
                        <th colspan="7" >{{$total_salida}}</th>
                    </tr> --}}
                </tfoot>
            </table>
            <br>
            @if ($cont === 4)
                @php
                    $cont = 0;
                @endphp
                <div style="page-break-after:always;"></div>
            @endif
        </fieldset>
        <div class="firmas">

            <div class="tbl_firma_1">
                <span>Entregué Conforme</span><br>
                <span>{{ Auth::user()->name }}</span>
            </div>
            <div class="tbl_firma_2">
                <span>Recibí Conforme</span><br>
                <span><?= '__________________' ?> </span>
            </div>
        </div>
    </main>
    <footer>

        <table class="table_foot">
            <tr style="text-align: left;">
                <td width="500">
                    <span>Plaza 14 de Septiembre Nº 210 esquina General Achá <br>
                        Telf. : 4258030 <br>
                        www.cochabamba.bo <br>
                    </span>
                </td>
                <td width="50">
                    <p class="page"><b>Página. </b></p>
                </td>
            </tr>
        </table>
    </footer>


    {{-- </main> --}}
</body>

</html>
@section('js')

@stop
