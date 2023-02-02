<?php
session_start();
if (!isset($_SESSION["TIPO"]))
    $_SESSION["TIPO"] = "INVITADO";

switch ($_SESSION["TIPO"]) {
    case "INVITADO":
        include("01_menu_invitado_c.php");
        break;
    case "REGISTRADO":
        include("01_menu_registrado_c.php");
        break;
    case "RESPONSABLE":
        include("01_menu_registrado_c.php");
        break;
    case "ADMIN":
        include("01_menu_admin_c.php");
        break;

    default:
        echo "ERROR TIPO USUARIO EN MENU CONTROLADOR";
        break;
}
