<?php
    session_start();
    session_destroy();
    session_start();
if (!isset($_SESSION["TIPO"]))
    $_SESSION["TIPO"] = "INVITADO";

    echo $_SESSION["TIPO"];