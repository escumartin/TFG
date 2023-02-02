var ID_PASO = "";

// RECOJO EL TIPO DE ROL QUE SOY
var rol = AJAXCall("09_pasos", "OPC=TIPO");

// RECOJO LOS LUGARES
lug = AJAXCall("09_pasos", "OPC=LUGARES");
try {
    lugares = eval(lug);
}
catch (e) {
    console.log("ERROR LUGARES EN EUCARISTIA:\n\n" + lug);
}

// RECOJO SI SOY ADMIN O NO
var admin = AJAXCall("09_pasos", "OPC=ADMIN");

if (admin) {
    NC = $2("numeroComunidad").value;
    respuestaComu = AJAXCall("09_pasos", "OPC=PASOS&NC=" + NC);
    try {
        resp = eval(respuestaComu);
    }
    catch (e) {
        console.log("ERROR COMUNIDADES ADMIN:\n\n" + respuestaComu);
    }

} else {
    // RECOJO TODOS LOS PASOS
    respuesta = AJAXCall("09_pasos", "OPC=PASOS");
    try {
        resp = eval(respuesta);
    }
    catch (e) {
        console.log("ERROR PASOS:\n\n" + respuesta);
    }
}


// <div class="card border-dark m-2">
//     <div class="card-header bg-info text-light border-dark">Primer escrutinio</div>
//     <div class="card-body text-dark bg-info">
//         <p class="text-light"><strong>Lugar: </strong>Puerto Lumbreras</p>
//     </div>
//     <div class="card-footer bg-suc bg-info text-light border-dark">2019-03-30 21:00:00</div>
// </div> 

// 5,Primer escrutinio 2019,105,Primer escrutinio ,16,2019-05-29 19:00:00,Puerto lumbreras

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
    div1.setAttribute("class", "card-header bg-info border-dark text-light");
    div1.innerHTML = resp[i][3];

    // SEGUNDO DIV
    div2.setAttribute("class", "card-body bg-info");
    h5.setAttribute("class", "card-title text-light");
    h5.innerHTML = resp[i][1] + ' (' + resp[i][2] + '€)';
    p.setAttribute("class", "text-light");
    strong.appendChild(document.createTextNode("Lugar: "));
    p.appendChild(strong);
    p.innerHTML += resp[i][6];

    // METO H5 Y P DENTRO DEL DIV2
    div2.appendChild(h5);
    div2.appendChild(p);

    // TERCER DIV
    div3.setAttribute("class", "card-footer bg-info border-dark text-light");
    div3.innerHTML = resp[i][5];

    if (rol) {
        var div4 = document.createElement("div");
        var bEdit = document.createElement("button");
        var bDel = document.createElement("button");
        div4.setAttribute("class", "btn-group btn-group-sm float-right");
        bEdit.setAttribute("id-palabra", i);
        bEdit.setAttribute("class", "btn btn-secondary large material-icons bg-info");
        bEdit.innerHTML = "edit";
        bDel.setAttribute("class", "btn btn-secondary large material-icons bg-info");
        bDel.innerHTML = "delete_forever";
        bDel.setAttribute("id-palabra", i);
        div4.appendChild(bEdit);
        div4.appendChild(bDel);

        // BOTON LAPIZ
        bEdit.onclick = function (e) {
            $2("NC").value = NC;
            var id = this.getAttribute("id-palabra");
            ID_PASO = resp[id][0];
            $2("letrero").innerHTML = "Actualizar paso";
            $2("nuevoPaso").style.display = 'none';
            $2("actualizarPaso").style.display = '';
            $2("opcion").value = "ACTUALIZAR";
            $2("idEvento").value = ID_PASO;
            $2("activadorP").click();

            var respuestaPaso = AJAXCall("09_pasos", "OPC=DATOS_ACTUALIZAR&idEvento=" + ID_PASO);
            try {
                var resp2 = eval(respuestaPaso);
            }
            catch (e) {
                console.log("ERROR ACTUALIAR DATOS BOTON LAPIZ:\n\n" + respuestaPaso);
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
            $2("titulo").value = resp2[0][3];
            $2("detalles").value = resp2[0][1];
            $2("cifra").value = resp2[0][2];
            ev = e || event;
            ev.stopPropagation();
        }

        // BOTON PAPELERA  
        bDel.onclick = function (e) {
            var id = this.getAttribute("id-palabra");
            $2("eliminado").innerHTML = resp[id][5];
            ID_PASO = resp[id][0];
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
    button.setAttribute("data-target", "#myModal-añadirPaso");

    button.onclick = function () {
        $2("formPaso").reset();
        $2("opcion").value = "INSERTAR";
        $2("nuevoPaso").style.display = '';
        $2("actualizarPaso").style.display = 'none';
        $2("letrero").innerHTML = "Añadir paso";
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
    $2("nuevoPaso").onclick = function () {
        $2("formPaso").onsubmit = function () {
            event.preventDefault();
            $2("NC").value = NC;
            if ($2("fechaFinal").value < $2("fechaInicio").value) {
                $2("mensaje2").innerHTML = "La fecha fin no puede ser menor que la de inicio.";
                $2("activador2").click();
            } else {
                insertar = AJAXCall("09_pasos", "formPaso");
                if (insertar) {
                    $2("btn-cerrar2").click();
                    GetModule("09_pasos", "main");
                } else {
                    $2("activadorOcupado").click();
                }
            }
        }
    }

    // BOTON ELIMINAR
    $2("modalEliminar").onclick = function () {
        Eliminar = AJAXCall("09_pasos", "OPC=ELIMINAR&idEvento=" + ID_PASO);
        if (Eliminar) {
            GetModule("09_pasos", "main");
        } else {
            alert("ERROR, al eliminar paso");
        }
    }

    // BOTON ACTUALIZAR
    $2("actualizarPaso").onclick = function () {
        $2("formPaso").onsubmit = function () {
            event.preventDefault();
            $2("opcion").value = "ACTUALIZAR";
            $2("idEvento").value = ID_PASO;
            if ($2("fechaFinal").value < $2("fechaInicio").value) {
                $2("mensaje2").innerHTML = "La fecha fin no puede ser menor que la de inicio.";
                $2("activador2").click();
            } else {
                var actualizar = AJAXCall("09_pasos", "formPaso");
                if (actualizar) {
                    $2("btn-cerrar2").click();
                    GetModule("09_pasos", "main");
                } else {
                    $2("activadorOcupado").click();
                }
            }
        }
    }
}
