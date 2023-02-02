<?php
include("libs/conexion.php");
session_start();

// $_SESSION["TIPO"];
// $_SESSION["ID"];
// $_SESSION["comunidad"];

$numeroComunidad = "";

if (isset($_POST["OPC"])) {
    $o = $_POST["OPC"];
    switch ($o) {
        case "LISTADO_COMUNIDAD":

            if (isset($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $SQL = "SELECT ID_usuario, Nombre, Apellido_1, Apellido_2, Tipo, correo, Direccion, Sexo, Fijo, Movil, Nº_comunidad FROM usuario WHERE Nº_comunidad = $numeroComunidad ORDER BY Nombre ASC";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "DATOS_ACTUALIZAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            if (isset($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $idMiembro = $_POST["idUsuario"];
            $SQL = "SELECT ID_usuario, Nombre, Apellido_1, Apellido_2, Tipo, correo, Direccion, Sexo, Fijo, Movil FROM usuario WHERE ID_usuario = $idMiembro";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "ACTUALIZAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            if (isset($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $idMiembro = $_POST["idUsuario"];
            $nombre = $_POST["nombre"];
            $apellido1 = $_POST["apellido1"];
            $apellido2 = $_POST["apellido2"];
            $tipo = $_POST["tipo"];
            $email = $_POST["email"];
            $direccion = $_POST["direccion"];
            $sexo = $_POST["sexo"];
            $fijo = $_POST["fijo"];
            $movil = $_POST["movil"];
            $contraseña = $_POST["contraseña"];

            if (is_null($contraseña) || empty($contraseña)) {
                $SQL = "UPDATE usuario "
                    . "SET Nombre= '$nombre', Apellido_1 = '$apellido1', Apellido_2 = '$apellido2', Tipo = '$tipo', correo = '$email', Direccion = '$direccion', Sexo = '$sexo', Fijo = '$fijo', Movil = '$movil' "
                    . "WHERE ID_usuario =" . $idMiembro;
                $resultado = $mysqli->query($SQL);
                echo $resultado;
            } else {
                $SQL = "UPDATE usuario "
                    . "SET Nombre= '$nombre', Apellido_1 = '$apellido1', Apellido_2 = '$apellido2', Tipo = '$tipo', correo = '$email', Direccion = '$direccion', Sexo = '$sexo', Fijo = '$fijo', Movil = '$movil', pass = PASSWORD('$contraseña') "
                    . "WHERE ID_usuario =" . $idMiembro;
                $resultado = $mysqli->query($SQL);
                echo $resultado;
            }
            break;

        case "INSERTAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();
                
            if (!empty($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $nombre = $_POST["nombre"];
            $apellido1 = $_POST["apellido1"];
            $apellido2 = $_POST["apellido2"];
            $tipo = $_POST["tipo"];
            $email = $_POST["email"];
            $direccion = $_POST["direccion"];
            $sexo = $_POST["sexo"];
            $fijo = $_POST["fijo"];
            $movil = $_POST["movil"];
            $contraseña = $_POST["contraseña"];

            $SQL = "INSERT INTO usuario (ID_usuario, Nombre, Apellido_1, Apellido_2, Tipo, correo, Direccion, Sexo, Fijo, Movil, pass, Nº_comunidad) "
                . "VALUES (NULL, '$nombre', '$apellido1', '$apellido2', '$tipo', '$email', '$direccion', '$sexo', '$fijo', '$movil', PASSWORD('$contraseña'), '$numeroComunidad')";
            $resultado = $mysqli->query($SQL);
            echo $resultado;
            break;

        case "ELIMINAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            // NO SE PUEDE BORRAR NI 'RESPONSABLE' NI 'ADMIN'
            $idMiembro = $_POST["idMiembro"];
            if ($idMiembro == $_SESSION["ID"]) {
                echo false;
            }

            $SQL = "DELETE FROM usuario WHERE ID_usuario = $idMiembro";
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

        case "ADMIN":
            if ($_SESSION["TIPO"] != "ADMIN")
                exit();
            else {
                echo true;
            }
            break;

        default:
            echo "ERROR 05_COMUNIDAD_M.PHP";
            break;
    }
}
