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
        case "PASOS":

            if (isset($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $SQL = "SELECT pas.ID_paso, pas.Detalles, pas.cifra, pas.Titulo, pas.ID_comunidad, pas.fechaIni, l.Nombre "
                . "FROM comunidad AS c, paso as pas, evento as e, lugar as l "
                . "WHERE pas.ID_comunidad = c.Nº_comunidad AND pas.ID_paso = e.ID_evento AND pas.fechaIni = e.fechaInicio AND pas.fechaFin = e.fechaFinal AND pas.ID_lugar = e.ID_lugar AND pas.ID_lugar = l.ID_lugar  AND pas.ID_comunidad = $numeroComunidad "
                . "ORDER BY pas.fechaIni ASC";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "LUGARES":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();
            $SQL = "SELECT * FROM lugar";
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

            $idEvento = $_POST["idEvento"];

            $SQL = "SELECT * "
                . "FROM paso "
                . "WHERE ID_paso = $idEvento ";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "ACTUALIZAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            if (strlen($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $idEvento = $_POST["idEvento"];
            $fechaInicio = $_POST["fechaInicio"];
            $fechaFinal = $_POST["fechaFinal"];
            $lugar = $_POST["lugarE"];
            $titulo = $_POST["titulo"];
            $detalles = $_POST["detalles"];
            $cifra = $_POST["cifra"];

            // COMPROBAR QUE EN ESE LUGAR Y EN ESA FECHA-HORA EL SALON NO ESTA OCUPADO
            $SQL = "SELECT * FROM evento WHERE ID_lugar = $lugar AND ID_evento <> $idEvento AND ("
                . "('$fechaInicio' BETWEEN fechaInicio AND fechaFinal) OR ('$fechaFinal' BETWEEN fechaInicio AND fechaFinal) OR "
                . "(fechaInicio BETWEEN '$fechaInicio' AND '$fechaFinal') OR (fechaFinal BETWEEN '$fechaInicio' AND '$fechaFinal') )";
            $registros = MYSQL_GET_NUM($mysqli, $SQL);  // ME DEVUELVE EL NUMERO DE REGISTROS DEL SELECT

            if ($registros > 0) {
                echo false;
            } else {
                // UPDATE EN LA TABLA EVENTO
                $SQL = "UPDATE evento "
                    . "SET ID_lugar= $lugar, fechaInicio = '$fechaInicio', fechaFinal = '$fechaFinal' "
                    . "WHERE ID_evento =" . $idEvento;
                $resultado = $mysqli->query($SQL);

                // UPDATE EN LA TABLA CONVIVENCIA
                if ($resultado) {
                    $SQL = "UPDATE paso "
                        . "SET Detalles = '$detalles', cifra = $cifra, Titulo = '$titulo', fechaIni = '$fechaInicio', fechaFin = '$fechaFinal', ID_lugar = $lugar, ID_comunidad = $numeroComunidad "
                        . "WHERE ID_paso = " . $idEvento;
                    $resultado = $mysqli->query($SQL);
                    echo $resultado;
                } else {
                    echo "ERROR, en la insercción convivencia\n\n $resultado";
                }
            }
            break;

        case "INSERTAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            if (strlen($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $fechaInicio = $_POST["fechaInicio"];
            $fechaFinal = $_POST["fechaFinal"];
            $lugar = $_POST["lugarE"];
            $titulo = $_POST["titulo"];
            $detalles = $_POST["detalles"];
            $cifra = $_POST["cifra"];

            // COMPROBAR QUE EN ESE LUGAR Y EN ESA FECHA-HORA EL SALON NO ESTA OCUPADO
            $SQL = "SELECT * FROM evento WHERE ID_lugar = $lugar AND ("
                . "('$fechaInicio' BETWEEN fechaInicio AND fechaFinal) OR ('$fechaFinal' BETWEEN fechaInicio AND fechaFinal) OR "
                . "(fechaInicio BETWEEN '$fechaInicio' AND '$fechaFinal') OR (fechaFinal BETWEEN '$fechaInicio' AND '$fechaFinal') )";
            $registros = MYSQL_GET_NUM($mysqli, $SQL);  // ME DEVUELVE EL NUMERO DE REGISTROS DEL SELECT

            if ($registros > 0) {
                echo false;
            } else {
                // INSERT EN LA TABLA EVENTO
                $SQL = "INSERT INTO evento (ID_evento, fechaInicio, ID_lugar, fechaFinal) "
                    . "VALUES (NULL, '$fechaInicio', '$lugar', '$fechaFinal')";
                $resultado = $mysqli->query($SQL);
                $idEvento = $mysqli->insert_id;       // ME DEVUELVE EL ID AUTOINCREMENT RECIEN INSERTADO

                // INSERT EN LA TABLA PALABRA
                if ($resultado) {
                    $SQL = "INSERT INTO paso (ID_paso, Detalles, cifra, Titulo, fechaIni, fechaFin, ID_lugar, ID_comunidad) "
                        . "VALUES ('$idEvento', '$detalles', $cifra, '$titulo', '$fechaInicio', '$fechaFinal', '$lugar', $numeroComunidad)";
                    $resultado = $mysqli->query($SQL);
                    echo $resultado;
                } else {
                    echo "ERROR, en la insercción palabra\n\n $resultado";
                }
            }
            break;

        case "ELIMINAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            $idEvento = $_POST["idEvento"];

            $SQL = "DELETE FROM evento WHERE ID_evento = $idEvento";
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
            echo "ERROR 08_CONVIVENCIAS.PHP";
            break;
    }
}
