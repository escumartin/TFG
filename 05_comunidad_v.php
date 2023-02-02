<table class="table table-dark table-hover">
    <thead class="thead-light text-center">
        <tr>
            <th scope="col">Nombre</th>
            <th scope="col">Teléfono</th>
            <th scope="col"></th>
        </tr>
    </thead>
    <!-- AQUI PINTO LA TABLA -->
    <tbody id="comunidad" class="pl-2"></tbody>
</table>



<!-- POPUP DETALLES USUARIO -->
<div class="modal fade" id="myModal">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detalles</h4>
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
            </div>
        </div>
    </div>
</div>

<!-- AÑADIR/ACTUALIZAR MIEMBRO COMUNIDAD -->
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
                        <form id="miembroComunidad">
                            <input type="hidden" id="opcion" name="OPC" />
                            <input type="hidden" id="idUser" name="idUsuario" />
                            <input type="hidden" id="NC" name="NC" />
                            <div class="form-group">
                                <label>Nombre</label>
                                <div>
                                    <input type="text" class="form-control" id="nombreE" name="nombre" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Apellido 1</label>
                                <div>
                                    <input type="text" class="form-control" id="apellido1E" name="apellido1" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Apellido 2</label>
                                <div>
                                    <input type="text" class="form-control" id="apellido2E" name="apellido2" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tipo usuario</label>
                                <select class="form-control" id="tipoE" name="tipo" required>
                                    <option value="REGISTRADO">Registrado</option>
                                    <option value="RESPONSABLE">Responsable</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>E-mail</label>
                                <div>
                                    <input type="email" class="form-control" id="emailE" name="email" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Dirección</label>
                                <div>
                                    <input type="text" class="form-control" id="direccionE" name="direccion" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sexo</label>
                                <select class="form-control" id="sexoE" name="sexo" required>
                                    <option value="H">Hombre</option>
                                    <option value="M">Mujer</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Teléfono fijo</label>
                                <div>
                                    <input type="tel" pattern="[0-9]{9}" maxlength="9" class="form-control" id="fijoE" name="fijo" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Móvil</label>
                                <div>
                                    <input type="tel" class="form-control" pattern="[0-9]{9}" maxlength="9" id="movilE" name="movil" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Contraseña</label>
                                <div>
                                    <input type="text" class="form-control" id="contraseña" name="contraseña" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button id="nuevoMiembro" type="submit" class="btn btn-primary btn-block">Añadir miembro</button>
                                    <button id="actualizarMiembro" type="submit" class="btn btn-primary btn-block">Actualizar miembro</button>
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
                <p>Vas a eliminar a <strong id="eliminado"></strong>, ¿Estas seguro de que deseas eliminar a este miembro?</p>
            </div>
            <div class="modal-footer">
                <button id="modalEliminar" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <button id="activador" type="hidden" class="d-none" data-target="#myModalEliminar" data-toggle="modal"></button>
</div>