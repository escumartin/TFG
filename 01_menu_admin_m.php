<?php
include("libs/conexion.php");
session_start();

// $_SESSION["TIPO"];
// $_SESSION["ID"];
// $_SESSION["comunidad"];


$SQL = "SELECT * FROM comunidad";
echo get_Data_SQL($SQL, array(), $mysqli);
