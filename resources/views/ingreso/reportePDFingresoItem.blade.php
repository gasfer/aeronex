<!DOCTYPE html>

<html>

<head>
   
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


    </style>
</head>

<body>
    <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
    <header>
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr>
                <td width="20%">
                    <img src="{{ public_path('/img/admin/logogamc.png') }}" style="width: 80px; height: 80px">
                </td>
                <td width="50%" class="txthead">
                    <span class="txthead"><b>GOBIERNO AUTONOMO MUNICIPAL DE COCHABAMBA</b> <br>
                        DEPARTAMENTO DE SEMAFORIZACION Y SEÑALIZACION<br>
                        <b>semaforización / señalización</b></span>
                </td>
                {{-- <td width="20%">
                    <div style="align: right; padding-left:45px; border:0px; color:black">
                        <img src="{{ 'https://www.imgonline.com.ua/examples/qr-code-url.png' }}" width="80"
                            height="80" />
                    </div>
                </td> --}}

                <td width="10%">
                    <span class="txthead" align="right"> <b>Fecha:</b> <br>{{ date('Y-m-d') }} <br>
                        <b>Hora:</b> <br> {{ date('H:m:s') }}
                    </span>
                </td>
            </tr>
        </table>
    </header>

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

    <main>
        <table cellpadding="0" cellspacing="0" style="width: 100%;">
            <tr>
                <th width=80% style="text-align: left;">
                    <h3>FORMULARIO DE INGRESO DE ÍTEM </h3>
                </th>
                <th width=20%>
                    <h3 style="text-align: right;">Nro Ingreso: <span
                            class="nro-css">{{ $ingresos[0]->nro_ingreso }}</span> </h3>
                </th>
            </tr>
        </table>
        <fieldset>
            <legend><b>Informacón de la ingreso </b></legend>
            <div class="container">
                <?php
                $cont = 0;
                ?>
                @foreach ($ingresos as $ingreso)
                    @php
                        // var_dump(dataIngresoItem);die;
                        $cont++;
                    @endphp
                    <table  style="width: 100%;">
                        <tr>
                            <td>
                                <span><b>Nro. Ingreso:
                                    </b>{{ $ingreso->nro_ingreso ?? '' }}</span>
                            </td>
                            <td>
                                <span><b>Nro. egreso :
                                    </b>{{ $ingreso->nro_egreso ?? 'almacen A' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>Almacén: </b> {{ $ingreso->almacen }}</span>
                            </td>
                            <td>
                                <span><b>Funcionario: </b> {{ $ingreso->funcionario }}</span>
                            </td>
                        </tr>
                    
                        <tr>
                            <td colspan="2">
                                <span><b>Observación: </b>{{ $ingreso->observaciones }}</span>
                            </td>
                        </tr>

                    </table>
                @endforeach
            </div>
        </fieldset>

        <fieldset>

            <legend><b>Información detalle salida </b></legend>
            <table border="1" style="width: 100%;">
                <thead>

                    <th>Nro</th>
                    <th>Código</th>
                    <th>Ítem</th>
                    <th>Unidad medida</th>
                    <th>Cantidad salida</th>
                    <th>Precio</th>
                    <th>Total Ingreso</th>
                    {{-- <th>Precio</th>
                    <th>Total salida</th> --}}
                </thead>

                <tbody>
                    @php
                        $nro = 1;
                        $total_salida = 0;
                      //  $salida_detalle = json_decode($dataDetalleSalida);
                        //   var_dump($salida_detalle);die;
                    @endphp

                     @foreach ($dataIngresoItem as $detalleingreso)
                        <tr style="text-align: center;">
                            <td>{{ $nro ?? '' }}</td>
                            <td>{{ trim($detalleingreso->codigo) ?? '' }}</td>
                            <td>{{ trim($detalleingreso->descripcion_catalogo) ?? '' }}</td>
                            <td>{{ trim($detalleingreso->descripcion_unidad_medida) ?? '' }}</td>
                            <td>{{ round(($detalleingreso->saldo_cant_ingreso),2) ?? 0 }}</td>
                            <td>{{ trim($detalleingreso->precio) ?? 0 }}</td>
                            <td>{{ $total_salida_parcial = (round($detalleingreso->saldo_cant_ingreso,2) * round($detalleingreso->precio,2)) ?? 0 }}</td>
                    
                        </tr>
                        @php
                            $nro = $nro + 1;
                            $total_salida = $total_salida + $total_salida_parcial;
                        @endphp
                    @endforeach 

                </tbody>

                <tfoot>
                    <tr >
                        <th colspan="6" style="text-align: right;">Total Salida</th>
                        <th colspan="1" style="text-align: center;">{{$total_salida}}</th>
                    </tr>
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
                <span>Recibí Conforme</span><br>
                <span>{{ Auth::user()->name }}</span>
            </div>
            <div class="tbl_firma_2">
                <span>Entregué Conforme</span><br>
                <span><?= '__________________' ?> </span>
            </div>
        </div>
    </main>

    {{-- </main> --}}
</body>

</html>
       