<div class="row justify-content-center m-2">
    <div class="col-sm-12 col-md-9 col-lg-6 col-xl-4 p-0">
        <div class="card p-3">
            <form id="perfilUsuario">
                <input type="hidden" id="opcion" name="opcion" />
                <div class="form-group">
                    <label>Nombre (*)</label>
                    <div>
                        <input type="text" class="form-control" id="nombre" name="nombre" disabled="disabled" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Apellido 1 (*)</label>
                    <div>
                        <input type="text" class="form-control" id="apellido1" name="apellido1" disabled="disabled" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Apellido 2 (*)</label>
                    <div>
                        <input type="text" class="form-control" id="apellido2" name="apellido2" disabled="disabled" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>E-mail (*)</label>
                    <div>
                        <input type="email" class="form-control" id="email" name="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Dirección (*)</label>
                    <div>
                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Sexo (*)</label>
                    <select class="form-control" id="sexo" name="sexo" disabled="disabled" required>
                        <option value="H">Hombre</option>
                        <option value="M">Mujer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Teléfono fijo (*)</label>
                    <div>
                        <input type="tel" pattern="[0-9]{9}" class="form-control" id="fijo" maxlength="9" minlength="9" name="fijo" disabled="disabled" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Móvil (*)</label>
                    <div>
                        <input type="tel" class="form-control" pattern="[0-9]{9}" maxlength="9" minlength="9" id="movil" name="movil" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nº comunidad (*)</label>
                    <div>
                        <input type="number" class="form-control" id="comunidad" disabled="disabled" required>
                    </div>
                </div>
                <div class="form-group">
                    <div>
                        <button id="guardar" type="submit" class="btn btn-primary btn-block" data-toggle="modal" data-target="#myModal">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="myModalCheck">
    <div class="modal-sm modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¡Aviso!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="mensaje"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
    <button id="activador" type="hidden" data-target="#myModalCheck" data-toggle="modal"></button>
</div>