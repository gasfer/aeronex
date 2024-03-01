@extends('adminlte::page')
@section('title', 'responsable')
@section('plugins.Datatables', true)
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)

@section('content_header')
    <h1>Reporete Entradas y Salidas</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-header">
            <?php
            setlocale(LC_TIME, 'es_ES.UTF-8');
            ?>
            <div class="row">
                <div class="col-4">
                    <div class='  input-group '>
                        <label for="">Fecha inicio: </label>
                        <input type='text' class="form-control" id='date_start'name='date_start' />
                    </div>
                </div>
                <div class="col-4">
                    <div class=' input-group '>
                        <label for="">Fecha fin: </label>
                        <input type='text' class="form-control" id='date_end'name='date_end' />

                    </div>
                </div>
                {{-- <div class="col-4"><button type="button" class="btn bg-info"> Buscar</button></div> --}}
            </div>
        </div>

        <div class="card-body">

            <table id="reportes-data" class="table table-striped table-bordered responsive" role="grid"
                aria-describedby="example">
                <thead class="bg-table-header">
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
                                    @if ($sal->edicion == 0)
                                        <a href="{{ route('salida.pdfSalida', $sal->id) }}" class="btn btn-info"><i
                                                class="fas fa-print"></i></a>
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
        <div class="card-header">
        </div>

    </div>


@stop

@section('css')
    <style>
        .modal {
            padding: 2% !important;
        }

        .modal .modal-dialog {
            width: 100%;
            max-width: none;

            margin: 0;
        }

        .modal .modal-content {
            height: 95%;
            border: 0;
            border-radius: 0;
        }

        .modal .modal-body {
            overflow-y: auto;
        }
    </style>

@stop

@section('js')
    <script type="text/javascript">
        $('#date_start').val('');
        $('#date_end').val('');
        /*var datatable = $('#reportes-data').DataTable({
            "paging": true,
            "searching": true,
            "responsive": true,
            "language": {
                "url": "{{ asset('plugins/datatables/Spanish.json') }}",
                "searchPlaceholder": ""
            },
            "autoWidth": false,
            // "serverSide": true
        });*/
        var minDate = '';
        var maxDate = '';

        // Custom filtering function which will search data in column four between two values

        $(document).ready(function() {

            // Create date inputs
            minDate = new DateTime($('#date_start'), {
                format: 'YYYY-MM-DD hh:mm:ss',
                language:"es_ES",
            });
            
            maxDate = new DateTime($('#date_end'), {
                format: 'YYYY-MM-DD hh:mm:ss',

            });
            

            // DataTables initialisation
            var table = $('#reportes-data').DataTable();

            // Refilter the table
            $('#date_start, #date_end').on('change', function() {
                table.draw();
            });
        });
        // if (minDate.val() != '' || maxDate.val() != '') {

        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                
                var min = minDate.val();
                var max = maxDate.val();
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
        // }
    </script>
@stop
