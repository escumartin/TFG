$2("MenuCerrarSesion").onclick = function () {
    $2("MenuHamburguesa").click();
    respuesta = AJAXCall("03_logout", "");
    GetModule("01_menu", "menu");
    GetModule("02_noticias", "main");
    $2("mensaje").innerHTML = '<div class="alert alert-primary alert-dismissible fade show" role="alert"> Ha cerrado sesión <strong>correctamente</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}
$2("MenuNoticias").onclick = function () {
    $2("MenuTitulo").innerHTML = "Noticias";
    $2("MenuHamburguesa").click();
    GetModule("02_noticias", "main");
}
$2("MenuPerfil").onclick = function () {
    $2("MenuTitulo").innerHTML = "Perfil";
    $2("MenuHamburguesa").click();
    GetModule("04_perfil", "main");
}
$2("MenuComunidad").onclick = function () {
    $2("MenuTitulo").innerHTML = "Comunidad ";
    $2("MenuHamburguesa").click();
    GetModule("05_comunidad", "main");
}
$2("MenuPalabra").onclick = function () {
    $2("MenuTitulo").innerHTML = "Palabra";
    $2("MenuHamburguesa").click();
    GetModule("06_palabra", "main");
}
$2("MenuEucaristia").onclick = function () {
    $2("MenuTitulo").innerHTML = "Eucaristía";
    $2("MenuHamburguesa").click();
    GetModule("07_eucaristia", "main");
}
$2("MenuConvivencia").onclick = function () {
    $2("MenuTitulo").innerHTML = "Convivencia";
    $2("MenuHamburguesa").click();
    GetModule("08_convivencia", "main");
}
$2("MenuPasos").onclick = function () {
    $2("MenuTitulo").innerHTML = "Pasos";
    $2("MenuHamburguesa").click();
    GetModule("09_pasos", "main");
}
$2("MenuPeregrinacion").onclick = function () {
    $2("MenuTitulo").innerHTML = "Peregrinaciones";
    $2("MenuHamburguesa").click();
    GetModule("10_peregrinacion", "main");
}
$2("MenuGenerarGrupos").onclick = function () {
    $2("MenuTitulo").innerHTML = "Grupos";
    $2("MenuHamburguesa").click();
    GetModule("11_grupos", "main");
    $2("wrapper").innerHTML = strGrupos;
}

