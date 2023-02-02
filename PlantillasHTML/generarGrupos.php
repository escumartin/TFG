<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/iconos.css" />

    <title>San Bartolome</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="login.php">Generar grupos</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Iniciar sesion <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="noticias.php">Noticias <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="listadoComunidades.php">Comunidades <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="palabras.php">Palabras <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="eucaristias.php">Eucaristías <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="convivencias.php">Convivencias <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="pasos.php">Pasos <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="peregrinaciones.php">Peregrinaciones <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="sacerdotes.php">Sacerdotes <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="generarGrupos.php">Generar grupos <span
                            class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <article>
        <div class="row m-0">
            <div class="col-sm-9 col-md-7 col-lg-4 mx-auto">
                <div class="card card-signin my-3">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nº comunidad</label>
                                <input type="text" class="form-control" id="N_comunidad" disabled />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Nº grupos</label>
                                <input type="number" class="form-control" id="N_grupos" min="0" max="20" />
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Hermanos/grupo</label>
                                <input type="number" class="form-control" id="H_por_G" min="0" max="20" />
                            </div>
                            <button class="btn btn-primary btn-block" type="submit">
                                Generar grupos
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <!-- JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
</body>

</html>