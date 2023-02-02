<?php
include("libs/conexion.php");
session_start();

// $_SESSION["TIPO"];
// $_SESSION["ID"];
// $_SESSION["comunidad"];

if (isset($_POST["OPC"])) {
    $o = $_POST["OPC"];
    switch ($o) {
        case "LISTADO":
            $SQL = "SELECT * FROM lugar ORDER BY Nombre ASC";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "DATOS_ACTUALIZAR":
            $ID_lugar = $_POST["ID_lugar"];

            $SQL = "SELECT * FROM lugar WHERE ID_lugar = $ID_lugar";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "ACTUALIZAR":
            $ID_lugar = $_POST["idUsuario"];
            $nombreLugar = $_POST["nombreLugar"];

            $SQL = "UPDATE lugar "
                . "SET Nombre = '$nombreLugar' "
                . "WHERE ID_lugar = $ID_lugar";
            $resultado = $mysqli->query($SQL);
            echo $resultado;
            break;

        case "INSERTAR":
            $nombreLugar = $_POST["nombreLugar"];

            $SQL = "INSERT INTO lugar (ID_lugar, Nombre) "
                . "VALUES (NULL, '$nombreLugar')";
            $resultado = $mysqli->query($SQL);
            echo $resultado;
            break;

        case "ELIMINAR":
            $ID_lugar = $_POST["ID_lugar"];

            $SQL = "DELETE FROM lugar WHERE ID_lugar = $ID_lugar";
            $resultado = $mysqli->query($SQL);
            echo $resultado;
            break;

        default:
            echo "ERROR, 13_CREAR_LUGAR.PHP";
            break;
    }
}
