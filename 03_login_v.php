<article class="text-center">
    <picture>
        <source media="(min-width: 1000px)" srcset="img/sb-grande.png" />
        <source media="(min-width: 700px)" srcset="img/sb-mediana.png" />
        <source media="(min-width: 600px)" srcset="img/sb-pequeña.png" />
        <img src="img/sb-pqueña.png" alt="imagen_parroquia" />
    </picture>

    <div class="row m-0">
        <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
            <div id="mensaje" class="text-left my-5"></div>
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Iniciar sesión</h5>
                    <form id="formLogin" class="form-signin">
                        <div class="form-label-group">
                            <input type="text" id="usuario" class="form-control" placeholder="ID (*)" name="usuario" required />
                            <p></p>
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="inputPassword" class="form-control" name="pass" placeholder="Contraseña (*)" required />
                            <p></p>
                        </div>

                        <div class="custom-control custom-checkbox mb-3">
                            <input type="checkbox" class="custom-control-input" id="customCheck1" />
                            <label class="custom-control-label" for="customCheck1">Recordar contraseña</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Iniciar sesion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>