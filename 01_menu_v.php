<?php
session_start();
if (!isset($_SESSION["TIPO"]))
    $_SESSION["TIPO"] = "INVITADO";

switch ($_SESSION["TIPO"]) {
    case "INVITADO":
        include("01_menu_invitado_v.php");
        break;
    case "REGISTRADO":
        include("01_menu_registrado_v.php");
        break;
    case "RESPONSABLE":
        include("01_menu_registrado_v.php");
        break;
    case "ADMIN":
        include("01_menu_admin_v.php");
        break;
    default:
        echo "ERROR TIPO USUARIO EN MENU VISTA";
        break;
}
