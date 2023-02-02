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
        case "CONVIVENCIAS":

            if (isset($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $SQL = "SELECT con.ID_convivencia, con.Detalles, con.cifra, con.Titulo, con.ID_comunidad, con.fechaIni, l.Nombre "
                . "FROM comunidad AS c, convivencia as con, evento as e, lugar as l "
                . "WHERE con.ID_comunidad = c.Nº_comunidad AND con.ID_convivencia = e.ID_evento AND con.fechaIni = e.fechaInicio AND con.fechaFin = e.fechaFinal AND con.ID_lugar = e.ID_lugar AND con.ID_lugar = l.ID_lugar AND con.ID_comunidad = $numeroComunidad "
                . "ORDER BY con.fechaIni ASC";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "COMUNIDADES":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();
            $SQL = "SELECT * FROM comunidad";
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

            $idEvento = $_POST["idEvento"];

            $SQL = "SELECT * "
                . "FROM convivencia "
                . "WHERE ID_convivencia = $idEvento ";
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
                    $SQL = "UPDATE convivencia "
                        . "SET Detalles = '$detalles', cifra = $cifra, Titulo = '$titulo', fechaIni = '$fechaInicio', fechaFin = '$fechaFinal', ID_lugar = $lugar, ID_comunidad = $numeroComunidad "
                        . "WHERE ID_convivencia = " . $idEvento;
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
                    $SQL = "INSERT INTO convivencia (ID_convivencia, Detalles, cifra, Titulo, fechaIni, fechaFin, ID_lugar, ID_comunidad) "
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
