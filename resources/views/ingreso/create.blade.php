@extends('adminlte::page')
@section('plugins.Select2', true)
@section('plugins.Datatables', true)
@section('title', 'Salida')
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)
@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" id="txt_ini">Datos del ingreso de Ítem</h1>
                    <h1 class="m-0" id="txt_edit_abierto" style="display: none;">Información de Ingreso: <i
                            class="text-red">Edicion abierta</i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Principal</a></li>
                        <li class="breadcrumb-item active"> <a href="{{ route('ingreso') }}">Lista Ingreso</a></li>
                        <li class="breadcrumb-item active">Formulario Ingreso</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('content')
    <!-- Content Header (Page header) -->
    <fieldset>
        <div class="card">
            <!-- TableCreate Datos Item -->
            <div class="card-body" id="modal-register-item">
                {{-- <form action="{{ route('ingreso.storeitems') }}" id="tablecreate" method="post">
                    @csrf --}}
                <div class="row">
                    <div class="col">
                        <label>Nro Ingreso:</label>
                        <input type="text" class="numeroEntero form-control" id="nro_ingreso" name="nro_ingreso"
                            placeholder="Ingrese el número de ingreso" value="{{ old('nro_ingreso') }}">
                    </div>
                    <div class="col">
                        <label>Nro Egreso:</label>
                        <input class=" numeroEntero form-control" id="nro_egreso" name="nro_egreso"
                            placeholder="Ingrese el número de egreso" value="{{ old('nro_egreso') }}">
                    </div>
                    <div class="col">
                        <label>Almacen:</label>
                        <select class="form-control" id="almacen" name="almacen" value="{{ old('almacen') }}">
                            <option value="A" selected> Almacen A </option>
                            <option value="B"> Almacen B </option>
                            <option value="C"> Almacen C </option>
                            <option value="D"> Almacen D </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <label>Procedencia:</label>
                        <input type="text" class="form-control" id="procedencia" name="procedencia" 
                             value="{{ old('procedencia') }}">
                    </div>
                    <div class="col-4">
                        <label>Nro. Orden de Compra:</label>
                        <input type="text" class="form-control" id="orden_compra" name="orden_compra" 
                        value="{{ old('orden_compra') }}">
                    </div>
                    <div class="col-4">
                        <label>Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" readonly
                            value="{{ date('Y-m-d') }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label>Funcionario:</label>
                        <input type="text" class="form-control" id="funcionario" name="funcionario" readonly
                            value="{{ $Name }}">
                    </div>
                    {{-- <div class="col">
                        <label>Estado:</label>
                        <select class="form-control" id="estado_tabla" name="estado" >

                            <option value="ACTIVO"> ACTIVO </option>
                            <option value="INACTIVO"> INACTIVO </option>
                        </select>
                    </div> --}}
               
                </div>
                <div class="row">
                    <div class="col-12">
                        <label>Observación:</label>
                        <textarea class="form-control" id="observacion" name="observaciones" aria-label="Wilabel textarea"
                            placeholder="Ingrese una observación"></textarea>
                    </div>
                </div>
                <fieldset>
                    <legend>Información de ítems</legend>
                    <div class="card">
                        <div class="card-body">
                            {{-- <div class="col" style="text-align:left">
                                <a href="{{ route('Ingreso.create') }}" class="btn btn-primary " data-toggle="modal"
                                    data-target="#modal">
                                    <i class="fas fa-plus-square"> Nuevo ítem</i>
                                </a>
                            </div> --}}

                            <button type="button" class="add_item btn btn-primary" id="add_item">
                                <i class="fas fa-plus-circle"> Buscar Ítem </i></button>
                            <br />
                            <table class="table table-striped" id="detalleIngresoTemp">
                                <thead>
                                    <tr>
                                        <th>NRO </th>
                                        <th>CODIGO </th>
                                        <th>DESCRIPCION </th>
                                        <th>UNIDAD </th>
                                        <th>CANTIDAD </th>
                                        <th>PRECIO </th>
                                        <th>OPCION </th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
                    </div>
                </fieldset>
                <div class="text-center">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" style="display: none;" id="btn_actualizar_ingreso"
                                class="btn btn-info mt-4">Actualizar Ingreso</button>
                            <button type="submit" id="btn_guardar_ingreso" class="btn btn-success mt-4">Grabar
                                Ingreso</button>
                            <a href="{{ route('ingreso') }}" id="btn_salir_ingreso" class="btn btn-danger mt-4">Cancelar</a>
                        </div>
                        {{-- <div class="col-4">
                            <button id="tablecreate" class="btn btn-danger mt-4">SALIR</button>
                        </div> --}}
                    </div>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </fieldset>

    <div class="modal fade " id="modal_add_item" style=" padding-right: 15px;" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registro Item a Ingreso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label>Item:</label>
                            <select onchange="completarCatalgo()" class="select_id_catalogo_Modal form-control select2"
                                style="width: 100%;" name="id_catalogo" id="select_id_catalogo_Modal" required>
                                <option value="">Seleccione un Item</option>

                                @foreach ($Catalogos as $catalogo)
                                    <option value="{{ $catalogo['id'] }}">{{ $catalogo['descripcion_catalogo'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Código:</label>
                            <input type="text" class=" numeroEntero form-control" id="codigo" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>U. Medida:</label>
                            <input type="text" class="form-control" name="unidad_medida_modal"
                                id="unidad_medida_modal" required readonly>
                            <input type="hidden" name="id_unidad_medida_temp" id="id_unidad_medida_temp">
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col">
                            <label>Estado:</label>
                            <input type="tex" class="form-control" id="estado_modal" name="estado" required
                                readonly>
                        </div>
                        <div class="col">
                            <label>Funcionario:</label>
                            <input type="tex" class="form-control" id="id_usuario" required readonly>
                        </div>
                    </div> --}}
                    <div class="row">

                        <div class="col-6">
                            <label>Cantidad Ingreso:</label>
                            <input type="text" class="form-control numeroEntero" id="cantidad_ingreso"
                                name="cantidad_ingreso" placeholder="ingrese cantidad" required>
                        </div>
                        <div class="col-6">
                            <label>Precio Ingreso:</label>
                            <input type="text" class="form-control " id="precio_ingreso" name="precio_ingreso"
                                placeholder="ingrese precio" required>
                            <input type="hidden" name="id_item_catalogo" id="id_item_catalogo">
                        </div>
                    </div>
                    <div class="row">

                        <label>Descripción Ítem:</label>
                        <textarea class="form-control" rows="3" id="detalle_item" name="detalle_item" aria-label="Wilabel textarea"
                            placeholder="Ingrese una observación"></textarea>
                    </div>
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6">
                                <button type="text" class="btn btn-success mt-4" id="agregarItem"><i
                                        class="fas fa-plus-square"> Agregar Ìtem</i></button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-danger mt-4" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal asignar item --}}
@stop

@section('js')

    <script type="text/javascript" charset="utf-8">
        //select2 cuartel
        $("#select_id_catalogo_Modal").select2({
            width: 'resolve', // need to override the changed default
            dropdownParent: $('#modal-register-bloque')
        });
        $(document).on('click', '#add_item', function() {
            limpiarModalItem();
            $("#modal_add_item").modal("show");

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
        function completarCatalgo() {
            //select_id_catalogo_Modal = $("#select_id_catalogo_Modal").val();
            var select_id_catalogo_Modal = document.getElementById("select_id_catalogo_Modal").value;

            $("#id_unidad_medida_temp").val('');
            $.ajax({
                url: "{{ route('ingreso.llenarcatalogo') }}",
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    select_id_catalogo: select_id_catalogo_Modal,
                },
                success: function(respuesta) {
                    $("#codigo").val(respuesta[0].codigo);
                    $("#item_descripcion").val(respuesta[0].descripcion);
                    $("#unidad_medida_modal").val(respuesta[0].descripcion_unidad_medida);
                    // $("#id_usuario").val(respuesta[0].id_usuario);
                    $("#estado_modal").val(respuesta[0].estado);
                    $("#id_unidad_medida_temp").val(respuesta[0].id_unidad_medida);
                    $("#id_item_catalogo").val(respuesta[0].id);
                    $('#cantidad_ingreso').focus();
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });
        }

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


      
        $('#agregarItem').on('click', function() {
            var id_unidad_medida_temp = $('select[id=select_id_catalogo_Modal]').val();
            if (id_unidad_medida_temp == '') {
                swal.fire({
                    title: "Alerta!",
                    text: "!Es necesario seleccionar al menos un item!",
                    type: "success",
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: true
                });

            } else {
                var item_descripcion = $('select[name="id_catalogo"] option:selected').text()
                var codigo = $("#codigo").val();
                var unidad_medida_modal = $("#unidad_medida_modal").val();
                var cantidad_ingreso = $("#cantidad_ingreso").val();
                var id_item_catalogo = $("#id_item_catalogo").val();
                var precio_ingreso = $("#precio_ingreso").val();
                var funcionario = $("#funcionario").val();
                var detalle_item = $("#detalle_item").val();
                $.ajax({
                    url: "{{ route('ingreso.guardarItem') }}",
                    type: 'POST',
                    dataType: 'json',
                    async: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_item_catalogo: id_item_catalogo,
                        codigo: codigo,
                        item_descripcion: item_descripcion,
                        unidad_medida_modal: unidad_medida_modal,
                        cantidad_ingreso: cantidad_ingreso,
                        id_unidad_medida_temp: id_unidad_medida_temp,
                        precio_ingreso: precio_ingreso,
                        funcionario: funcionario,
                        detalle_item: detalle_item,
                    },
                    success: function(data_response) {
                        // swal.fire({
                        //     title: "Registrado!",
                        //     text: "!Item agregado con éxito!",
                        //     type: "success",
                        //     timer: 1000,
                        //     showCancelButton: false,
                        //     showConfirmButton: false
                        // });
                        setTimeout(function() {
                            $("#modal_add_item").hide();
                            $(".modal-backdrop").remove();
                            var table = $('#detalleIngresoTemp').DataTable();
                            table.ajax.reload();
                            $('#modal_add_item').trigger("reset"); // for cleaning a modal form
                            $('#close_model').click(); // for closing a modal with backdrop
                            //location.replace('/ingreso');
                               location.reload();

                        }, 200);

                        toastr["success"]("Registro realizado con éxito!");
                        // detalleIngresoTemp
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
                });
               // event.preventDefault();

            }

        });

        $('#btn_guardar_ingreso').on('click', function() {
            $.ajax({
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                url: "{{ route('ingreso.storeitems') }}",
                async: false,
                data: JSON.stringify({
                    'nro_ingreso': $('#nro_ingreso').val(),
                    'nro_egreso': $('#nro_egreso').val(),
                    'almacen': $('#almacen').val(),
                    'id_categoria': $('#id_categoria').val(),
                    'observaciones': $('#observacion').val(),
                    'funcionario': $('#funcionario').val(),
                    'detalle_item': $('#detalle_item').val(), 
                    'procedencia': $('#procedencia').val(),
                    'orden_compra': $('#orden_compra').val(),
                }),
                success: function(data_response) {
                    // swal.fire({
                    //     title: "Guardado!",
                    //     text: "!Registro realizado con éxito!",
                    //     type: "success",
                    //     timer: 2000,
                    //     showCancelButton: false,
                    //     showConfirmButton: false
                    // });
                    /*  setTimeout(function() {
                          // location.reload();
                          var table = $('#detalleIngresoTemp').DataTable();
                          table.ajax.reload();
                          $('#modal_add_item').trigger("reset"); // for cleaning a modal form
                          $('#close_model').click(); // for closing a modal with backdrop
                          $('#btn_guardar_ingreso').hide(); // for closing a modal with backdrop
                          $('#btn_actualizar_ingreso').show();
                      .show(); // for closing a modal with backdrop


                      }, 1000);*/
                    toastr["success"]("Registro realizado con éxito!");
                    window.location.replace(data_response);
                    /* var urlPara = "{{ route('ingreso.edit', ':data_response.id') }}";
                     urlPara = urlPara.replace(':id', resultado.campana);
                     window.location = urlPara;*/
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

        $(function() {
            $('#detalleIngresoTemp').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                paging: true,
                language: {
                    "sProcessing": '<p style="color: #012d02;">Cargando. Por favor espere...</p>',
                    //"sProcessing": '<img src="https://media.giphy.com/media/3o7bu3XilJ5BOiSGic/giphy.gif" alt="Funny image">',
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "No se encontraron registros...!!!",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": 'Buscar Ingresos:',
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
                ajax: '{{ route('ingreso.catalogotemp') }}',
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'codigo'
                    },
                    {
                        data: 'descripcion_catalogo'
                    },
                    {
                        data: 'id_unidad_medida'
                    },
                    {
                        data: 'cantidad_ingreso'
                    },
                    {
                        data: 'precio_ingreso'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            var button = '';
                            if (data) {
                                button += '<span class="spanFormat">';
                                button +=
                                    '<button type="button"  class="  btn btn-danger " onclick="eliminaritem(' +
                                    data.id + ')">';
                                button += '<i class="fas fa-trash-alt"> </i></button>';
                                button += '</span>';
                            } else {
                                button = ''
                            }

                            return button;
                        }

                    },
                ]
            });
        });


        function eliminaritem(id) {
            // alert(id);

            $.ajax({
                url: "{{ route('ingreso.deleteItem') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function(data) {
                    $("#modal_add_item").hide();
                    $(".modal-backdrop").remove();
                    var table = $('#detalleIngresoTemp').DataTable();
                    table.ajax.reload();
                }
            });


            event.preventDefault();


        }
    </script>

@stop
