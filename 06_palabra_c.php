var ID_PALABRA = "";

// RECOJO EL TIPO DE ROL QUE SOY
var rol = AJAXCall("06_palabra", "OPC=TIPO");

// RECOJO LAS COMUNIDADES
comu = AJAXCall("06_palabra", "OPC=COMUNIDADES");
try {
    comunidades = eval(comu);
}
catch (e) {
    console.log("ERROR COMUNIDADES EN PALABRA:\n\n" + comu);
}

// RECOJO LOS LUGARES
lug = AJAXCall("06_palabra", "OPC=LUGARES");
try {
    lugares = eval(lug);
}
catch (e) {
    console.log("ERROR COMUNIDADES EN PALABRA:\n\n" + lug);
}

// RECOJO SI SOY ADMIN O NO
var admin = AJAXCall("06_palabra", "OPC=ADMIN");

if (admin) {
    NC = $2("numeroComunidad").value;
    respuestaComu = AJAXCall("06_palabra", "OPC=PALABRAS&NC=" + NC);
    try {
        resp = eval(respuestaComu);
    }
    catch (e) {
        console.log("ERROR COMUNIDADES ADMIN:\n\n" + respuestaComu);
    }

} else {
    // RECOJO LAS PALABRAS
    respuesta = AJAXCall("06_palabra", "OPC=PALABRAS");
    try {
        resp = eval(respuesta);
    }
    catch (e) {
        console.log("ERROR PALABRA:\n\n" + respuesta);
    }
}


// <div  class="card border-dark m-2">
//  <div class="card-header bg-danger text-light border-dark">Palabra</div>
//     <div id="detalles" class="card-body text-dark bg-danger">
//         <h5 class="card-title text-light">Amor</h5>
//         <p class="text-light"><strong>Lugar:</strong> Salón de la 1ª</p>
//     </div>
//  <div class="card-footer bg-danger text-light border-dark">2019-03-30 21:00:00</div>
// </div>

// 1,Amor,Palabra molona,16,2019-05-08 00:00:00,Calderón

for (i = 0; i < resp.length; i++) {
    var div0 = document.createElement("div");
    var div1 = document.createElement("div");
    var div2 = document.createElement("div");
    var div3 = document.createElement("div");
    var h5 = document.createElement("h5");
    var p = document.createElement("p");
    var strong = document.createElement("STRONG");

    // CERO DIV
    div0.setAttribute("class", "card border-dark m-2");

    // PRIMER DIV
    div1.setAttribute("class", "card-header bg-danger text-light border-dark");
    div1.innerHTML = resp[i][2];

    // SEGUNDO DIV
    div2.setAttribute("class", "card-body text-dark bg-danger");
    h5.setAttribute("class", "card-title text-light");
    h5.innerHTML = resp[i][1];
    p.setAttribute("class", "text-light");
    strong.appendChild(document.createTextNode("Lugar: "));
    p.appendChild(strong);
    p.innerHTML += resp[i][5];

    // METO H5 Y P DENTRO DEL DIV2
    div2.appendChild(h5);
    div2.appendChild(p);

    // TERCER DIV
    div3.setAttribute("class", "card-footer bg-danger text-light border-dark");
    div3.innerHTML = resp[i][4];

    if (rol) {
        var div4 = document.createElement("div");
        var bEdit = document.createElement("button");
        var bDel = document.createElement("button");
        div4.setAttribute("class", "btn-group btn-group-sm float-right");
        bEdit.setAttribute("id-palabra", i);
        bEdit.setAttribute("class", "btn btn-secondary large material-icons bg-danger");
        bEdit.innerHTML = "edit";
        bDel.setAttribute("class", "btn btn-secondary large material-icons bg-danger");
        bDel.innerHTML = "delete_forever";
        bDel.setAttribute("id-palabra", i);
        div4.appendChild(bEdit);
        div4.appendChild(bDel);

        // BOTON LAPIZ
        bEdit.onclick = function (e) {
            $2("NComu").value = NC;
            var id = this.getAttribute("id-palabra");
            ID_PALABRA = resp[id][0];
            $2("letrero").innerHTML = "Actualizar Palabra";
            $2("nuevaPalabra").style.display = 'none';
            $2("actualizarPalabra").style.display = '';
            $2("opcion").value = "ACTUALIZAR";
            $2("idEvento").value = ID_PALABRA;
            $2("activadorP").click();

            var respuestaPalabra = AJAXCall("06_palabra", "OPC=DATOS_ACTUALIZAR&idEvento=" + ID_PALABRA);
            try {
                var resp2 = eval(respuestaPalabra);
            }
            catch (e) {
                console.log("ERROR ACTUALIAR DATOS BOTON LAPIZ:\n\n" + respuestaPalabra);
            }

            // MUESTRO LOS DATOS EN EL FORMULARIO
            var fecha = resp2[0][4];
            var primero = fecha.substr(0, 10);
            var segundo = fecha.substr(11, 15);
            primero += "T";
            fecha = primero + segundo;
            $2("fechaInicio").value = fecha;
            fecha = resp2[0][5];
            primero = fecha.substr(0, 10);
            segundo = fecha.substr(11, 15);
            primero += "T";
            fecha = primero + segundo;
            $2("fechaFinal").value = fecha;
            $2("lugarE").value = resp2[0][6];
            $2("tituloP").value = resp2[0][2];
            $2("detallesP").value = resp2[0][1];
            ev = e || event;
            ev.stopPropagation();
        }

        // BOTON PAPELERA  
        bDel.onclick = function (e) {
            var id = this.getAttribute("id-palabra");
            $2("eliminado").innerHTML = resp[id][2];
            ID_PALABRA = resp[id][0];
            $2("activador").click();
            ev = e || event;
            ev.stopPropagation();
        }
        div1.appendChild(div4);
    }

    // ESCUPO LOS DIV
    div0.appendChild(div1);
    div0.appendChild(div2);
    div0.appendChild(div3);
    $2("mensaje").appendChild(div0);
};


