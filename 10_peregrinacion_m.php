<?php
include("libs/conexion.php");
session_start();

// $_SESSION["TIPO"];
// $_SESSION["ID"];
// $_SESSION["comunidad"];

if (isset($_POST["OPC"])) {
    $o = $_POST["OPC"];
    switch ($o) {
        case "PEREGRINACIONES":
            $SQL = "SELECT * FROM peregrinacion ";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "DATOS_ACTUALIZAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            $idPere = $_POST["idPere"];

            $SQL = "SELECT * FROM peregrinacion WHERE ID_peregrinacion = $idPere";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "ACTUALIZAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            $idPere = $_POST["idPere"];
            $titulo = $_POST["titulo"];
            $detalles = $_POST["detalles"];
            $precio = $_POST["precio"];
            $fecha = $_POST["fecha"];

            $SQL = "UPDATE peregrinacion "
                . "SET ID_peregrinacion= '$idPere', Detalles = '$detalles', precio = '$precio', Titulo = '$titulo', fecha = '$fecha' "
                . "WHERE ID_peregrinacion =" . $idPere;
            $resultado = $mysqli->query($SQL);
            echo $resultado;
            break;

        case "INSERTAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            $titulo = $_POST["titulo"];
            $detalles = $_POST["detalles"];
            $precio = $_POST["precio"];
            $fecha = $_POST["fecha"];

            // INSERT EN LA TABLA EVENTO
            $SQL = "INSERT INTO peregrinacion (ID_peregrinacion, Detalles, precio, Titulo, fecha) "
                . "VALUES (NULL, '$detalles', '$precio', '$titulo', '$fecha')";
            $resultado = $mysqli->query($SQL);
            echo $resultado;
            break;

        case "ELIMINAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            $idPere = $_POST["idPere"];

            $SQL = "DELETE FROM peregrinacion WHERE ID_peregrinacion = $idPere";
            $resultado = $mysqli->query($SQL);
            echo $resultado;
            break;

        case "TIPO":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();
            else {
                echo true;
            }
            break;

        default:
            echo "ERROR 06_PALABRA_M.PHP";
            break;
    }
}
