<table class="table table-dark table-hover">
    <thead class="thead-light text-center">
        <tr>
            <th scope="col">Comunidad</th>
            <th scope="col">Hermanos</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <!-- AQUI PINTO LA TABLA -->
    <tbody id="comunidad" class="pl-2 text-center"></tbody>
</table>

<!-- POPUP DETALLES USUARIO -->
<div class="modal fade" id="myModal">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Responsable</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="mensaje">
                <table class="w-100">
                    <tbody class="text-dark">
                        <tr>
                            <td class="text-right p-0"><strong>ID_usuario:</strong></td>
                            <td id="idUsuario" class="text-left p-1"></td>
                        </tr>
                        <tr>
                            <td class="text-right p-0"><strong>Nombre:</strong></td>
                            <td id="nombre" class="text-left p-1"></td>
                        </tr>
                        <tr>
                            <td class="text-right p-0"><strong>Apellido 1:</strong></td>
                            <td id="apellido1" class="text-left p-1"></td>
                        </tr>
                        <tr>
                            <td class="text-right p-0"><strong>Apellido 2:</strong></td>
                            <td id="apellido2" class="text-left p-1"></td>
                        </tr>
                        <tr>
                            <td class="text-right p-0"><strong>E-mail:</strong></td>
                            <td id="email" class="text-left p-1"></td>
                        </tr>
                        <tr>
                            <td class="text-right p-0"><strong>Dirección:</strong></td>
                            <td id="calle" class="text-left p-1"></td>
                        </tr>
                        <tr>
                            <td class="text-right p-0"><strong>Sexo:</strong></td>
                            <td id="sexo" class="text-left p-1"></td>
                        </tr>
                        <tr>
                            <td class="text-right p-0"><strong>Fijo:</strong></td>
                            <td id="fijo" class="text-left p-1"></td>
                        </tr>
                        <tr>
                            <td class="text-right p-0"><strong>Móvil:</strong></td>
                            <td id="movil" class="text-left p-1"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button id="btn-cerrar" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button id="activador3" type="none" class="d-none" data-target="#myModal" data-toggle="modal"></button>
            </div>
        </div>
    </div>
</div>



<!-- AÑADIR/ACTUALIZAR COMUNIDAD -->
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

                        <form id="formComunidades">
                            <input type="hidden" id="opcion" name="OPC" />
                            <input type="hidden" id="idUser" name="idUsuario" />
                            <div class="form-group">
                                <label>Número comunidad</label>
                                <div>
                                    <input type="number" class="form-control" id="nComunidad" name="nComunidad" max="30" min="1" require>
                                </div>
                            </div>
                        </form>

                        <div class="form-group">
                            <div>
                                <button id="nuevoMiembro" class="btn btn-primary btn-block" data-dismiss="modal">Añadir comunidad</button>
                                <button id="actualizarMiembro" class="btn btn-primary btn-block" data-dismiss="modal">Actualizar comunidad</button>
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


<!-- POPUP ALERT ELIMINAR MIEMBRO COMUNIDAD -->
<div class="modal fade" id="myModalEliminar">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¡Alerta!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="mensaje">
                <p>Vas a eliminar la comunidad <strong id="eliminado"></strong>, ¿Estas seguro de que deseas eliminarla?</p>
            </div>
            <div class="modal-footer">
                <button id="modalEliminar" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <button id="activador" type="hidden" class="d-none" data-target="#myModalEliminar" data-toggle="modal"></button>
</div>