@extends('adminlte::page')
@section('title', 'Ingreso')
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Pace', false)
@section('plugins.Datatables', true)

{{-- @section('plugins.Select2', true) --}}
@section('content')
@section('content_header')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">REGISTROS REALIZADOS - SINOPTICO</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Principal</a></li>
                        <li class="breadcrumb-item active">Sinoptico</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>


    <div class="card">
        <div class="card-header">
            <div class="row">

                <div class="col-4">

                    <div>
                        <button id="add_sinoptico" type="button" class="btn btn-info">
                            <i class="fas fa-plus-circle text-white fa-2x"></i> Nuevo Registro</button>
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Fecha Inicio</span>
                        </div>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Fecha fin</span>
                        </div>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>

        </div>

        <div class="card-body">
            <table id="sinoptico-data" class="table table-striped table-bordered responsive" role="grid"
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

                    @foreach ($sinopticos as $Sinoptico)
                        <tr>
                            <td scope="row">{{ $count++ }}</td>
                            <td>{{ $Sinoptico->estacion_terminal }}</td>
                            <td>{{ $Sinoptico->fecha_recepcionado }}</td>
                            <td>{{ $Sinoptico->mensaje }}</td>
                            <td>{{ $Sinoptico->id_user }}</td>
                            <td>
                                {{-- <button type="button" class="btn btn-info" value="{{ $Sinoptico->id }}"
                                    id="btn_edit_ingreso" title="Editar Ingreso"><i class="fas fa-edit"></i></button> --}}
                                {{-- <a  href="{{ route('ingreso.edit'}}" class="btn btn-info"value="{{ $Sinoptico->id }}" id="btn-editar"
                                    title="Editar Ingreso"><i class="fas fa-edit"></i> </a> --}}
                                <button type="button" class="btn btn-info" onclick="eliminarSinoptico({{ $Sinoptico->id }})"
                                    title="Eliminar Registro"><i class="fas fa-trash"></i></button>


                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>




    @include('sinoptico.modalRegister', [
        'id_button' => 'btn_guardar_sinoptico',
        'title_buton' => 'Guardar Registro',
        'title_modal' => 'Nuevo Registro sinoptico',
    ])

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
       <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js">
       </script>
       <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css"
           rel="stylesheet" />
    <script type="text/javascript" charset="utf-8">
        //select2 cuartel

        $('#add_sinoptico').on('click', function() {

            $('#modal_add_sinoptico').modal('show');
        });
        $('#btn_guardar_sinoptico').on('click', function() {
            $.ajax({
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                url: "{{ route('sinoptico.create') }}",
                async: false,
                data: JSON.stringify({
                    'fecha_registro': $('#fecha_registro').val(),
                    'mensaje': $('#mensaje').val(),
                    'estacion_terminal': $('#estacion_terminal').val()
                }),
                success: function(data_response) {
                    swal.fire({
                        title: "Guardado!",
                        text: "!Registro realizado con éxito!",
                        type: "success",
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        location.reload();
                        limpiarModalsinoptico();
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


        function eliminarSinoptico(id) {
            Swal.fire({
                title: "Esta seguro que quiere eliminar?",
                text: "Una vez elminado no podra ver el registro!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, estoy seguro!"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('sinoptico.delete') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: id,
                        },
                        success: function(data) {

                        }
                    });
                    event.preventDefault();
                }
                Swal.fire({
                    title: "Eliminado!",
                    text: "Su registro fue eliminado.",
                    icon: "success"
                });
                location.reload();
            });



        }



     
        $(document).on('click', '#add_sinoptico', function() {
            $("#modal_add_sinoptico").modal("show");

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


    <script>
        $(document).ready(function() {
            $('#date_start').val('');
            $('#date_end').val('');
            //editar cuartel


            var datatable = $('#sinoptico-data').DataTable({
                "paging": true,
                "searching": true,
                "language": {
                    "url": "{{ asset('plugins/datatables/Spanish.json') }}",
                    "searchPlaceholder": ""
                },
            });
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

          
            // DataTables initialisation
            var table = $('#sinoptico-data').DataTable();

            // Refilter the table
            $('#date_start, #date_end').on('change', function() {
                table.draw();
            });

        });
        
        $(document).ready(function() {
            $("#fecha_registro").datetimepicker({
                language: 'es',
                startDate: new Date(),
                format: "Y-m-d H:m:s", // Solo se ocupa la fecha
                //format: "yyyy-MM-dd H:m:s", // no se requiere la hora
                timepicker: false,
                autoclose: true,
                //pickTime: false
                showButtonPanel: true,
            });
            // Create date inputs
            minDate = new DateTime($('#date_start'), {
                format: 'Y-m-d',
                locale: 'es',
            });
            maxDate = new DateTime($('#date_end'), {
                format: 'Y-m-d',
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
