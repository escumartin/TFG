<table class="table table-dark table-hover">
    <thead class="thead-light text-center">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <!-- AQUI PINTO LA TABLA -->
    <tbody id="comunidad" class="pl-2 text-center"></tbody>
</table>


<!-- AÑADIR/ACTUALIZAR LUGAR -->
<div class="modal fade" id="myModal-añadirMiembroComunidad">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="letrero" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="row justify-content-center m-2">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <div class="card p-3">

                        <form id="formLugar">
                            <input type="hidden" id="opcion" name="OPC" />
                            <input type="hidden" id="idUser" name="idUsuario" />
                            <div class="form-group">
                                <label>Lugar</label>
                                <div>
                                    <input type="text" class="form-control" id="nombreLugar" name="nombreLugar" require />
                                </div>
                            </div>
                        </form>

                        <div class="form-group">
                            <div>
                                <button id="nuevoMiembro" class="btn btn-primary btn-block" data-dismiss="modal">Añadir lugar</button>
                                <button id="actualizarMiembro" class="btn btn-primary btn-block" data-dismiss="modal">Actualizar lugar</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnCerrarPopUpMiembroComunidad" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <button id="activador2" type="none" class="d-none" data-target="#myModal-añadirMiembroComunidad" data-toggle="modal"></button>
    </div>
</div>


<!-- POPUP ALERT ELIMINAR LUGAR -->
<div class="modal fade" id="myModalEliminar">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¡Alerta!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="mensaje">
                <p>Vas a eliminar el lugar <strong id="eliminado"></strong>, ¿Estas seguro de que deseas eliminarlo?</p>
            </div>
            <div class="modal-footer">
                <button id="modalEliminar" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <button id="activador" type="hidden" class="d-none" data-target="#myModalEliminar" data-toggle="modal"></button>
</div>