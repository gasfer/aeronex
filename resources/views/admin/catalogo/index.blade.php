@extends('adminlte::page')
@section('title', 'Catalogo')
@section('plugins.Datatables', true)
@section('plugins.Animation', true)
@section('plugins.Toastr', true)
@section('plugins.Sweetalert2', true)
@section('plugins.Pace', true)


@section('content_header')
    <h1>CATALOGO ITEMS</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-header" style="text-align:left">
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal"
                onclick="limpiarCampos()">
                <i class="fas fa-plus-square"> Agregar Ítem</i>
            </button>
        </div>
        <div class="card-body">
            <table id="catalogo-data" class="table table-striped table-bordered responsive" role="grid"
                aria-describedby="example">
                <thead>
                    <tr>
                        <th># </th>
                        <th>Código </th>
                        <th>Descripción </th>
                        <th>Categoría</th>
                        <th>Unidad de Medida</th>
                        <th>Estado </th>
                        <th>Opciones </th>
                    </tr>
                </thead>
                <tbody>
                    @php($count = 1)
                    @foreach ($list_catalogo as $item)
                        <tr>
                            <td scope="row">{{ $count++ }}</td>
                            <td>{{ $item->codigo }}</td>
                            <td>{{ $item->descripcion_catalogo }}</td>
                            <td>{{ $item->nombre_categoria }}</td>
                            <td>{{ $item->descripcion_unidad_medida }}</td>
                            <td>{{ $item->estado }}</td>

                            <td>
                                <button type="button" class="btn btn-info" value="{{ $item->id }}" id="btn_edit"
                                    title="Editar Catalogo"><i class="fas fa-edit"></i></button>
                                @if ($item->estado == 'DC')
                                    <button type="button" class="btn btn-warning" value="{{ $item->id }}"
                                        id="btn-desactivar"><i class="fas fa-thumbs-down"></i></button>
                                @else
                                    <button type="button" class="btn btn-success" value="{{ $item->id }}"
                                        id="btn-desactivar"><i class="fas fa-thumbs-up"></i></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

    @include('admin.catalogo.modalcreate', [
        'id_button' => 'btn_guardar_item',
    ])
    @include('admin.catalogo.modaledit')
@stop

@section('css')

@section('js')
    <script>
        //EVITAR REFRESCAR F5
        /*  document.onkeydown = function() {
             switch (event.keyCode) {
                 case 116: //F5 button
                     event.returnValue = false;
                     event.keyCode = 0;
                     return false;
                 case 82: //R button
                     if (event.ctrlKey) {
                         event.returnValue = false;
                         event.keyCode = 0;
                         return false;
                     }
             }
         }*/

        function limpiarCampos() {
            $('#codigo_catalogo').val('');
            $('#descripcion_catalogo').val('');
            $('#id_unidad_medida').val('');
            $('#id_categoria').val('');
        }
        $(document).on('click', '#btn_edit', function() {
            var id = $(this).val();
            $.ajax({
                type: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                url: 'catalogo.edit/' + $(this).val(),
                async: false,
                success: function(data_response) {
                    $("#editmodalCatalogo").modal("show");
                    limpiarCampos();
                    $('#edit_codigo_catalogo').val(data_response.response[0].codigo);
                    $('#edit_descripcion_catalogo').val(data_response.response[0].descripcion_catalogo);

                    $('#edit_id_unidad_medida').val(data_response.response[0].id_unidad_medida);
                    $('#edit_id_categoria').val(data_response.response[0].id_categoria);
                    $('#id_catalogo').val(data_response.response[0].id);

                    // $('#edit_id_unidad_medida option[value="' + data_response.response[0].id_unidad_medida + '"]').attr("selected", "selected");
                    // $('#edit_id_categoria option[value="' + data_response.response[0].id_categoria + '"]').attr("selected", "selected");
                }
            })


        });
        //editar cuartel
        $('#btn-editar-update').on('click', function() {
            $.ajax({
                type: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                url: "{{ route('catalogo.update') }}",
                async: false,
                data: JSON.stringify({
                    'codigo': $('#edit_codigo_catalogo').val(),
                    'descripcion_catalogo': $('#edit_descripcion_catalogo').val(),
                    'id_unidad_medida': $('#edit_id_unidad_medida').val(),
                    'id_categoria': $('#edit_id_categoria').val(),
                    'estado_edit': $('#estado_edit').val(),
                    'id_catalogo': $('#id_catalogo').val()
                }),
                success: function(data_response) {
                    // swal.fire({
                    //     title: "Actualizado!",
                    //     text: "!Registro actualizado con éxito!",
                    //     type: "success",
                    //     timer: 2000,
                    //     showCancelButton: false,
                    //     showConfirmButton: false
                    // });

                    toastr["success"]("Registro realizado con éxito!");
                    location.reload();

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
        $('#btn_guardar_item').on('click', function() {
            $.ajax({
                type: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                url: "{{ route('catalogo.create') }}",
                async: false,
                data: JSON.stringify({
                    'codigo': $('#codigo_catalogo').val(),
                    'descripcion_catalogo': $('#descripcion_catalogo').val(),
                    'id_unidad_medida': $('#id_unidad_medida').val(),
                    'id_categoria': $('#id_categoria').val(),
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
                    }, 200);
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
                url: 'catalogo.disable/' + $(this).val(),
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
                        toastr["success"]("Registro realizado con éxito!");
                        location.reload();
                    }, 200);
                },
                error: function(error) {

                    if (error.status == 422) {
                        setTimeout(function() {
                            Object.keys(error.responseJSON.errors).forEach(function(k) {
                                toastr["error"](error.responseJSON.errors[k]);
                            }, 2000);


                            //console.log(k + ' - ' + error.responseJSON.errors[k]);
                        });
                    } else if (error.status == 419) {
                        setTimeout(function() {
                            toastr["warning"]("registro norealizado!");
                        }, 2000);
                    } else if (error.status == 200) {
                        setTimeout(function(response) {
                            toastr["warning"](response);
                        }, 2000);

                        location.reload();
                    }

                }
            })
        });



        var datatable = $('#catalogo-data').DataTable({
            "paging": true,
            "searching": true,
            "responsive": true,
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
    </script>
@stop
