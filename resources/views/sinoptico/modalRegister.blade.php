<!-- Modal complementacion de entrega de producto -->
<div class="modal fade fullscreen-modal animated bounceIn" id="modal_add_sinoptico" data-backdrop="static" tabindex="-1"
    role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" style="text-align: center">{{ $title_modal }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-12">


                                <div class="col-12">
                                    <label>Tipo:</label>

                                    <select class="form-control " name="estacion_terminal" id="estacion_terminal" required>
                                        @foreach ($estacion_terminal as $estacion)
                                            <option value="{{ $estacion['id'] }}">
                                                {{ $estacion['estacion_terminal'] }}</option>
                                        @endforeach
                                    </select>

                                   
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Fecha de Registro:</label>
                                        <input name="fecha_registro" type="text" class="form-control"
                                            id="fecha_registro" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Mensaje:</label>
                                        <textarea style="text-transform:uppercase;" class="form-control" autocomplete="off" name="mensaje" id="mensaje"
                                            cols="30" rows="5" onkeyup="javascript:this.value=this.value.toUpperCase();"></textarea>

                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12" style="text-align: center">
                                <button type="button" id="{{ $id_button }}"
                                    class="btn btn-success">{{ $title_buton }}</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            </div>

                        </div>
                    </div>


                </div>
                {{-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" id="btn-complementacion-producto">Guardar</button>
        </div> --}}
            </div>
        </div>
    </div>
