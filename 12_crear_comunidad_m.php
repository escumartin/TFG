<?php
include("libs/conexion.php");
session_start();

// $_SESSION["TIPO"];
// $_SESSION["ID"];
// $_SESSION["comunidad"];

if (isset($_POST["OPC"])) {
    $o = $_POST["OPC"];
    switch ($o) {
        case "LISTADO_COMUNIDADES":
            // $SQL = "SELECT Nº_comunidad, COUNT(Nº_comunidad) FROM usuario GROUP BY Nº_comunidad ORDER BY Nº_comunidad ASC";
            $SQL = "SELECT c.Nº_comunidad, COUNT(c.Nº_comunidad) FROM usuario as u, comunidad as c WHERE u.Nº_comunidad = c.Nº_comunidad GROUP BY c.Nº_comunidad ORDER BY c.Nº_comunidad ASC";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "CONTAR_RESPONSABLES":
            $comunidad = $_POST["comunidad"];

            $SQL = "SELECT ID_usuario, Nombre, Apellido_1, Apellido_2, Tipo, correo, Direccion, Sexo, Fijo, Movil, Nº_comunidad FROM usuario WHERE Tipo = 'RESPONSABLE' AND Nº_comunidad = $comunidad ORDER BY Nº_comunidad ASC";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "DATOS_ACTUALIZAR":
            $ID_comunidad = $_POST["ID_comunidad"];
            $SQL = "SELECT Nº_comunidad FROM comunidad WHERE Nº_comunidad = $ID_comunidad";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "ACTUALIZAR":
            $ID_comunidad = $_POST["nComunidad"];
            $idUsuario = $_POST["idUsuario"];

            $SQL = "UPDATE comunidad "
                . "SET Nº_comunidad = $ID_comunidad "
                . "WHERE Nº_comunidad = $idUsuario";
            $resultado = $mysqli->query($SQL);
            echo $resultado;
            break;

        case "INSERTAR":
            $nComunidad = $_POST["nComunidad"];

            $SQL = "INSERT INTO comunidad (Nº_comunidad) "
                . "VALUES ($nComunidad)";
            $resultado = $mysqli->query($SQL);

            $SQL = "INSERT INTO usuario (ID_usuario, Nombre, Apellido_1, Apellido_2, Tipo, correo, Direccion, Sexo, Fijo, Movil, pass, Nº_comunidad) "
                . "VALUES (NULL, 'user1', 'user1', 'user1', 'REGISTRADO', 'user1@gmail.com', 'user1', 'H', '999999999', '666666666', PASSWORD('123'), '$nComunidad')";
            $resultado = $mysqli->query($SQL);
            echo $resultado;
            break;

        case "ELIMINAR":
            $nComunidad = $_POST["idComunidad"];

            $SQL = "DELETE FROM comunidad WHERE Nº_comunidad = $nComunidad";
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
