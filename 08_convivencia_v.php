<div class="row justify-content-center m-1">
    <div id="mensaje" class="card-group col-sm-12 col-md-9 col-lg-6 col-xl-6 justify-content-center p-0">
        <!-- AQUI PINTO LAS CONVIVENCIAS -->
    </div>
</div>

<!-- AÑADIR/ACTUALIZAR CONVIVENCIA -->
<div class="modal fade" id="myModal-añadirConvivencia">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="letrero" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="row justify-content-center m-2">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <div class="card p-3">
                        <form id="formConvivencia">
                            <input type="hidden" id="opcion" name="OPC" />
                            <input type="hidden" id="idEvento" name="idEvento" />
                            <input type="hidden" id="NC" name="NC" />
                            <!-- DATOS PARA LA TABLA EVENTO -->
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
                                    <select class="form-control" id="lugarE" name="lugarE"></select>
                                </div>
                            </div>
                            <!-- DATOS PARA LA TABLA PARTICULAR DEL EVENTO -->
                            <div class="form-group">
                                <label>Título</label>
                                <div>
                                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Detalles</label>
                                <div>
                                    <textarea class="form-control" id="detalles" name="detalles" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Cifra</label>
                                <input type="number" class="form-control" id="cifra" name="cifra" required />
                            </div>
                            <div class="form-group">
                                <div>
                                    <button id="nuevaConvivencia" type="submit" class="btn btn-primary btn-block">Añadir convivencia</button>
                                    <button id="actualizarConvivencia" type="submit" class="btn btn-primary btn-block">Actualizar convivencia</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-cerrar2" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
            <button id="activadorP" type="none" class="d-none" data-target="#myModal-añadirConvivencia" data-toggle="modal"></button>
        </div>
    </div>
</div>

<!-- POPUP ALERT ELIMINAR CONVIVENCIA -->
<div class="modal fade" id="myModalEliminar">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¡Alerta!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="mensaje">
                <p>Vas a eliminar la convivencia del <strong id="eliminado"></strong>, ¿Estas seguro de que deseas eliminarla?</p>
            </div>
            <div class="modal-footer">
                <button id="modalEliminar" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <button id="activador" type="hidden" class="d-none" data-target="#myModalEliminar" data-toggle="modal"></button>
</div>

<!-- POPUP AVISO SALON OCUPADO -->
<div class="modal fade" id="myModalOcupado">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¡Aviso!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="mensaje">
                <p>El lugar y/o la hora ya están ocupados, por favor selecione otro lugar u hora.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    <button id="activadorOcupado" type="hidden" class="d-none" data-target="#myModalOcupado" data-toggle="modal"></button>
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