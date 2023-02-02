<?php
include("libs/conexion.php");
session_start();

$usuario = $_POST["usuario"];
$pass = $_POST["pass"];

$SQL = "SELECT * FROM usuario WHERE ID_usuario = '$usuario'";
$pass1 = MYSQL_GET_VAL($mysqli, $SQL, "pass");
$pass2 = MYSQL_GET_VAL($mysqli, "SELECT SUBSTR(PASSWORD('$pass'), 1, 20) AS pass", "pass");


if (!is_null($pass1) && $pass1 == $pass2) {
    $nombre = MYSQL_GET_VAL($mysqli, $SQL, "Nombre");
    $apellido1 = MYSQL_GET_VAL($mysqli, $SQL, "Apellido_1");
    $apellido2 = MYSQL_GET_VAL($mysqli, $SQL, "Apellido_2");
    $_SESSION["TIPO"] = MYSQL_GET_VAL($mysqli, $SQL, "Tipo");
    $_SESSION["ID"] = $usuario;
    $_SESSION["comunidad"] = MYSQL_GET_VAL($mysqli, $SQL, "Nº_comunidad");
    echo json_encode(array("resultado" => true, "htmlResultado" => '<div class="alert alert-success alert-dismissible fade show" role="alert">Bienvenido <strong>'.$nombre.' '.$apellido1.' '.$apellido2.'</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button></div>'));
} else {
    echo json_encode(array("resultado" => false, "htmlResultado" => '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Usuario o conteaseña <strong>incorrecto</strong>, por favor vuelve a introducirlos
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button></div>'));
}
