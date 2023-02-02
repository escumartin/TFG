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

// RECOJO LAS COMUNIDADES
comu = AJAXCall("01_menu_admin", "");
try {
    comunidades = eval(comu);
}
catch (e) {
    console.log("ERROR COMUNIDADES EN PALABRA:\n\n" + comu);
}

// RELLENAMOS SELECT COMUNIDAD
for (var j = 0; j < comunidades.length; j++) {
    var option = document.createElement("option"); //Creamos la opcion
    option.innerHTML = comunidades[j]; //Metemos el texto en la opción
    option.value = comunidades[j]; //Metemos el value
    $2("numeroComunidad").appendChild(option); //Metemos la opción en el select
}

$2("MenuCrearComunidad").onclick = function () {
    $2("MenuTitulo").innerHTML = "Crear comunidad";
    $2("MenuHamburguesa").click();
    GetModule("12_crear_comunidad", "main");
}

$2("MenuCrearLugar").onclick = function () {
    $2("MenuTitulo").innerHTML = "Crear lugar";
    $2("MenuHamburguesa").click();
    GetModule("13_crear_lugar", "main");
}

