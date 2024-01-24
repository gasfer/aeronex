    <div class="modal fade" id="editmodalCatalogo" style=" padding-right: 15px;" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Registro </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label>Código:</label>
                            <input type="text" class="form-control" id="edit_codigo_catalogo"
                                name="edit_codigo_catalogo" placeholder="Ingrese El Codigo del Catalogo" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>Descrpción:</label>
                            <input type="text" class="form-control" id="edit_descripcion_catalogo"
                                name="edit_descripcion_catalogo" placeholder="Ingrese alguna descripción" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label>U. Medida:</label>
                            <select class="form-control" name="edit_id_unidad_medida" id="edit_id_unidad_medida"
                                required>
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
                          <select class="form-control" name="edit_id_categoria" id="edit_id_categoria" required>
                              <option value="">Seleccione una Categoría </option>
  
                              @foreach ($categoria as $cat)
                                  <option value="{{ $cat['id'] }}">
                                      {{ $cat['nombre_categoria'] }}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
                    <div class="row">
                        {{-- <div class="col">
                            <label>Estado:</label>
                            <select class="form-control" id="estado_edit" name="estado_edit" required>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>

                            </select>
                        </div> --}}
                        <input type="hidden" name="id_catalogo" id="id_catalogo">
                    </div>
                   
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-success mt-4" id="btn-editar-update"><i class="fas fa-plus-square">Actualizar</i></button>

                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-danger mt-4" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