// BOTON FLOATING +
if (rol) {
    var button = document.createElement('button');
    var i = document.createElement('i');

    button.setAttribute('id', 'floating');
    button.setAttribute('class', 'floating');
    button.setAttribute("data-toggle", "modal");
    button.setAttribute("data-target", "#myModal-añadirPalabra");

    button.onclick = function () {
        $2("formPalabra").reset();
        $2("opcion").value = "INSERTAR";
        $2("nuevaPalabra").style.display = '';
        $2("actualizarPalabra").style.display = 'none';
        $2("letrero").innerHTML = "Añadir Palabra";
    }
    i.setAttribute('class', 'large material-icons');
    i.innerHTML = 'add';
    button.appendChild(i);
    $2("mensaje").appendChild(button);

    // RELLENAMOS SELECT LUGAR
    for (var j = 0; j < lugares.length; j++) {
        var option2 = document.createElement("option"); //Creamos la opcion
        option2.innerHTML = lugares[j][1]; //Metemos el texto en la opción
        option2.value = lugares[j][0]; //Metemos el value
        $2("lugarE").appendChild(option2); //Metemos la opción en el select
    }

    // BOTON AÑADIR
    $2("nuevaPalabra").onclick = function () {
        $2("formPalabra").onsubmit = function () {
            event.preventDefault();
            if ($2("fechaFinal").value < $2("fechaInicio").value) {
                $2("mensaje2").innerHTML = "La fecha fin no puede ser menor que la de inicio.";
                $2("activador2").click();
            } else {
                $2("NComu").value = NC;
                insertar = AJAXCall("06_palabra", "formPalabra");
                console.log(insertar);
                if (insertar) {
                    $2("btn-cerrar2").click();
                    GetModule("06_palabra", "main");
                } else {
                    $2("activadorOcupado").click();
                }
            }
            return false;
        }
    }

    // BOTON ELIMINAR
    $2("modalEliminar").onclick = function () {
        Eliminar = AJAXCall("06_palabra", "OPC=ELIMINAR&idEvento=" + ID_PALABRA);
        if (Eliminar) {
            GetModule("06_palabra", "main");
        } else {
            alert("ERROR, al eliminar la palabra");
        }
    }

    // BOTON ACTUALIZAR
    $2("actualizarPalabra").onclick = function () {
        $2("formPalabra").onsubmit = function () {
            event.preventDefault();
            $2("opcion").value = "ACTUALIZAR";
            $2("idEvento").value = ID_PALABRA;
            if ($2("fechaFinal").value < $2("fechaInicio").value) {
                $2("mensaje2").innerHTML = "La fecha fin no puede ser menor que la de inicio.";
                $2("activador2").click();
            } else {
                var actualizar = AJAXCall("06_palabra", "formPalabra");
                console.log(actualizar);
                if (actualizar) {
                    $2("btn-cerrar2").click();
                    GetModule("06_palabra", "main");
                } else {
                    $2("activadorOcupado").click();
                }
            }
            return false;
        }
    }
}