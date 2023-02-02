<?php
include("libs/conexion.php");
session_start();

// $_SESSION["TIPO"];
// $_SESSION["ID"];
// $_SESSION["comunidad"];

if (isset($_POST["opcion"])) {
    $o = $_POST["opcion"];
    switch ($o) {
        case "NOTICIAS":
            // $SQL = "SELECT ID_noticia AS id, Ruta_imagen AS ruta, Titulo AS titulo, Contenido AS contenido, F_publicación AS fechaP, F_caducidad AS fechaC FROM noticia WHERE NOW() <= F_caducidad";
            $SQL = "SELECT ID_noticia AS id, Ruta_imagen AS ruta, Titulo AS titulo, Contenido AS contenido, F_publicación AS fechaP, F_caducidad AS fechaC FROM noticia";
            $resultado = $mysqli->query($SQL);
            if (!is_null($resultado)) {
                $rows = [];
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $rows[] = $row;
                }
                echo json_encode($rows);
            } else {
                echo "[($mysqli->error)]";
            }
            break;

        case "DATOS-NOTICIA":
            $idNoticia = $_POST["idNoticia"];

            $SQL = "SELECT ID_noticia AS id, Ruta_imagen AS ruta, Titulo AS titulo, Contenido AS contenido, F_publicación AS fechaP, F_caducidad AS fechaC FROM noticia WHERE ID_noticia = " . $idNoticia;
            $resultado = $mysqli->query($SQL);
            if (!is_null($resultado)) {
                echo json_encode(mysqli_fetch_assoc($resultado));
            } else {
                echo "[($mysqli->error)]";
            }
            break;

        case "ELIMINAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();
            else {
                $idNoticia = $_POST["idNoticia"];

                $SQL = "DELETE FROM noticia WHERE ID_noticia = $idNoticia";
                $resultado = $mysqli->query($SQL);
                echo $resultado;
            }
            break;

        case "ACTUALIZAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            $idNoticia = $_POST["idNoticia"];
            $imagen = $_POST["imagen"];
            $titulo = $_POST["titulo"];
            $contenido = $_POST["contenido"];
            $fpublicacion = $_POST["fpublicacion"];
            $fpublicacion = str_replace("T", " ", $fpublicacion . ":00");
            $fcaducidad = $_POST["fcaducidad"];
            $fcaducidad = str_replace("T", " ", $fcaducidad . ":00");

            $SQL = "UPDATE noticia "
                . "SET Ruta_imagen = '$imagen', Titulo = '$titulo', Contenido = '$contenido', F_publicación = '$fpublicacion', F_caducidad = '$fcaducidad' "
                . "WHERE noticia.ID_noticia =" . $idNoticia;
            $resultado = $mysqli->query($SQL);
            echo $resultado;
            break;

        case "INSERTAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            print_r($_POST);

            $imagen = $_POST["imagen"];
            $titulo = $_POST["titulo"];
            $contenido = $_POST["contenido"];
            $fpublicacion = $_POST["fpublicacion"];
            $fpublicacion = str_replace("T", " ", $fpublicacion . ":00");
            $fcaducidad = $_POST["fcaducidad"];
            $fcaducidad = str_replace("T", " ", $fpublicacion . ":00");

            $SQL = "INSERT INTO noticia (ID_noticia, Ruta_imagen, Titulo, Contenido, F_publicación, F_caducidad) "
                . "VALUES (NULL, '$imagen', '$titulo', '$contenido', '$fpublicacion', '$fcaducidad')";
            $resultado = $mysqli->query($SQL);
            // echo $resultado;
            break;

        case "ES_EDITOR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();
            else {
                echo true;
            }
            break;

        case "ES_ADMIN":
            if ($_SESSION["TIPO"] != "ADMIN")
                exit();
            else {
                echo true;
            }
            break;

        default:
            echo "ERROR, 02_noticias_m.php";
            break;
    }
}
