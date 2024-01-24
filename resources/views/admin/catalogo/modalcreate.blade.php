<div class="modal fade" id="exampleModal" style=" padding-right: 15px;" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registro Catalogo Ítem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label>Código:</label>
                        <input type="text" class="form-control" id="codigo_catalogo" name="codigo_catalogo" maxlength="9"
                            placeholder="Ingrese El Codigo del Catalogo" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Descripción:</label>
                        <input type="text" class="form-control" id="descripcion_catalogo" name="descripcion_catalogo"
                            placeholder="Ingrese alguna descripción" required> 
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>U. Medida:</label>
                        <select class="form-control" name="id_unidad_medida" id="id_unidad_medida" required>
                            <option value="">Seleccione una Unidad de Medida </option>
                            @foreach ($UnidadMedidas as $UnidadMedida)
                                <option value="{{ $UnidadMedida['id'] }}">
                                    {{ $UnidadMedida['descripcion_unidad_medida'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label>Categoría:</label>
                        <select class="form-control" name="id_categoria" id="id_categoria" required>
                            <option value="">Seleccione una Categoría </option>

                            @foreach ($categoria as $cat)
                                <option value="{{ $cat['id'] }}">
                                    {{ $cat['nombre_categoria'] }}</option>
                            @endforeach

                        </select>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btn_guardar_item" class="btn btn-primary"><i class="fas fa-save"> Guardar Ítem</i></button>
                
            </div>
        </div>

    </div>

</div>
<script>
    function funcionarioName() {
        //select_id_catalogo = $("#select_id_catalogo_Modal").val();
        //alert(select_id_catalogo);
        $.ajax({
            url: "{{ route('catalogo.usuario') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                _token: "{{ csrf_token() }}",
                //select_id_catalogo  : select_id_catalogo,
            },

            success: function(respuesta) {
                $("#id_usuario").val(respuesta);
            },
            error: function() {
                console.log("No se ha podido obtener la información");
            }
        });
    }

</script>
