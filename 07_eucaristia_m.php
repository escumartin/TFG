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
        case "EUCARISTIAS":

            if (isset($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $SQL = "SELECT e.ID_eucaristia, e.fechaIni, e.Comunidad_encargada, l.Nombre "
                . "FROM eucaristia_comunidad as ec, eucaristia as e, lugar as l "
                . "WHERE e.ID_eucaristia = ec.ID_evento and l.ID_lugar = e.ID_lugar AND ec.ID_comunidad = $numeroComunidad "
                . "ORDER by e.fechaIni ASC";
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

            if (isset($_POST["NC"])) {
                $numeroComunidad = $_POST["NC"];
            } else {
                $numeroComunidad = $_SESSION["comunidad"];
            }

            $idEvento = $_POST["idEvento"];

            $SQL = "SELECT e.fechaIni, e.fechaFin, e.Comunidad_encargada, l.ID_lugar "
                . "FROM eucaristia_comunidad as ec, eucaristia as e, lugar as l "
                . "WHERE e.ID_eucaristia = $idEvento and l.ID_lugar = e.ID_lugar AND ec.ID_comunidad = $numeroComunidad "
                . "ORDER by e.fechaIni ASC";
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
            $lugar = $_POST["lugar"];
            $comuEncargada = $_POST["comuEncargada"];

            // UPDATE EN LA TABLA EVENTO
            $SQL = "UPDATE evento "
                . "SET ID_lugar= $lugar, fechaInicio = '$fechaInicio', fechaFinal = '$fechaFinal' "
                . "WHERE ID_evento =" . $idEvento;
            $resultado = $mysqli->query($SQL);

            // UPDATE EN LA TABLA EUCARISTÍA
            if ($resultado) {
                $SQL = "UPDATE eucaristia "
                    . "SET fechaIni= '$fechaInicio', fechaFin = '$fechaFinal', ID_lugar = $lugar, Comunidad_encargada = '$comuEncargada' "
                    . "WHERE ID_eucaristia =" . $idEvento;
                $resultado = $mysqli->query($SQL);

                // UPDATE EN LA TABLA EUCARISTIA_COMUNIDAD
                if ($resultado) {
                    $SQL = "UPDATE eucaristia_comunidad "
                        . "SET Fecha_Ini= '$fechaInicio', Fecha_Fin = '$fechaFinal', ID_lugar = $lugar, ID_comunidad = '$numeroComunidad' "
                        . "WHERE ID_evento = $idEvento";
                    $resultado = $mysqli->query($SQL);
                    echo $resultado;
                } else {
                    echo false;
                }
            } else {
                echo false;
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
            $lugar = $_POST["lugar"];
            $comuEncargada = $_POST["comuEncargada"];

            // INSERT EN LA TABLA EVENTO
            $SQL = "INSERT INTO evento (ID_evento, fechaInicio, ID_lugar, fechaFinal) "
                . "VALUES (NULL, '$fechaInicio', '$lugar', '$fechaFinal')";
            $resultado = $mysqli->query($SQL);
            $idEvento = $mysqli->insert_id;       // ME DEVUELVE EL ID AUTOINCREMENT RECIEN INSERTADO

            // INSERT EN LA TABLA EUCARISTIA
            if ($resultado) {
                $SQL = "INSERT INTO eucaristia (ID_eucaristia, Comunidad_encargada, ID_lugar, fechaIni, fechaFin) "
                    . "VALUES ('$idEvento', '$comuEncargada', '$lugar', '$fechaInicio', '$fechaFinal')";
                $resultado = $mysqli->query($SQL);

                // INSERT EN LA TABLA EUCARISTIA_COMUNIDAD
                if ($resultado) {
                    $SQL = "INSERT INTO eucaristia_comunidad (ID_evento, fecha_Ini, fecha_Fin, ID_lugar, ID_comunidad) "
                        . "VALUES ('$idEvento', '$fechaInicio', '$fechaFinal', '$lugar', '$numeroComunidad')";
                    $resultado = $mysqli->query($SQL);
                    echo $resultado;
                } else {
                    echo "ERROR, en la insercción eucaristia_comunidad";
                }
            } else {
                echo "ERROR, en la insercción eucaristía\n\n $resultado";
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
            echo "ERROR 07_EUCARISTIA.PHP";
            break;
    }
}
