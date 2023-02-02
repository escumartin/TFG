<div class="row justify-content-center m-1">
    <div id="mensaje" class="card-group col-sm-12 col-md-9 col-lg-6 col-xl-6 justify-content-center p-0">
        <!-- AQUI PINTO LA EUCARISTÍA -->
    </div>
</div>

<!-- AÑADIR/ACTUALIZAR EUCARISTIA -->
<div class="modal fade" id="myModal-añadirEucaristia">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="letrero" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="row justify-content-center m-2">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <div class="card p-3">
                        <form id="formEucaristia">
                            <input type="hidden" id="opcion" name="OPC" />
                            <input type="hidden" id="idEvento" name="idEvento" />
                            <input type="hidden" id="NC" name="NC" />
                            <div class="form-group">
                                <label>Fecha-Hora (INICIO)</label>
                                <div>
                                    <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fecha-Hora (FINAL)</label>
                                <div>
                                    <input type="datetime-local" class="form-control" id="fechaFinal" name="fechaFinal" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Lugar</label>
                                <div>
                                    <select class="form-control" id="lugar" name="lugar">
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Comunidad encargada</label>
                                <select class="form-control" id="comuEncargada" name="comuEncargada">
                                </select>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button id="nuevaEucaristia" type="submit" class="btn btn-primary btn-block">Añadir eucaristía</button>
                                    <button id="actualizarEucaristia" type="submit" class="btn btn-primary btn-block">Actualizar eucaristía</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-cerrar2" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
            <button id="activadorP" type="none" class="d-none" data-target="#myModal-añadirEucaristia" data-toggle="modal"></button>
        </div>
    </div>
</div>

<!-- POPUP ALERT ELIMINAR EUCARISTIA -->
<div class="modal fade" id="myModalEliminar">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¡Alerta!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="mensaje">
                <p>Vas a eliminar la eucaristia del <strong id="eliminado"></strong>, ¿Estas seguro de que deseas eliminarla?</p>
            </div>
            <div class="modal-footer">
                <button id="modalEliminar" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <button id="activador" type="hidden" class="d-none" data-target="#myModalEliminar" data-toggle="modal"></button>
</div>

<!-- POPUP AVISO FECHA EUCARISTIA -->
<div class="modal fade" id="myModalFecha">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¡Aviso!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="mensaje2"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    <button id="activador2" type="hidden" class="d-none" data-target="#myModalFecha" data-toggle="modal"></button>
</div>