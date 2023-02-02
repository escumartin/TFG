// Tipo Usuario
respuestaROL = AJAXCall("02_noticias", "opcion=ES_EDITOR");
var esEditor = eval(respuestaROL);
respuestaROL = AJAXCall("02_noticias", "opcion=ES_ADMIN");
var esAdmin = eval(respuestaROL);

// MUESTRO LAS NOTICIAS
respuesta = AJAXCall("02_noticias", "opcion=NOTICIAS");
respuesta = JSON.parse(respuesta);
var noticiasHTML = "";
respuesta.forEach(noticia => {
    noticiasHTML += '<div name="' + noticia.id + '" class="card">'
    noticiasHTML += '<img src="' + noticia.ruta + '" class="card-img-top" alt="imagen noticia">'
    noticiasHTML += '<div class="card-body text-left">'
    noticiasHTML += '<h5 class="card-title">' + noticia.titulo + '</h5>'
    noticiasHTML += '<p class="card-text">' + noticia.contenido + '</p>'
    noticiasHTML += '</div>'
    noticiasHTML += '<div class="card-footer">'
    noticiasHTML += '<div class="row"><div id="btn-edit" class="col-6">';
    if (esEditor)
        noticiasHTML += '<div class="dropdown show align-self-end dropright"><button class="btn btn-secondary btn-group btn-sm dropdown-toggle" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="large material-icons">edit</i></button><div class="dropdown-menu" aria-labelledby="dropdownMenuLink">'
            + '<li id="noticiaEditar_' + noticia.id + '" class="dropdown-item" data-toggle="modal" data-target="#myModal-añadirNoticia">Editar</li>'
            + '<li id="noticiaEliminar_' + noticia.id + '" class="dropdown-item" href="#">Eliminar</li></div></div>';
    noticiasHTML += '</div>'
    noticiasHTML += '<div class="col-10>';
    noticiasHTML += '<small id="date" class="text-muted">' + noticia.fechaP + '</small>'
    noticiasHTML += '</div>'
    noticiasHTML += '</div>'
    noticiasHTML += '</div>'
    noticiasHTML += '</div>'
});
$2("noticias").innerHTML += noticiasHTML;

if (esEditor) {
    // BOTON EDITAR
    respuesta.forEach(noticia => {
        $2(("noticiaEditar_" + noticia.id)).onclick = function () {
            $2("añadirNoticia").style.display = 'none';
            $2("actualizarNoticia").style.display = '';
            $2("opcion").value = "ACTUALIZAR";
            $2("idNoticia").value = noticia.id;
            $2("letrero").innerHTML = "Actualizar Noticia";
            resptaNoticia = AJAXCall("02_noticias", "idNoticia=" + noticia.id + "&opcion=DATOS-NOTICIA");
            try { respuestaNoticia = JSON.parse(resptaNoticia); }
            catch (e) { console.log(resptaNoticia); }
            $2("imagen").value = respuestaNoticia.ruta;
            $2("titulo").value = respuestaNoticia.titulo;
            $2("contenido").value = respuestaNoticia.contenido;
            var fechaP = respuestaNoticia.fechaP;
            var primero = fechaP.substr(0, 10);
            var segundo = fechaP.substr(11, 15);
            primero += "T";
            fechaP = primero + segundo;
            $2("fpublicacion").value = fechaP;
            var fechaC = respuestaNoticia.fechaC;
            var primero = fechaP.substr(0, 10);
            var segundo = fechaP.substr(11, 15);
            primero += "T";
            fechaC = primero + segundo;
            $2("fcaducidad").value = fechaC;

            // BOTON PARA ACTUALIZAR
            $2("form_noticia").onsubmit = function () {
                $2("opcion").value = "ACTUALIZAR";
                respuestaActualizar = AJAXCall("02_noticias", "form_noticia");
                $2("btn-cerrar").click();
                GetModule("02_noticias", "main");
                event.preventDefault();
                return false;
            }
        }

        // BOTON ELIMINAR
        $2("noticiaEliminar_" + noticia.id).onclick = function () {
            $2("eliminado").innerHTML = noticia.titulo;
            $2("activador").click();
        }

        // ELIMINAR NOTICIA
        $2("modalEliminar").onclick = function () {
            respuestaEliminar = AJAXCall("02_noticias", "opcion=ELIMINAR&idNoticia=" + noticia.id);
            if (respuestaEliminar) {
                GetModule("02_noticias", "main");
            } else {
                alert("ERROR, al eliminar la noticia");
            }
        }
    });
}

// MUESTRO EL BOTON +
if (esEditor == true) {
    var button = document.createElement('button');
    var i = document.createElement('i');

    button.setAttribute('id', 'floating');
    button.setAttribute('class', 'floating');
    // button.setAttribute("data-toggle", "modal");
    // button.setAttribute("data-target", "#myModal-añadirNoticia");
    button.onclick = function () {
        $2("form_noticia").reset();
        $2("añadirNoticia").style.display = '';
        $2("actualizarNoticia").style.display = 'none';
        $2("letrero").innerHTML = "Crear noticia";
        $2("+").click();
    }
    i.setAttribute('class', 'large material-icons');
    i.innerHTML = 'add';
    button.appendChild(i);
    $2("noticias").appendChild(button);

    // BOTON PARA AÑADIR
    $2("añadirNoticia").onclick = function () {
        $2("form_noticia").onsubmit = function () {
            event.preventDefault();

            if ($2("fcaducidad").value < $2("fpublicacion").value) {
                $2("mensaje2").innerHTML = "La fecha de caducidad no puede ser menor que la de publicación.";
                $2("activador2").click();
            } else {
                $2("opcion").value = "INSERTAR";
                respuestaAñadir = AJAXCall("02_noticias", "form_noticia");
                if (respuestaAñadir) {
                    $2("mensaje2").innerHTML = "Tu noticia ha sido creada con <strong>éxito</strong>.";
                    $2("activador2").click();
                    GetModule("02_noticias", "main");
                } else {
                    alert("ERROR, al crear la noticia");
                }
            }
            return false;
        }
        if ($2("titulo").value != "" && $2("contenido").value != "" && $2("fcaducidad").value >= $2("fpublicacion").value && $2("fpublicacion").value != "" && $2("fcaducidad").value != "") {
            $2("btn-cerrar").click();
        }
    }
}








