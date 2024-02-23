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
                    <h1 class="m-0">REGISTROS REALIZADOS - METAR</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Principal</a></li>
                        <li class="breadcrumb-item active">Metars</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="card">
        <div class="card-header">
            <div class="row">

                <div class="col-4">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-metar">
                        Nuevo Metar
                    </button>
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
            <table id="metar-data" class="table table-striped table-bordered responsive" role="grid"
                aria-describedby="example">
                <thead class="bg-table-header">

                    <tr role="row">
                    <tr>
                        <th scope="col">Nro</th>
                        <th scope="col">Fecha registro</th>
                        <th scope="col">Mensaje </th>
                        <th scope="col">usuario </th>
                        <th scope="col">Opciones </th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php($count = 1)

                    @foreach ($metars as $metar)
                        <tr>
                            <td scope="row">{{ $count++ }}</td>
                            <td>{{ $metar->nro_ingreso }}</td>
                            <td>{{ $metar->nro_egreso }}</td>
                            <td>Almacen - {{ $metar->almacen }}</td>
                            <td>{{ $metar->created_at }}</td>
                            <td>{{ $metar->funcionario }}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-info" value="{{ $metar->id }}"
                                    id="btn_edit_ingreso" title="Editar Ingreso"><i class="fas fa-edit"></i></button> --}}
                                {{-- <a  href="{{ route('ingreso.edit'}}" class="btn btn-info"value="{{ $metar->id }}" id="btn-editar"
                                    title="Editar Ingreso"><i class="fas fa-edit"></i> </a> --}}
                                @if ($metar->edicion == 1)
                                    <a href="{{ route('ingreso.edit', $metar->id) }}"><i
                                            class="fas fa-edit btn btn-warning"></i></a>
                                @endif

                                @if ($metar->edicion == 0)
                                    <a href="{{ route('salida.pdfIngreso', $metar->id) }}" class="btn btn-info"><i
                                            class="fas fa-print"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal complementacion de entrega de producto -->
    <div class="modal fade fullscreen-modal animated bounceIn" id="modal-add-metar" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" style="text-align: center">Formulario de registro</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Fecha de nacimiento :</label>
                                        <input type="date" class="form-control" placeholder="fecha de registro"
                                            id="fecha_registro">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="form-group">
                                        <label>Mensaje:</label>
                                        <textarea style="text-transform:uppercase;"class="form-control" name="msg" id="msg" cols="30"
                                            rows="4" autocomplete="off" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>

                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <div class="col-sm-12" style="text-align: center">
                        <button type="button" id="{{ '$id_button' }}"
                            class="btn btn-success">{{ '$title_buton' }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Modal Heading</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Modal body..
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
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

    <script type="text/javascript" charset="utf-8">
        //select2 cuartel
        $("#select_id_catalogo_Modal").select2({
            width: 'resolve', // need to override the changed default
            dropdownParent: $('#modal-register-bloque')
        });
        $(document).on('click', '#add_metar', function() {
            $("#modal_add_metar").modal("show");

            $(".select_id_catalogo_Modal").select2({
                placeholder: "Seleccione una opcion",
                allowClear: true
            })

        });
    </script>
    <script>
        $(document).ready(function() {
            $(function() {
                $('.numeroEntero').keypress(function(e) {
                        if (isNaN(this.value + String.fromCharCode(e.charCode)))
                            return false;
                    })
                    .on("cut copy paste", function(e) {
                        e.preventDefault();
                    });
            });
            $(function() {
                $('.soloLetras').bind('keyup input', function() {
                    if (this.value.match(/[^a-zA-Z áéíóúÁÉÍÓÚüÜ]/g)) {
                        this.value = this.value.replace(/[^a-zA-Z áéíóúÁÉÍÓÚüÜ]/g, '');
                    }
                });
            });


        });
    </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css" rel="stylesheet"/>

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

            var datatable = $('#metar-data').DataTable({
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
            // minDate = new DateTime($('#date_start'), {
            //     format: 'YYYY-MM-DD',
            //     locale: 'es',
            // });
            // maxDate = new DateTime($('#date_end'), {
            //     format: 'YYYY-MM-DD',
            //     locale: 'es',

            // });

            // DataTables initialisation
            var table = $('#metar-data').DataTable();

            // Refilter the table
            $('#date_start, #date_end').on('change', function() {
                table.draw();
            });

        });
        $(document).ready(function() {

            // Create date inputs
         
            $("#fecha_registro").datetimepicker({
                language: 'es',
                startDate: new Date(),
                format: "YYYY-MM-DD HH:mm:ss", // Solo se ocupa la fecha
                yearRange: "-99:+0", // no hace nada
                maxDate: "+0m +0d", // no hace nada
                //format: "YYYY-MM-DD HH:mm:ss", // no se requiere la hora
                timepicker: false,
                autoclose: true,
                //pickTime: false
                showButtonPanel: true,
            });



        });
    </script>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        function limpiarModalItem() {
            // $('select[id=select_id_catalogo_Modal]').val();
            // $('select[name="id_catalogo"] option:selected').text()
            $("#select_id_catalogo_Modal").val('');
            $("#codigo").val('');
            $("#unidad_medida_modal").val('');
            $("#cantidad_ingreso").val('');
            $("#precio_ingreso").val('');
            $("#id_unidad_medida_temp").val('');
        }
    </script>
@stop
