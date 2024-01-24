@extends('adminlte::page')
@section('plugins.Select2', true)
@section('plugins.Datatables', true)
@section('title', 'Ingreso')
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" id="txt_ini">Información de la salida de Ítem</h1>
                    <h1 class="m-0" id="txt_edit_abierto" style="display: none;">Información de Salida: <i
                            class="text-red">Edición abierta</i></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Principal</a></li>
                        <li class="breadcrumb-item active"> <a href="{{ route('egreso') }}">Lista Salida Ítem </a></li>
                        <li class="breadcrumb-item active">Formulario Salida</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop
@section('content')
    <fieldset>
        <div class="card">

            <!-- FormCreate Datos Item -->
            <div class="card-body">
                {{-- <form action="{{ route('salida.guardarSalida') }}" method="post"> --}}
                @csrf
                <div class="row">
                    {{-- <div class="col-4">
                            <label>Nro Boleta::</label>
                            <input type="text" class="form-control" id="nro_boleta_salida" name="nro_boleta_salida"
                                readonly value="{{ $numero_salida }}">
                        </div> --}}

                    <div class="col-4">
                        <label>Fecha Salida:</label>
                        <input type="date" class="form-control" id="fecha_salida" name="fecha_salida"
                            placeholder="Select Fecha" value="{{ date('Y-m-d') }}" value="{{ old('fecha_salida') }}"
                            required>
                    </div>
                    <div class="col-4">
                        <label>Tipo:</label>
                        <select class="form-control" id="tipo_proyecto" name="tipo_proyecto" required>
                            <option value=""> Seleccione un Seccion</option>
                            <option value="Semaforizacion"> Semaforizacion </option>
                            <option value="Señalizacion"> Señalizacion </option>
                        </select>
                    </div>

                    <div class="col">
                        <label>Funcionario:</label>
                        <input type="text" class="form-control" id="funcionario" name="funcionario" readonly
                            value="{{ $Name }}">
                    </div>
                    {{-- <div class="col">
                            <label>Estado:</label>
                            <select class="form-control" id="estado_tabla" name="estado" required readonly>

                                <option value="ACTIVO"> ACTIVO </option>
                                <option value="INACTIVO"> INACTIVO </option>
                            </select>
                        </div> --}}
                </div>
                <div class="row">
                    <div class="col">
                        <label>Proyecto:</label>
                        <input type="text" class="form-control" id="proyecto" name="proyecto" placeholder="Programa"
                            value="{{ old('proyecto') }}" required>
                    </div>
                    <div class="col">
                        <label>Estructura:</label>
                        <select class="form-control" id="estructura" name="estructura" required>
                            <option value="">Seleccione una Estructura</option>
                            <option value="Programa ">Programa</option>
                            <option value="Proyecto ">Proyecto</option>
                            <option value="POA      ">POA</option>
                            <option value="Actividad">Actividad</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Direccion:</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Programa"
                            value="{{ old('direccion') }}" required>
                    </div>
                    <div class="col">
                        <label>Distrito:</label>
                        <select class="form-control" id="distrito" name="distrito" required>
                            <option value="">Seleccione un Distrito</option>
                            @for ($i = 1; $i <= 15; $i++)
                                <option value="{{ $i }}">Distrito - {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Descripcion Trabajo / Obra :</label>
                        <textarea class="form-control" rows="3" id="descripcion_trabajo" name="descripcion_trabajo"
                            value="{{ old('descripcion_trabajo') }}" aria-label="Wilabel textarea" placeholder="DESCRIBA UNA OBSERVACION"
                            required></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md">
                        <!-- Card header -->
                        <h3 class="mb-4">Lista de Items</h3>
                        <div class="rows">
                            <button type="button" class=" btn btn-primary" id="add_item_egreso">
                                <i class="fas fa-plus-circle"> Buscar Item </i></button>
                            <br />
                            <table class="table table-striped" id="detalleEgresoTemp">
                                <thead>
                                    <tr>
                                        <th>NRO </th>
                                        <th>INGRESO </th>
                                        <th>CODIGO </th>
                                        <th>DESCRIPCION </th>
                                        <th>UNIDAD </th>
                                        <th>CANTIDAD </th>
                                        {{-- <th>PRECIO </th> --}}
                                        <th>OPCION </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <!-- /Form Datos Item -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" style="display: none;" id="btn_actualizar_ingreso"
                        class="btn btn-info mt-4">Actualizar Ingreso</button>

                    <button type="submit" id="registrarSalida" class="btn btn-success mt-4">GRABAR SALIDA</button>
                    {{-- onclick="CancelarItemSalida()"href="{{ route('egreso') }}"  --}}
                    <a href="{{ route('egreso') }}" class="btn btn-danger mt-4">CANCELAR</a>
                    {{-- <div class="col-4">
                            <button id="tablecreate" class="btn btn-danger mt-4">SALIR</button>
                        </div> --}}
                </div>
                </form>
            </div>
            <!-- /FormCreate Datos Item -->
        </div>
    </fieldset>
    <div class="modal fade" id="modal_add_item_egreso" data-backdrop="false" role="dialog"
        style=" padding-right: 15px;"aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Item Salida
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label>Item:</label>
                            <select onchange="completarCatalgo()" class="select_id_catalogo_Modal  form-control select2"
                                style="width: 100%;" name="select_id_catalogo_Modal" id="select_id_catalogo_Modal"
                                required>
                                @foreach ($Catalogos as $catalogo)
                                    <option value="{{ $catalogo['id'] }}">{{ $catalogo['descripcion_catalogo'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label>Ítem:</label>
                            <input type="text" class=" form-control" id="item_detalle"name="item_detalle" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Codigo:</label>
                            <input type="text" class=" numeroEntero form-control" id="codigo"name="codigo"
                                required readonly>
                        </div>
                        <div class="col-6">
                            <label>U. Medida:</label>
                            <input type="text" class="form-control" name="unidad_medida_modal"
                                id="unidad_medida_modal" required readonly>
                            <input type="hidden" name="id_unidad_medida_temp" id="id_unidad_medida_temp">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Descripcion Ítem ingreso :</label>
                            <textarea class="form-control" rows="3" id="detalle_item_salida" name="detalle_item_salida"
                                aria-label="Wilabel textarea" required readonly></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Cantidad Existente:</label>
                            <input type="text" class="numeroEntero form-control " id="Cant_existente"
                                name="Cant_existente" readonly placeholder="0.0" required>
                        </div>
                        <div class="col-6">
                            <label>Cantidad Solicitada:</label>
                            <input type="text"id="cant_solicitada" class="numeroEntero form-control"
                                cname="cant_solicitada" required>
                            <input type="hidden"id="id_detalle_ingreso" name="id_detalle_ingreso" required>
                            <input type="hidden"id="id_ingreso" name="id_ingreso" required>
                            <input type="hidden"id="precio" name="precio" required>
                            <input type="hidden"id="id_unidad_medida" name="id_unidad_medida" required>
                            <input type="hidden"id="nro_ingreso" name="nro_ingreso" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" id='respuesta'></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="agregarItem_salida"><i
                                class="fas fa-plus-square"> Agregare Ítem</i></button>
                        <button type="button" class="btn btn-outline-danger pull-left"
                            data-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
@stop

@section('js')
    <script language="JavaScript" type="text/javascript">
        //EVITAR REFRESCAR F5
        // document.onkeydown = function() {
        //     switch (event.keyCode) {
        //         case 116: //F5 button
        //             event.returnValue = false;
        //             event.keyCode = 0;
        //             return false;
        //         case 82: //R button
        //             if (event.ctrlKey) {
        //                 event.returnValue = false;
        //                 event.keyCode = 0;
        //                 return false;
        //             }
        //     }
        // }
        $("#registrarSalida").show();
        $("#btn_actualizar_ingreso").hide();
    </script>
    <script>
        $(function() {
            limpiarModalItem();
            $('#detalleEgresoTemp').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                paging: true,
                language: {
                    "sProcessing": '<p style="color: #012d02;">Cargando. Por favor espere...</p>',
                    "sProcessing": '<img src="https://media.giphy.com/media/3o7bu3XilJ5BOiSGic/giphy.gif" alt="Funny image">',
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "No se encontraron registros...!!!",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": 'Buscar Salidas:',
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
                ajax: '{{ route('salida.detalleItemSalida') }}',
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'nro_ingreso'
                    },
                    {
                        data: 'codigo'
                    },
                    {
                        data: 'descripcion_catalogo'
                    },
                    {
                        data: 'unidad_medida_text'
                    },
                    {
                        data: 'cantidad_salida'
                    },
                    // {
                    //     data: 'precio_ingreso'
                    // },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            var button = '';
                            if (data) {
                                button += '<span class="spanFormat">';
                                button +=
                                    '<button type="button"  class="  btn btn-danger " onclick="eliminaritemSalida(' +
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
        $(document).on('click', '#add_item_egreso', function() {
            limpiarModalItem();
            $("#modal_add_item_egreso").modal("show");
        });


        $("#cant_solicitada").change(function() { // 1st way

            cant_solicitada = parseInt($('#cant_solicitada').val());
            Cant_existente = parseInt($('#Cant_existente').val());
            if (cant_solicitada > Cant_existente) {
                //alert('la cantidad solicitadad no puede ser mayor al existente');
                $("#respuesta").show();
                $("#respuesta").html(
                    "<div class=' text-danger'>La cantidad solicitadad no puede ser mayor al existente</div>"
                );
                setTimeout(function() {
                    $('#cant_solicitada').focus();
                    $('#respuesta').fadeOut('slow');
                }, 3000);
                $('#cant_solicitada').val('');
            }

        });

        function completarCatalgo() {
            select_id_catalogo_Modal = $("#select_id_catalogo_Modal").val();
            $.ajax({
                url: "{{ route('salida.llenarcatalogoSalida') }}",
                type: 'GET',
                data: {
                    _token: "{{ csrf_token() }}",
                    select_id_catalogo_Modal: select_id_catalogo_Modal,
                },
                success: function(respuesta) {
                    if (respuesta != null) {
                        $("#codigo").val(respuesta['catalogosLlenar'][0].codigo);
                        $("#item_descripcion").val(respuesta['catalogosLlenar'][0].descripcion);
                        $("#item_detalle").val(respuesta['catalogosLlenar'][0].descripcion_catalogo);
                        $("#unidad_medida_modal").val(respuesta['catalogosLlenar'][0]
                        .descripcion_unidad_medida);
                        $("#id_unidad_medida_temp").val(respuesta['catalogosLlenar'][0]
                            .descripcion_unidad_medida);
                        $("#estado_modal").val(respuesta['catalogosLlenar'][0].estado);
                        $("#detalle_item_salida").val(respuesta['catalogosLlenar'][0].detalle_item);
                        $("#Cant_existente").val(respuesta.cantidad_existente);
                        $("#id_detalle_ingreso").val(respuesta['catalogosLlenar'][0].id_detalle_ingreso);
                        $("#id_ingreso").val(respuesta['catalogosLlenar'][0].id_ingreso);
                        $("#precio").val(respuesta['catalogosLlenar'][0].precio);
                        $("#id_unidad_medida").val(respuesta['catalogosLlenar'][0].id_unidad_medida);

                    } else {
                        console.log("sin informacion");
                    }
                },
                error: function() {
                    console.log("No se ha podido obtener la información");
                }
            });
        }
        $(".select_id_catalogo_Modal").select2({
            placeholder: "Seleccione una opcion",
            allowClear: true
        })

        function limpiarModalItem() {
            // $("#select_id_catalogo_Modal").select2("val", "");
            $("#select_id_catalogo_Modal").val("");

            $("#item_detalle").val('');
            $("#codigo").val('');
            $("#unidad_medida_modal").val('');
            $("#id_unidad_medida_temp").val('');
            $("#Cant_existente").val('');
            $("#cant_solicitada").val('');
            $("#precio_ingreso").val('');
            $("#detalle_item_salida").val('');
        }
        //agremamos item para salida

        $('#registrarSalida').on('click', function() {
            Swal.fire({
                title: 'Está seguro!',
                text: 'se guardaran los registros de salida seleccionados.',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'GuardarSalida',
                denyButtonText: `No guardar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        url: "{{ route('salida.guardarSalida') }}",
                        async: false,
                        data: JSON.stringify({
                            'nro_boleta_salida': $("#nro_boleta_salida").val(),
                            'fecha_salida': $("#fecha_salida").val(),
                            'tipo_proyecto': $("#tipo_proyecto").val(),
                            'proyecto': $("#proyecto").val(),
                            'estructura': $("#estructura").val(),
                            'direccion': $("#direccion").val(),
                            'distrito': $("#distrito").val(),
                            'descripcion_trabajo': $("#descripcion_trabajo").val(),
                        }),
                        success: function(data_response) {
                            toastr["success"]("Registro realizado con éxito!");
                            $("#registrarSalida").hide();
                            $("#btn_actualizar_ingreso").show();
                            window.location.replace(data_response);
                            //  var urlPara = "{{ route('ingreso.edit', ':data_response.id') }}";
                            //  urlPara = urlPara.replace(':id', resultado.campana);
                            //  window.location = urlPara;
                            Swal.fire('Guardado!', 'se registró correctamente..!!!', 'success')
                        },
                        error: function(error) {
                            if (error.status == 422) {
                                Object.keys(error.responseJSON.errors).forEach(function(k) {
                                    toastr["error"](error.responseJSON.errors[k]);
                                });
                            } else if (error.status == 419) {
                                location.reload();
                            }

                        }
                    })

                } else if (result.isDenied) {
                    Swal.fire('Se cancelo la operacion', '', 'info')
                }
            })
        });

        $('#agregarItem_salida').on('click', function(e) {
            var id_unidad_medida_temp = $('select[id=select_id_catalogo_Modal]').val();
            var cant_solicitada = $('#cant_solicitada').val();
            if (id_unidad_medida_temp == '' && cant_solicitada == '') {
                swal.fire({
                    title: "Alerta!",
                    text: "!Es necesario seleccionar al menos un item e ingresar la cantikdad solicitada.",
                    type: "success",
                    timer: 2000,
                    showCancelButton: false,
                    showConfirmButton: true
                });
                // select_id_catalogo_Modal  item_detalle codigo unidad_medida_modal detalle_item_salida Cant_existente cant_solicitada
            } else {
                $.ajax({
                    url: "{{ route('salida.guardarItemSalidaTemporal') }}",
                    type: 'POST',
                    dataType: 'json',
                    async: false,
                    data: {
                        _token: "{{ csrf_token() }}",
                        id_item_catalogo: $("#select_id_catalogo_Modal").val(),
                        item_detalle: $("#item_detalle").val(),
                        codigo: $("#codigo").val(),
                        nro_ingreso: $("#nro_ingreso").val(),
                        unidad_medida_modal: $("#unidad_medida_modal").val(),
                        unidad_medida_text: $("#id_unidad_medida_temp").val(),
                        detalle_item_salida: $("#detalle_item_salida").val(),
                        Cant_existente: $("#Cant_existente").val(),
                        cant_solicitada: $("#cant_solicitada").val(),
                        id_detalle_ingreso: $("#id_detalle_ingreso").val(),
                        id_ingreso: $("#id_ingreso").val(),
                        precio: $("#precio").val(),
                        id_unidad_medida: $("#id_unidad_medida").val(),
                    },
                    success: function(data_response) {
                         $("#modal_add_item_egreso").hide();
                         $(".modal-backdrop").remove();
                         var table = $('#detalleEgresoTemp').DataTable();
                         table.ajax.reload();

                        // toastr["success"]("Registro realizado con éxito!");
                        // location.reload();
                    },
                    error: function(error) {

                        if (error.status == 422) {
                            Object.keys(error.responseJSON.errors).forEach(function(k) {
                                toastr["error"](error.responseJSON.errors[k]);
                            });
                        } else if (error.status == 419) {
                            location.reload();
                        }
                    }
                });
            }
            e.preventDefault();
        });

        function eliminaritemSalida(id) {
            $.ajax({
                url: "{{ route('salida.deleteItemSalidaTemp') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function(data) {
                    // $("#modal_add_item_egreso").hide();
                    // $(".modal-backdrop").remove();
                    // var table = $('#detalleEgresoTemp').DataTable();
                    // table.ajax.reload();
                    location.reload();

                }
            });
            //event.preventDefault();
        }

        function CancelarItemSalida() {
            var id_detalle_ingreso = $('#id_detalle_ingreso').val();
            if (id_detalle_ingreso != '') {
                id_detalle_ingreso = $('#id_detalle_ingreso').val();
            } else {
                id_detalle_ingreso = 0;

            }
            $.ajax({
                url: "{{ route('salida.cancelarItemSalidaTemp') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    id_detalle_ingreso: id_detalle_ingreso,
                },
                success: function(response) {

                    window.location.replace(response);

                }
            });
        }
        $("#select_id_catalogo_Modal").val("");

        $(".select_id_catalogo_Modal").select2({
            placeholder: "Seleccione una opcion",
            allowClear: true,
            language: {

                noResults: function() {

                    return "No hay stock, en almacén";
                },
                searching: function() {

                    return "Buscando ítems...";
                }
            }
        })
    </script>
@stop
