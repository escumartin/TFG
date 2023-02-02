<?php
include("libs/conexion.php");
session_start();

// $_SESSION["TIPO"];
// $_SESSION["ID"];
// $_SESSION["comunidad"];

if (!isset($_POST["opcion"])) {
    echo "ERROR 'POST' not SET";
    exit();
}

$o = $_POST["opcion"];
switch ($o) {
    case 'infoPerfil':
        $SQL = 'SELECT ID_usuario, Nombre, Apellido_1, Apellido_2, Tipo, correo, Direccion, Sexo, Fijo, Movil, Nº_comunidad FROM usuario WHERE ID_usuario = ' . $_SESSION["ID"];
        $resultado = $mysqli->query($SQL);

        if (!is_null($resultado)) {
            echo json_encode(mysqli_fetch_assoc($resultado));
        } else {
            echo "[($mysqli->error)]";
        }
        break;

    case 'ACTUALIZAR':

        if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN") {
            $email = $_POST["email"];
            $direccion = $_POST["direccion"];
            $movil = $_POST["movil"];
            $SQL = 'UPDATE usuario SET correo="' . $email . '", Direccion="' . $direccion . '", Movil="' . $movil . '" WHERE ID_usuario = ' . $_SESSION["ID"];
            $resultado = $mysqli->query($SQL);
            echo $resultado;
        } else if ($_SESSION["TIPO"] == "RESPONSABLE") {
            $nombre = $_POST["nombre"];
            $apellido1 = $_POST["apellido1"];
            $apellido2 = $_POST["apellido2"];
            $email = $_POST["email"];
            $direccion = $_POST["direccion"];
            $sexo = $_POST["sexo"];
            $fijo = $_POST["fijo"];
            $movil = $_POST["movil"];

            $SQL = "UPDATE usuario "
                . "SET Nombre= '$nombre', Apellido_1 = '$apellido1', Apellido_2 = '$apellido2', Tipo = 'RESPONSABLE', correo = '$email', Direccion = '$direccion', Sexo = '$sexo', Fijo = '$fijo', Movil = '$movil' "
                . "WHERE ID_usuario = " . $_SESSION["ID"];
            $resultado = $mysqli->query($SQL);
            echo $resultado;

        } else if ($_SESSION["TIPO"] == "ADMIN") {
            $nombre = $_POST["nombre"];
            $apellido1 = $_POST["apellido1"];
            $apellido2 = $_POST["apellido2"];
            $email = $_POST["email"];
            $direccion = $_POST["direccion"];
            $sexo = $_POST["sexo"];
            $fijo = $_POST["fijo"];
            $movil = $_POST["movil"];

            $SQL = "UPDATE usuario "
                . "SET Nombre= '$nombre', Apellido_1 = '$apellido1', Apellido_2 = '$apellido2', Tipo = 'ADMIN', correo = '$email', Direccion = '$direccion', Sexo = '$sexo', Fijo = '$fijo', Movil = '$movil' "
                . "WHERE ID_usuario = " . $_SESSION["ID"];
            $resultado = $mysqli->query($SQL);
            echo $resultado;
        }
        break;

    default:
        echo "ERROR, 04_PERFIL_M.PHP";
        break;
}
