<!-- Modal complementacion de entrega de producto -->
<div class="modal fade fullscreen-modal animated bounceIn" id="modal-register-responsable" data-backdrop="static"
    tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Cedula de Identidad:</label>
                                    <input type="text" value="{{ old('ci_responsable') }}"
                                        class="form-control numeroEntero" maxlength="9" required id="ci_responsable"
                                        autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nombre :</label>
                                    <input style="text-transform:uppercase;"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                                        value="{{ old('nombre') }}" class="form-control soloLetras"
                                        pattern="^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$" id="nombre" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Primer apellido :</label>
                                    <input style="text-transform:uppercase;"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                                        value="{{ old('primer_apellido') }}" class="form-control soloLetras"
                                        pattern="^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$" id="primer_apellido" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Segundo apellido :</label>
                                    <input style="text-transform:uppercase;"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                                        value="{{ old('segundo_apellido') }}" class="form-control soloLetras"
                                        pattern="^[A-ZÑa-zñáéíóúÁÉÍÓÚ'° ]+$" id="segundo_apellido" autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-6">
                              
                                <div class="form-group">
                                    <label>Fecha de nacimiento :</label>
                                    <input type="date" class="form-control" placeholder="fecha de nacimiento"
                                      id="fecha_nacimiento"
                                        value="{{ date('Y-m-d'); }}">
                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Género :</label>
                                    <select name="status" id="genero" class="form-control">
                                        <option value="MASCULINO"> Masculino</option>
                                        <option value="FEMENINO"> Femenino</option>

                                    </select>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Telefono :</label>
                                    <input type="tel" class="form-control numeroEntero" id="telefono"
                                        value="{{ old('telefono') }}" autocomplete="off" maxlength="8">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Celular :</label>
                                    <input type="text"  maxlength="8"
                                        class="form-control numeroEntero" id="celular" value="{{ old('celular') }}"
                                        autocomplete="off">
                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="form-group">
                                    <label>Estado civil:</label>
                                    <select name="status" id="estado_civil" class="form-control">
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
                                    <input type="text" class="form-control" id="email" autocomplete="off"
                                        value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Domicilio :</label>
                                    <input style="text-transform:uppercase;"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                                        value="{{ old('domicilio') }}" class="form-control" id="domicilio"
                                        autocomplete="off">
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
