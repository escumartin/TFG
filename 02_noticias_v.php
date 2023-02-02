<div id="mensaje"></div>
<div id="noticias" class="card-deck m-2">
    <!-- AQUI MONTO LAS NOTICIAS -->
</div>

<div class="modal fade" id="myModal-añadirNoticia">
    <div class="modal-sm modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="letrero" class="modal-title"></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="row justify-content-center m-2">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 p-0">
                    <div class="card p-3">
                        <form id="form_noticia">
                            <input type="hidden" id="opcion" name="opcion" value="" />
                            <input type="hidden" id="idNoticia" name="idNoticia" />
                            <div class="form-group">
                                <label>Ruta de la imagen</label>
                                <div>
                                    <input type="text" class="form-control" id="imagen" name="imagen" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Título (*)</label>
                                <div>
                                    <textarea type="text" class="form-control" id="titulo" name="titulo" required /></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Contenido (*)</label>
                                <div>
                                    <textarea type="text" class="form-control" rows="15" id="contenido" name="contenido" required /></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fecha de publicación (*)</label>
                                <div>
                                    <input type="datetime-local" class="form-control" id="fpublicacion" name="fpublicacion" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Fecha de caducidad (*)</label>
                                <div>
                                    <input type="datetime-local" class="form-control" id="fcaducidad" name="fcaducidad" required />
                                </div>
                            </div>
                            <div class="form-group">
                                <div>
                                    <button type="submit" id="añadirNoticia" class="btn btn-primary btn-block">Añadir noticia</button>
                                    <button type="submit" id="actualizarNoticia" class="btn btn-primary btn-block">Actualizar noticia</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="hidden" id="+" class="d-none" data-target="#myModal-añadirNoticia" data-toggle="modal"></button>
                <button id="btn-cerrar" type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- POPUP ALERT ELIMINAR NOTICIA -->
<div class="modal fade" id="myModalEliminar">
    <div class="modal-sm modal-lg modal-xl modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">¡Alerta!</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="mensaje">
                <p>Vas a eliminar la noticia <strong id="eliminado"></strong>, ¿Estas seguro de que deseas eliminarla?</p>
            </div>
            <div class="modal-footer">
                <button id="modalEliminar" type="button" class="btn btn-danger" data-dismiss="modal">Eliminar</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    <button id="activador" type="hidden" class="d-none" data-target="#myModalEliminar" data-toggle="modal"></button>
</div>

<!-- POPUP AVISO EXISTO NOTICIA -->
<div class="modal fade" id="myModalExito">
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
    <button id="activador2" type="hidden" class="d-none" data-target="#myModalExito" data-toggle="modal"></button>
</div>