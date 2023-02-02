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

    <title>San Bartolome</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="login.php">Iniciar sesion</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="login.php">Iniciar sesion <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="noticias.php">Noticias <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <article class="text-center">
        <picture>
            <source media="(min-width: 1000px)" srcset="img/sb-grande.png" />
            <source media="(min-width: 700px)" srcset="img/sb-mediana.png" />
            <source media="(min-width: 600px)" srcset="img/sb-pequeña.png" />
            <img src="img/sb-pqueña.png" alt="imagen_parroquia" />
        </picture>

        <div class="row m-0">
            <div class="col-sm-9 col-md-7 col-lg-4 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Iniciar sesion</h5>
                        <form class="form-signin">
                            <div class="form-label-group">
                                <input type="text" id="inputEmail" class="form-control" placeholder="Usuario" required
                                    autofocus />
                                <p></p>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña"
                                    required />
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

    <!-- JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
</body>

</html>