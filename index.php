<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <title>San Bartolome</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" href="img/favicon.png">

    <!-- JavaScript -->
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

    <!-- libs -->
    <script src="libs/utils.js"></script>

    <!-- Mi CSS + iconos  google -->
    <link rel="stylesheet" type="text/css" href="css/miCSS.css" />
    <link href="css/google.css" type="text/css" rel="stylesheet">

    <script>
        function Inicio() {
            GetModule("01_menu", "menu");
            GetModule("02_noticias", "main");
        }

        var strGrupos = "";
        var NC = "";
    </script>
</head>

<body onload="Inicio()">
    <main id="main" class="position-absolute mt-5 pt-2 w-100 align-content-center"></main>
    <nav class="navbar navbar-dark-lg navbar-dark bg-dark position-fixed w-100" id="menu"></nav>

    <!-- JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-3.3.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
 
</body>

</html>