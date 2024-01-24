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
                    <h1 class="m-0">Información de Salida:
                        @if ($edicion == 1)
                            <i style="visibility: none" id="edit_abierto" class="text-success">Edición abierta</i>
                        @else
                            <i style="visibility: none" id="edit_cerrado" class="text-danger">Edición cerrado</i>
                        @endif
                    </h1>
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
                <form action="{{ route('salida.storeitems') }}" id="tablecreate" method="post">
                    @csrf
                    <?php
                    //var_dump($salidas);die;
                    ?>
                    @foreach ($salidas as $sal)
                        <div class="row">
                            <div class="col-4">
                                <label>Nro Boleta::</label>
                                <input type="text" class="form-control" id="nro_boleta_salida" name="nro_boleta_salida"
                                    readonly value="{{ $sal->nro_boleta }}">
                            </div>
                            <div class="col-4">
                                <label>Fecha Salida:</label>
                                <?php
                                setlocale(LC_TIME, 'es_BO.UTF-8');
                                
                                $fecha_ingreso = date('Y-m-d', strtotime($sal->fecha_salida));
                                ?>
                                <input type="date" class="form-control" id="fecha_salida" name="fecha_salida"
                                    placeholder="Select Fecha" value="{{ $fecha_ingreso }}" required>
                            </div>

                            <div class="col-4">
                                {{-- <input type="text" value="{{$sal->tipo_salida}}"> --}}
                                <label>Tipo:</label>
                                <select class="form-control" id="tipoproyecto" name="tipoproyecto" required>
                                    <option value=""> Seleccione un Seccion</option>
                                    <option value="Semaforizacion"
                                        {{ trim($sal->tipo_salida) == 'Semaforizacion' ? 'selected' : '' }}>Semaforizacion
                                    </option>
                                    <option value="Señalizacion"
                                        {{ trim($sal->tipo_salida) == 'Señalizacion' ? 'selected' : '' }}>Señalizacion
                                    </option>

                                    {{-- <option value="1"> Semaforizacion </option>
                                    <option value="2"> Señalizacion </option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Funcionario:</label>
                                <input type="text" class="form-control" id="funcionario" name="funcionario" readonly
                                    value="{{ $sal->proyecto }}">
                            </div>
                            <div class="col">
                                <label>Estado:</label>
                                <select class="form-control" id="estado_tabla_edit" name="estado_tabla_edit" required>
                                    <option value="AC" {{ trim($sal->estado) == 'AC' ? 'selected' : '' }}>ACTIVO
                                    </option>
                                    <option value="DC" {{ trim($sal->estado) == 'DC' ? 'selected' : '' }}>INACTIVO
                                    </option>
                                    {{-- <option value="AC"> ACTIVO </option>
                                    <option value="DC"> INACTIVO </option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Proyecto:</label>
                                <input type="text" class="form-control" id="proyecto" name="proyecto"
                                    placeholder="Programa" required value="{{ $sal->proyecto }}">
                            </div>
                            <div class="col">
                                <label>Estructura:</label>
                                <select class="form-control" id="estructura" name="estructura" required>
                                    <option value="">Seleccione una Estructura</option>
                                    <option value="Programa" {{ trim($sal->estructura) == 'Programa' ? 'selected' : '' }}>
                                        Programa</option>
                                    <option value="Proyecto" {{ trim($sal->estructura) == 'Proyecto' ? 'selected' : '' }}>
                                        Proyecto</option>
                                    <option value="POA" {{ trim($sal->estructura) == 'POA' ? 'selected' : '' }}>POA
                                    </option>
                                    <option value="Actividad"
                                        {{ trim($sal->estructura) == 'Actividad' ? 'selected' : '' }}>
                                        Actividad</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Direccion:</label>
                                <input type="text" class="form-control" id="direccion" name="direccion"
                                    placeholder="Programa" required value="{{ $sal->direccion }}">
                            </div>
                            <div class="col">
                                <label>Distrito:</label>
                                <select class="form-control" id="distrito" name="distrito" required>
                                    <option value="">Seleccione un distrito</option>
                                    <option value="1" <?= intval(trim($sal->distrito)) == 1 ? 'selected' : '' ?>>
                                        Distrito 1</option>
                                    <option value="2" <?= intval(trim($sal->distrito)) == 2 ? 'selected' : '' ?>>
                                        Distrito 2</option>
                                    <option value="3" <?= intval(trim($sal->distrito)) == 3 ? 'selected' : '' ?>>
                                        Distrito 3</option>
                                    <option value="4" <?= intval(trim($sal->distrito)) == 4 ? 'selected' : '' ?>>
                                        Distrito 4</option>
                                    <option value="5" <?= intval(trim($sal->distrito)) == 5 ? 'selected' : '' ?>>
                                        Distrito 5</option>
                                    <option value="6" <?= intval(trim($sal->distrito)) == 6 ? 'selected' : '' ?>>
                                        Distrito 6</option>
                                    <option value="7" <?= intval(trim($sal->distrito)) == 7 ? 'selected' : '' ?>>
                                        Distrito 7</option>
                                    <option value="8" <?= intval(trim($sal->distrito)) == 8 ? 'selected' : '' ?>>
                                        Distrito 8</option>
                                    <option value="9" <?= intval(trim($sal->distrito)) == 9 ? 'selected' : '' ?>>
                                        Distrito 9</option>
                                    <option value="10" <?= intval(trim($sal->distrito)) == 10 ? 'selected' : '' ?>>
                                        Distrito 10</option>
                                    <option value="11" <?= intval(trim($sal->distrito)) == 11 ? 'selected' : '' ?>>
                                        Distrito 11</option>
                                    <option value="12" <?= intval(trim($sal->distrito)) == 12 ? 'selected' : '' ?>>
                                        Distrito 12</option>
                                    <option value="13" <?= intval(trim($sal->distrito)) == 13 ? 'selected' : '' ?>>
                                        Distrito 13</option>
                                    <option value="14" <?= intval(trim($sal->distrito)) == 14 ? 'selected' : '' ?>>
                                        Distrito 14</option>
                                    <option value="15" <?= intval(trim($sal->distrito)) == 15 ? 'selected' : '' ?>>
                                        Distrito 15</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Descripcion Trabajo / Obra :</label>
                                <textarea class="form-control" rows="3" id="descripcion_trabajo" name="descripcion_trabajo"
                                    aria-label="Wilabel textarea" placeholder="DESCRIBA UNA OBSERVACION" required> {{ $sal->descripcion_trabajo }}</textarea>
                            </div>
                            <input type="hidden" id="id_salida" name="id_salida" value="{{ $sal->id }}">
                            <input type="hidden" id="cerrar_edicion" name="cerrar_edicion"value="{{ $sal->edicion }}">
                        </div>
                    @endforeach
                </form>

                <div class="row">
                    <div class="col-md">
                        <!-- Card header -->
                        <h3 class="mb-4">Lista de Items</h3>
                        <div class="rows">
                            @if ($edicion == 1)
                                <button type="button" class=" btn btn-primary" id="add_item_egreso">
                                    <i class="fas fa-plus-circle"> Buscar Item </i></button>
                            @endif

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
                    <button type="submit" id="btn_guardar_ingreso_update" class="btn btn-success mt-4">Actualizar
                        Salida</button>

                    <button type="button" id="btn_cerrar_edicion" class="btn btn-warning mt-4">Cerrar
                        Edición</button>

                        {{-- @if ($sal->edicion == 0) --}}
                        <a href="{{ route('salida.pdfSalida', $sal->id) }}" class="btn btn-info mt-4">Imprimir</a>
                        {{-- @endif --}}

                    <a href="{{ route('egreso') }}" id="btn_salir_ingreso" class="btn btn-danger mt-4">Salir</a>

                    {{-- <div class="col-4">
                            <button id="tablecreate" class="btn btn-danger mt-4">SALIR</button>
                        </div> --}}
                </div>
            </div>
            <!-- /FormCreate Datos Item -->
        </div>
    </fieldset>

    <div class="modal fade" id="modal_add_item_egreso" role="dialog" style=" padding-right: 15px;"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                style="width: 100%;" name="id_catalogo" id="select_id_catalogo_Modal" required>
                                <option value="">Seleccione un Item</option>

                                @foreach ($catalogos as $catalogo)
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" id='respuesta'></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" id="agregarItem_salida_update"><i
                                class="fas fa-plus-square"> Agregar Ítem</i></button>
                                
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
    <script>
        $(document).ready(function() {
            if ($("#cerrar_edicion").val() == 0) {
                $("#edit_abierto").hide();
                $("#edit_cerrado").show();
                $("#fecha_salida").attr("readonly", "readonly");
                $("#funcionario").attr("readonly", "readonly");
                $("#direccion").attr("readonly", "readonly");
                $("#descripcion_trabajo").attr("readonly", "readonly");

                // $("#almacen").removeAttr("readonly");
                $("#tipoproyecto").attr("readonly", "readonly");
                $("#tipoproyecto").attr('disabled', true);

                $("#estado_tabla_edit").removeAttr("readonly");
                $("#estado_tabla_edit").attr('disabled', true);

                $("#estructura").removeAttr("readonly");
                $("#estructura").attr('disabled', true);

                $("#distrito").removeAttr("readonly");
                $("#distrito").attr('disabled', true);

                $("#observacion").attr("readonly", "readonly");

                $("#btn_delete").hide();
                $("#add_item").hide();
                $("#btn_cerrar_edicion").hide();
                $("#btn_guardar_ingreso_update").hide();
                // btn_imprimir_ingreso btn_salir_ingreso
            }
            if ($("#cerrar_edicion").val() == 1) {
                $("#edit_abierto").show();
                $("#edit_cerrado").hide();
            }

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
        $(function() {
            id_salida = $('#id_salida').val();
            $('#detalleEgresoTemp').DataTable({
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
                ajax: {
                    url: "{{ route('salida.detalleSalida') }}",
                    type: "get",
                    data: {
                        id: id_salida
                    },
                    dataType: "json"
                },
                columns: [{
                        data: 'id',
                    },
                    {
                        data: 'nro_ingreso'
                    },
                    {
                        data: 'nro_boleta'
                    },
                    {
                        data: 'descripcion_catalogo'
                    },
                    {
                        data: 'descripcion_unidad_medida'
                    },
                    {
                        data: 'cantidad_salida'
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta) {
                            var button = '';
                            button += '<span class="spanFormat">';
                            if (data.edicion == 0) {
                                button += '';

                            } else {
                                button +=
                                    '<button type="button" id="btn_delete" class="btn btn-danger "  onclick="eliminaritemSalidaUpdate(' +
                                    data.id + ')">';
                                button += '<i class="fas fa-trash-alt"> </i></button>';
                            }

                            button += '</span>';
                            return button;
                        }

                    },
                ]
            });

        });

        $('#agregarItem_salida_update').on('click', function(e) {
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
                    url: "{{ route('salida.guardarDetalleItemUpdate') }}",
                    type: 'POST',
                    dataType: 'json',
                    async: false,
                    data: {
                        _token: "{{ csrf_token() }}",

                        id_item_catalogo: $("#select_id_catalogo_Modal").val(),
                        Cant_existente: $("#Cant_existente").val(),
                        cant_solicitada: $("#cant_solicitada").val(),
                        id_detalle_ingreso: $("#id_detalle_ingreso").val(),
                        id_salida: $("#id_salida").val(),
                        id_ingreso: $("#id_ingreso").val(),
                        precio: $("#precio").val(),
                        id_unidad_medida: $("#id_unidad_medida").val(),
                    },
                    success: function(data_response) {
                        // $("#modal_add_item_egreso").hide();
                        // $(".modal-backdrop").remove();
                        //var table = $('#detalleEgresoTemp').DataTable();
                        //table.ajax.reload();

                       // toastr["success"]("Registro realizado con éxito!");
                        //$('#modal_add_item_egreso').trigger("reset"); // for cleaning a modal form
                        location.reload();
                        limpiarModalItem();



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
            location.reload();

          //  e.preventDefault();
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
                    $("#codigo").val(respuesta['catalogosLlenar'][0].codigo);
                    $("#item_descripcion").val(respuesta['catalogosLlenar'][0].descripcion);
                    $("#item_detalle").val(respuesta['catalogosLlenar'][0].descripcion_catalogo);
                    $("#unidad_medida_modal").val(respuesta['catalogosLlenar'][0].descripcion_unidad_medida);
                    $("#id_unidad_medida_temp").val(respuesta['catalogosLlenar'][0].descripcion_unidad_medida);
                    $("#estado_modal").val(respuesta['catalogosLlenar'][0].estado);
                    $("#detalle_item_salida").val(respuesta['catalogosLlenar'][0].detalle_item);
                    $("#Cant_existente").val(respuesta.cantidad_existente);
                    $("#id_detalle_ingreso").val(respuesta['catalogosLlenar'][0].id_detalle_ingreso);
                    $("#id_ingreso").val(respuesta['catalogosLlenar'][0].id_ingreso);
                    $("#precio").val(respuesta['catalogosLlenar'][0].precio);
                    $("#id_unidad_medida").val(respuesta['catalogosLlenar'][0].id_unidad_medida);


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
            $('.select_id_catalogo_Modal').val(null);
            $("#item_detalle").val('');
            $("#codigo").val('');
            $("#unidad_medida_modal").val('');
            $("#id_unidad_medida_temp").val('');
            $("#Cant_existente").val('');
            $("#cant_solicitada").val('');
            $("#precio_ingreso").val('');
            $("#detalle_item_salida").val('');

            $("#id_detalle_ingreso").val('');
            $("#id_ingreso").val('');
            $("#precio").val('');
            $("#id_unidad_medida").val('');

        }
        //agremamos item para salida

        $('#btn_guardar_ingreso_update').on('click', function() {
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
                        url: "{{ route('salida.guardarSalidaUpdate') }}",
                        async: false,
                        data: JSON.stringify({
                            'nro_boleta_salida': $("#nro_boleta_salida").val(),
                            'fecha_salida': $("#fecha_salida").val(),
                            'tipo_proyecto': $("#tipoproyecto").val(),
                            'proyecto': $("#proyecto").val(),
                            'estructura': $("#estructura").val(),
                            'direccion': $("#direccion").val(),
                            'distrito': $("#distrito").val(),
                            'descripcion_trabajo': $("#descripcion_trabajo").val(),
                            'id_salida': $("#id_salida").val(),
                        }),
                        success: function(data_response) {
                            toastr["success"]("Registro realizado con éxito!");
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

        function eliminaritemSalidaUpdate(id) {
            $.ajax({
                url: "{{ route('salida.deleteItemSalidaUpdate') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function(data) {
                    $("#modal_add_item_egreso").hide();
                    $(".modal-backdrop").remove();
                    var table = $('#detalleEgresoTemp').DataTable();
                    table.ajax.reload();
                }
            });
            event.preventDefault();
        }

        $(document).on('click', '#btn_cerrar_edicion', function() {
            var id_salida = $("#id_salida").val();

            Swal.fire({
                title: "esta seguro Cerrar la edición!?",
                text: "Si continua, no se podrá modificar la edicion!",
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: 'Comfirmar',
                denyButtonText: 'Cancelar'

            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('salida.cerrarEdicionSalida') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id_salida: id_salida,
                        },
                        success: function(data) {

                            $('#detalleEgresoTemp').DataTable().ajax.reload();
                            swal.fire("OK!", data.response, "success");
                            location.reload(true);

                        },
                        error: function(xhr, textStatus, errorThrown) {
                            swal.fire({
                                title: "Ups!",
                                text: 'No se pudo cerrar la edición!',
                                type: "warning",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    });

                } else if (result.isDenied) {
                    Swal.fire('La operacion fue cancelado', '', 'info')
                }
            })
        });
    </script>
@stop
