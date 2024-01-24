@extends('adminlte::page')
@section('title', 'GAMC')
@section('plugins.Datatables', true)
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)
@section('content_header')
    <h1>SALIDAS ITEMS</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header ">
            <div class="row">

                <div class="col-4">
                    <a href="{{ route('egreso.create') }}" class="btn btn-info "><i class="fas fa-plus-square"> Nueva
                            Salida</i></a>
                </div>
                <div class="col-4">
                    <div class='  input-group '>
                        <label for="">Fecha inicio</label>
                        <input type='text' class="form-control" id='date_start'name='date_start' />
                    </div>
                </div>
                <div class="col-4">
                    <div class=' input-group '>
                        <label for="">Fecha fin</label>
                        <input type='text' class="form-control" id='date_end'name='date_end' />

                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">

            <table class="table table-striped" id="table-salidas">
                <thead>
                    <tr>
                        <th>ID </th>
                        <th>NRO. BOLETA </th>
                        <th>FECHA </th>
                        <th>FUNCIONARIO RESPONSABLE </th>
                        <th>TRABAJO </th>
                        <th>DISTRITO </th>
                        <th>ESTADO </th>
                        <th>OPCIONES </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($Salidas)
                        @php($count = 1)
                        @foreach ($Salidas as $sal)
                            <tr style="text-align: center;">
                                <td scope="row">{{ $count++ }}</td>
                                <td WIDTH="150">{{ $sal->nro_boleta }}</td>
                                <td>{{ $sal->fecha_salida }}</td>
                                <td>{{ $sal->id_usuario }}</td>
                                <td>{{ $sal->tipo_salida }}</td>
                                <td>{{ 'D - ' . $sal->distrito }}</td>
                                <td>{{ $sal->entregado }}</td>
                                <td WIDTH="150" style="text-align: left">
                                    {{-- <button type="button" class="btn btn-info" value="{{ $sal->id }}"
                                    id="btn_edit_ingreso" title="Editar Ingreso"><i class="fas fa-edit"></i></button> --}}
                                    {{-- <a  href="{{ route('ingreso.edit'}}" class="btn btn-info"value="{{ $sal->id }}" id="btn-editar"
                                    title="Editar Ingreso"><i class="fas fa-edit"></i> </a> --}}
                                    @if ($sal->edicion == 1)
                                        <a href="{{ route('salida.updateSalida', $sal->id) }}"><i
                                                class="fas fa-edit btn btn-warning"></i></a>
                                    @endif
                                    @if ($sal->edicion == 0)
                                        <a href="{{ route('salida.pdfSalida', $sal->id) }}" class="btn btn-info"><i
                                                class="fas fa-print"></i></a>
                                    @endif
                                    @if ($sal->edicionreingreso == 1)
                                        {{-- <button type="button" class="btn btn-success" title="Registrar Reingreso" value="{{ $sal->id }}"
                                        id="btn-reingreso"><i class="fas fa-upload"></i></button> --}}
                                        <a class="btn btn-success"
                                            href="{{ route('salida.reingresoSalida', $sal->id) }}"><i
                                                class="fas fa-upload"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <span>No existen registros...!!! </span>
                    @endif



                </tbody>
            </table>

        </div>
    </div>
    {{-- @include('egreso.Crear.ModaleditItems') --}}

@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#date_start').val('');
            $('#date_end').val('');

            var dt = $('#table-salidas').DataTable({
                "paging": true,
                "searching": true,
                "language": {
                    "url": "{{ asset('plugins/datatables/Spanish.json') }}",
                    "searchPlaceholder": ""
                },
            });
        });


        // Custom filtering function which will search data in column four between two values
        if ($('#date_start').val() != '' || $('#date_end').val() != '') {

            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = $('#date_start').val();
                    var max = $('#date_end').val();
                    var date = new Date(data[2]);

                    if (
                        (min === null && max === null) ||
                        (min === null && date <= max) ||
                        (min <= date && max === null) ||
                        (min <= date && date <= max)
                    ) {
                        return true;
                    }
                    return false;
                });
            $(document).ready(function() {

                // Create date inputs
                minDate = new DateTime($('#date_start'), {
                    format: 'YYYY-MM-DD',
                    // locale: 'es',
                });
                maxDate = new DateTime($('#date_end'), {
                    format: 'YYYY-MM-DD',
                    // locale: 'es',

                });

                // DataTables initialisation
                var table = $('#table-salidas').DataTable();

                // Refilter the table
                $('#date_start, #date_end').on('change', function() {
                    table.draw();
                });

            });
        }
    </script>
@stop
