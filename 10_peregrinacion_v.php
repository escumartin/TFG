<div class="row justify-content-center m-1">
    <div id="mensaje" class="card-group col-sm-12 col-md-9 col-lg-6 col-xl-6 justify-content-center p-0">
        <!-- AQUI MUESTRO LA PEREGRINACIÓN -->
    </div>
</div>

<!-- AÑADIR/ACTUALIZAR PEREGRINACIÓN -->
<div class="modal fade" id="myModal-añadirPeregrinacion">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="letrero" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="row justify-content-center m-2">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <div class="card p-3">

                        <form id="formPeregrinacion">
                            <input type="hidden" id="opcion" name="OPC" />
                            <input type="hidden" id="idPere" name="idPere" />
                            <div class="form-group">
                                <label>Título</label>
                                <div>
                                    <input type="text" class="form-control" id="titulo" name="titulo" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Detalles</label>
                                <div>
                                    <textarea class="form-control" rows="15" id="detalles" name="detalles" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Precio</label>
                                <div>
                                    <input type="number" class="form-control" id="precio" name="precio" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fecha-Hora</label>
                                <div>
                                    <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button id="nuevaPere" type="submit" class="btn btn-primary btn-block">Añadir peregrinación</button>
                                    <button id="actualizarPere" type="submit" class="btn btn-primary btn-block">Actualizar peregrinación</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn-cerrar2" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <button id="activador2" type="none" class="d-none" data-target="#myModal-añadirPeregrinacion" data-toggle="modal"></button>
    </div>
</div>



<!-- POPUP ALERT ELIMINAR MIEMBRO COMUNIDAD -->
<div class="modal fade" id="myModalEliminar">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¡Alerta!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="mensaje">
                <p>Vas a eliminar la peregrinación de <strong id="eliminado"></strong>, ¿Estas seguro de que deseas eliminarla?</p>
            </div>
            <div class="modal-footer">
                <button id="modalEliminar" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <button id="activador" type="hidden" class="d-none" data-target="#myModalEliminar" data-toggle="modal"></button>
</div>

