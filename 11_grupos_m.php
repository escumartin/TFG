<?php
include("libs/conexion.php");
session_start();

// $_SESSION["TIPO"];
// $_SESSION["ID"];
// $_SESSION["comunidad"];

$grupos = $_POST["ngrupos"];

$SQL = "SELECT ID_usuario, Nombre, Apellido_1, Apellido_2 FROM usuario WHERE Nº_comunidad = {$_SESSION["comunidad"]}";
$resultado = $mysqli->query($SQL);

if (!is_null($resultado)) {
    $rows = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $rows[] = $row;
    }

    $longitud = count($rows);

    // DECLARAMOS LOS ARRAYS
    $UsuariosPorGrupo = array();
    $Mgrupos = array();

    // REPARTIMOS EL TRABAJO
    for ($i = 0; $i < $grupos; $i++) {
        $UsuariosPorGrupo[$i] = floor($longitud / $grupos);
        $Mgrupos[$i] = array();
    }
    // LA PARTE QUE SOBRA
    for ($i = 0; $i < ($longitud % $grupos); $i++) {
        $UsuariosPorGrupo[$i] += 1;
    }

    $longitud--;

    // CREAMOS LA MATRIZ CON LOS GRUPOS
    for ($i = 0; $i < $grupos; $i++) {
        for ($j = 0; $j < $UsuariosPorGrupo[$i]; $j++) {
            $rand = rand(0, $longitud);
            array_push($Mgrupos[$i], $rows[$rand]);
            unset($rows[$rand]);
            $rows = array_values($rows);
            $longitud--;
        }
    }
    echo json_encode($Mgrupos);
} else {
    echo "[($mysqli->error)]";
}
