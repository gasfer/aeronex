@extends('adminlte::page')
@section('title', 'responsable')
@section('plugins.Datatables', true)
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)

@section('content_header')
    <h1>Listado de Responsables</h1>
@stop

@section('content')


    <div class="card">
        <div class="card-body">
            <button id="new-responsable" type="button" class="btn btn-info col-2"> <i
                    class="fas fa-plus-circle text-white fa-2x"></i> Crear Responsable</button>
        </div>
    </div>

    <table id="responsable-data" class="table table-striped table-bordered responsive" role="grid"
        aria-describedby="example">
        <thead class="bg-table-header">

            <tr role="row">
                <th scope="col">#</th>
                <th scope="col">Cedula de identidad</th>
                <th scope="col">Nombre</th>
                <th scope="col">Telefono</th>
                <th scope="col">Celular</th>
                <th scope="col">Dirección</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>

        <tbody>
            @php($count = 1)
            @foreach ($responsable as $responsable)
                <tr>
                    <td scope="row">{{ $count++ }}</td>

                    <td>{{ $responsable->ci }}</td>
                    <td>{{ $responsable->nombre }}</td>
                    <td>{{ $responsable->telefono }}</td>
                    <td>{{ $responsable->celular }}</td>
                    <td>{{ $responsable->domicilio }}</td>

                    <td>
                        <button type="button" class="btn btn-info" value="{{ $responsable->id }}" id="btn-editar"
                            title="Editar responsable"><i class="fas fa-edit"></i></button>
                        @if ($responsable->estado == 'ACTIVO')
                            <button type="button" class="btn btn-warning" value="{{ $responsable->id }}"
                                id="btn-desactivar"><i class="fas fa-thumbs-down"></i></button>
                        @else
                            <button type="button" class="btn btn-success" value="{{ $responsable->id }}"
                                id="btn-desactivar"><i class="fas fa-thumbs-up"></i></button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @include('responsable.modalRegister', [
        'id_button' => 'btn_guardar_responsable',
        'title_buton' => 'Guardar Responsable',
        'title_modal' => 'Nuevo Responsable',
    ])


    <!-- Modal -->
    <div class="modal fade  animated bounceIn" id="edit-responsable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Información del Responsable</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        {{-- <div class="col-sm-4">
                <div class="form-group">
                    <label>Nombre Responsable :</label>
                    <input id="nombre-ree" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Cedula de identidad:</label>
                    <input id="codigo-responsable" disabled>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label>Estado responsable:</label>
                    <select  id="estado" class="form-control">
                        <option value="ACTIVO">ACTIVO</option>
                        <option value="INACTIVO">INACTIVO</option>
                      </select>
                </div>
            </div> --}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cedula de Identidad:</label>
                                    <input type="text" class="form-control numeroEntero" id="ci_responsable_edit" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nombre :</label>
                                    <input style="text-transform:uppercase;"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                                        class="form-control" id="nombre-responsable" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Primer apellido :</label>
                                    <input style="text-transform:uppercase;"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                                        class="form-control" id="primer_apellido-responsable" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Segundo apellido :</label>
                                    <input style="text-transform:uppercase;"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                                        class="form-control" id="segundo_apellido-responsable" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha de nacimiento :</label>
                                    <input type="date" class="form-control" placeholder="fecha de nacimiento"
                                        id="fecha_nacimiento-responsable" max="2006-12-31">
                                    {{-- <input type="text" class="form-control datetimepicker" placeholder="Fecha de nacimiento" id="fecha_nacimiento" name="fecha_nacimiento"  />
                        <input style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text" class="form-control" id="segundo_apellido" autocomplete="off"> --}}
                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Género :</label>
                                    <select name="status" id="genero-responsable" class="form-control">

                                        <option value="MASCULINO"> Masculino</option>
                                        <option value="FEMENINO"> Femenino</option>

                                    </select>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Teléfono :</label>
                                    <input type="text" class="form-control numeroEntero" id="telefono-responsable"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Celular :</label>
                                    <input type="text" class="form-control numeroEntero" id="celular-responsable"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Estado civíl:</label>
                                    <select name="status" id="estado_civil-responsable" class="form-control">

                                        <option value="SOLTERO"> Soltero/a</option>
                                        <option value="CASADO"> Casado/a</option>
                                        <option value="DIVORCIADO"> Divociado/a</option>
                                        <option value="VIUDO"> Viudo/a</option>

                                    </select>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email :</label>
                                    <input onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                                        class="form-control" id="email-responsable" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Domicilio :</label>
                                    <input style="text-transform:uppercase;"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                                        class="form-control" id="domicilio-responsable" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-responsable" class="btn btn-secondary"
                        data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-editar-va">Guardar Cambios</button>
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
    <script>
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



        $(document).ready(function() {


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
                        'ci': $('#ci_responsable_edit').val(),
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
                            setTimeout(function() {
                                Object.keys(error.responseJSON.errors).forEach(function(
                                    k) {
                                    toastr["error"](error.responseJSON.errors[
                                        k]);
                                    //console.log(k + ' - ' + error.responseJSON.errors[k]);
                                });
                            }, 2000);
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
                        swal.fire({
                            title: data_response.response,
                            text: "",
                            type: "success",
                            timer: 1000,
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


            $(document).on('click', '#btn-editar', function() {

                $('#btn-editar-va').val($(this).val());

                $.ajax({
                    type: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    url: '/responsable/get-responsable/' + $(this).val(),
                    async: false,
                    success: function(data_response) {

                        $('#edit-responsable').modal('show');
                        $('#nombre-responsable').val(data_response.response.nombres);
                        $('#ci_responsable_edit').val(data_response.response.ci);
                        $('#primer_apellido-responsable').val(data_response.response
                            .primer_apellido);
                        $('#segundo_apellido-responsable').val(data_response.response
                            .segundo_apellido);
                        $('#fecha_nacimiento-responsable').val(data_response.response
                            .fecha_nacimiento);
                        $('#genero-responsable').val(data_response.response.genero);
                        $('#telefono-responsable').val(data_response.response.telefono);
                        $('#celular-responsable').val(data_response.response.celular);
                        $('#estado_civil-responsable').val(data_response.response.estado_civil);
                        $('#email-responsable').val(data_response.response.email);
                        $('#domicilio-responsable').val(data_response.response.domicilio);

                        $('#estado option[value="' + data_response.response.estado + '"]').attr(
                            "selected", "selected");
                    }
                })
            });







            $('#btn_guardar_responsable').on('click', function() {
                $.ajax({
                    type: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    url: "{{ route('new.responsable') }}",
                    async: false,
                    data: JSON.stringify({
                        'ci': $('#ci_responsable').val(),
                        'nombres': $('#nombre').val(),
                        'primer_apellido': $('#primer_apellido').val(),
                        'segundo_apellido': $('#segundo_apellido').val(),
                        'fecha_nacimiento': $('#fecha_nacimiento').val(),
                        'genero': $('#genero').val(),
                        'telefono': $('#telefono').val(),
                        'celular': $('#celular').val(),
                        'estado_civil': $('#estado_civil').val(),
                        'email': $('#email').val(),
                        'domicilio': $('#domicilio').val(),
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



            $('#new-responsable').on('click', function() {

                $('#modal-register-responsable').modal('show');
            });

            var datatable = $('#responsable-data').DataTable({
                "paging": true,
                "searching": true,
                "language": {

                    "sProcessing": '<p style="color: #012d02;">Cargando. Por favor espere...</p>',
                    //"sProcessing": '<img src="https://media.giphy.com/media/3o7bu3XilJ5BOiSGic/giphy.gif" alt="Funny image">',
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "No se encontraron registros...!!!",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": 'Buscar Responsable:',
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": 'Primero',
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                },
            });


        });
    </script>
@stop
