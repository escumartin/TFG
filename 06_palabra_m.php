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
        case "PALABRAS":

            if (isset($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $SQL = "SELECT p.ID_palabra, p.Detalles, p.Titulo, p.ID_comunidad, p.fechaIni, l.Nombre, p.fechaFin "
                . "FROM comunidad AS c, palabra as p, evento as e, lugar as l "
                . "WHERE p.ID_comunidad = c.Nº_comunidad AND p.ID_palabra = e.ID_evento AND p.fechaIni = e.fechaInicio AND p.fechaFin = e.fechaFinal AND p.ID_lugar = e.ID_lugar AND p.ID_lugar = l.ID_lugar AND p.ID_comunidad = $numeroComunidad "
                . "ORDER BY p.fechaIni ASC";
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
                . "FROM palabra "
                . "WHERE ID_palabra = $idEvento ";
            echo get_Data_SQL($SQL, array(), $mysqli);
            break;

        case "ACTUALIZAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            if (strlen($_POST["NC"]) > 1) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $idEvento = $_POST["idEvento"];
            $fechaInicio = $_POST["fechaInicio"];
            $fechaFinal = $_POST["fechaFinal"];
            $lugar = $_POST["lugar"];
            $tituloP = $_POST["tituloP"];
            $detallesP = $_POST["detallesP"];

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

                // UPDATE EN LA TABLA PALABRA
                if ($resultado) {
                    $SQL = "UPDATE palabra "
                        . "SET Detalles = '$detallesP', Titulo = '$tituloP', fechaIni = '$fechaInicio', fechaFin = '$fechaFinal', ID_lugar = $lugar, ID_comunidad = $numeroComunidad "
                        . "WHERE ID_palabra = " . $idEvento;
                    $resultado = $mysqli->query($SQL);
                    echo $resultado;
                } else {
                    echo "ERROR, en la insercción palabra\n\n $resultado";
                }
            }
            break;

        case "INSERTAR":
            if ($_SESSION["TIPO"] != "RESPONSABLE" && $_SESSION["TIPO"] != "ADMIN")
                exit();

            if (strlen($_POST["NC"]) > 0) {
                $numeroComunidad = $_POST["NC"];
                // echo "NC no esta vacío '$numeroComunidad'";
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
                // echo "NC está vacio '$numeroComunidad'";
            }

            $fechaInicio = $_POST["fechaInicio"];
            $fechaFinal = $_POST["fechaFinal"];
            $lugar = $_POST["lugar"];
            $tituloP = $_POST["tituloP"];
            $detallesP = $_POST["detallesP"];

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
                    $SQL = "INSERT INTO palabra (ID_palabra, Detalles, Titulo, ID_comunidad, fechaIni, fechaFin, ID_lugar) "
                        . "VALUES ('$idEvento', '$detallesP', '$tituloP', $numeroComunidad, '$fechaInicio', '$fechaFinal', '$lugar')";
                    $resultado = $mysqli->query($SQL);
                    echo $resultado;
                    // echo $SQL;
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
            echo "ERROR 06_PALABRA_M.PHP";
            break;
    }
}
