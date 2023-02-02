
$2("formGrupos").onsubmit = function () {
    respuesta = AJAXCall("11_grupos", "formGrupos");
    respuesta = JSON.parse(respuesta);
    strGrupos="";
    for (i = 0; i < respuesta.length; i++) {
        strGrupos += '<div class="card border-dark m-2">'
        strGrupos += '<div class="card-header">Grupo ' + (i+1) + '</div>'
        strGrupos += '<div id="pantalla" class="card-body text-dark">'
        strGrupos += '<ul>'
        for (j = 0; j < respuesta[i].length; j++) {
            strGrupos += '<li>' + respuesta[i][j].Nombre + ' ' + respuesta[i][j].Apellido_1 + ' ' + respuesta[i][j].Apellido_2 + '</li>'
        }
        strGrupos += '</ul>'
        strGrupos += '</div>'
        strGrupos += '</div>'
    }
    $2("wrapper").innerHTML = strGrupos;
    event.preventDefault();
    return false;
}

