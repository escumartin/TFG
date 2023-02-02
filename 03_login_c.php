$2("formLogin").onsubmit = function () {
    // PARA LOGUEARME
    respuestaLogin = AJAXCall("03_login", "formLogin");
    // PARA QUE NO NAVEGUE
    event.preventDefault();
    // RECOGO EL JSON QUE HA ESCUPIDO EL PHP
    respuestaLogin = JSON.parse(respuestaLogin);

    if(respuestaLogin.resultado){
        GetModule("01_menu", "menu");
        GetModule("02_noticias", "main");
        $2("mensaje").innerHTML =  respuestaLogin.htmlResultado;
    }else{
        $2("mensaje").innerHTML = respuestaLogin.htmlResultado;
    }
    return false;
}