@extends('adminlte::page')
@section('title', 'Ingreso')
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)
@section('plugins.Datatables', true)

{{-- @section('plugins.Select2', true) --}}
@section('content')
@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">LISTA DE INGRESOS DE ITEMS</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Principal</a></li>
                        <li class="breadcrumb-item active">Ingreso ítems</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop
@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">

                <div class="col-4">

                    <a href="{{ route('ingreso.create') }}" class="btn btn-info "><i class="fas fa-plus-square"> Nuevo
                            Ingreso</i></a>
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
            <table id="ingreso-data" class="table table-striped table-bordered responsive" role="grid"
                aria-describedby="example">
                <thead class="bg-table-header">

                    <tr role="row">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nro. Ingreso</th>
                        <th scope="col">Nro. Egreso </th>
                        <th scope="col">Almacen </th>
                        <th scope="col">Fecha </th>
                        <th scope="col">Funcionario </th>
                        <th scope="col">Opciones </th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php($count = 1)

                    @foreach ($Ingresos as $ingreso)
                        <tr>
                            <td scope="row">{{ $count++ }}</td>
                            <td>{{ $ingreso->nro_ingreso }}</td>
                            <td>{{ $ingreso->nro_egreso }}</td>
                            <td>Almacen - {{ $ingreso->almacen }}</td>
                            <td>{{ $ingreso->created_at }}</td>
                            <td>{{ $ingreso->funcionario }}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-info" value="{{ $ingreso->id }}"
                                    id="btn_edit_ingreso" title="Editar Ingreso"><i class="fas fa-edit"></i></button> --}}
                                {{-- <a  href="{{ route('ingreso.edit'}}" class="btn btn-info"value="{{ $ingreso->id }}" id="btn-editar"
                                    title="Editar Ingreso"><i class="fas fa-edit"></i> </a> --}}
                                @if ($ingreso->edicion == 1)
                                    <a href="{{ route('ingreso.edit', $ingreso->id) }}"><i
                                            class="fas fa-edit btn btn-warning"></i></a>
                                @endif

                                @if ($ingreso->edicion == 0)
                                    <a href="{{ route('salida.pdfIngreso', $ingreso->id) }}" class="btn btn-info"><i
                                            class="fas fa-print"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    {{-- @include('ingreso.modalRegister', [
        'id_button' => 'btn_guardar_ingreso',
        'title_buton' => 'Guardar Ingreso',
        'title_modal' => 'Nuevo Ingreso',
    ]) --}}

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
    <script>
        $(document).ready(function() {
            $('#date_start').val('');
            $('#date_end').val('');
            //editar cuartel
            $('#btn-editar-va').on('click', function() {
                $.ajax({
                    type: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    url: "{{ route('responsable.update') }}",
                    async: false,
                    data: JSON.stringify({
                        'ci': $('#ci-responsable').val(),
                        'nombres': $('#nombre-responsable').val(),
                        'primer_apellido': $('#primer_apellido-responsable').val(),
                        'segundo_apellido': $('#segundo_apellido-responsable').val(),
                        'fecha_nacimiento': $('#fecha_nacimiento-responsable').val(),
                        'genero': $('#genero-responsable').val(),
                        'telefono': $('#telefono-responsable').val(),
                        'celular': $('#celular-responsable').val(),
                        'estado_civil': $('#estado_civil-responsable').val(),
                        'email': $('#email-responsable').val(),
                        'domicilio': $('#domicilio-responsable').val(),
                        'id': $('#btn-editar-va').val()
                    }),
                    success: function(data_response) {
                        swal.fire({
                            title: "Guardado!",
                            text: "!Registro actualizado con éxito!",
                            type: "success",
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                        //toastr["success"]("Registro realizado con éxito!");
                    },
                    error: function(error) {

                        if (error.status == 422) {
                            Object.keys(error.responseJSON.errors).forEach(function(k) {
                                toastr["error"](error.responseJSON.errors[k]);
                                //console.log(k + ' - ' + error.responseJSON.errors[k]);
                            });
                        } else if (error.status == 419) {
                            location.reload();
                        }

                    }
                })


            });

            $(document).on('click', '#btn-desactivar', function() {
                $.ajax({
                    type: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    url: '/responsable/disable-responsable/' + $(this).val(),
                    async: false,
                    success: function(data_response) {
                        /* swal.fire({
                             title: data_response.response,
                             text: "",
                             type: "success",
                             timer: 1000,
                             showCancelButton: false,
                             showConfirmButton: false
                         }); */
                        setTimeout(function() {
                            $("#modal_add_item").hide();
                            $(".modal-backdrop").remove();
                            var table = $('#detalleIngresoTemp').DataTable();
                            table.ajax.reload();
                        }, 2000);
                        //toastr["success"]("Registro realizado con éxito!");
                    },
                    error: function(error) {

                        if (error.status == 422) {
                            Object.keys(error.responseJSON.errors).forEach(function(k) {
                                toastr["error"](error.responseJSON.errors[k]);
                                //console.log(k + ' - ' + error.responseJSON.errors[k]);
                            });
                        } else if (error.status == 419) {
                            var table = $('#detalleIngresoTemp').DataTable();
                            table.ajax.reload();
                        }

                    }
                })
                event.preventDefault();
            });

            $('#new-responsable').on('click', function() {
                $('#modal-register-responsable').modal('show');
            });

            var datatable = $('#ingreso-data').DataTable({
                "paging": true,
                "searching": true,
                "language": {
                    "url": "{{ asset('plugins/datatables/Spanish.json') }}",
                    "searchPlaceholder": ""
                },
            });
        });
        $(document).on('click', '#btn_edit_ingreso', function() {
            var id = $(this).val();
            $.ajax({
                type: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                url: 'ingreso.edit/' + $(this).val(),
                async: false,
                success: function(data_response) {
                    $("#editmodalCatalogo").modal("show");

                    $('#edit_id_ingreso').val(data_response.response[0].id_ingreso);
                    $('#edit_descripcion_catalogo').val(data_response.response[0].descripcion_catalogo);

                    $('#edit_id_unidad_medida').val(data_response.response[0].id_unidad_medida);
                    $('#edit_id_categoria').val(data_response.response[0].id_categoria);
                    $('#id_catalogo').val(data_response.response[0].id);

                    // $('#edit_id_unidad_medida option[value="' + data_response.response[0].id_unidad_medida + '"]').attr("selected", "selected");
                    // $('#edit_id_categoria option[value="' + data_response.response[0].id_categoria + '"]').attr("selected", "selected");
                }
            })


        });


        if ($('#date_start').val() != '' || $('#date_end').val() != '') {

            // Custom filtering function which will search data in column four between two values
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = $('#date_start').val();
                    var max = $('#date_end').val();
                    var date = new Date(data[4]);

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
        }
        $(document).ready(function() {

            // Create date inputs
            minDate = new DateTime($('#date_start'), {
                format: 'YYYY-MM-DD',
                locale: 'es',
            });
            maxDate = new DateTime($('#date_end'), {
                format: 'YYYY-MM-DD',
                locale: 'es',

            });

            // DataTables initialisation
            var table = $('#ingreso-data').DataTable();

            // Refilter the table
            $('#date_start, #date_end').on('change', function() {
                table.draw();
            });

        });
    </script>
@stop
@stop

@section('css')
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script></script>
@stop
