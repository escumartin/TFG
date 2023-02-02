$2("MenuIniciarSesion").onclick = function () {
    $2("MenuTitulo").innerHTML = "Iniciar sesión";
    $2("MenuHamburguesa").click();
    GetModule("03_login", "main");
}
$2("MenuNoticias").onclick = function () {
    $2("MenuTitulo").innerHTML = "Noticias";
    $2("MenuHamburguesa").click();
    GetModule("02_noticias", "main");
}
