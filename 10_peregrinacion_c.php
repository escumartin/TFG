var ID_PERE = "";

// CONTROLO EL ROL QUE SOY
tipo = AJAXCall("10_peregrinacion", "OPC=TIPO");
try {
    rol = eval(tipo);
}
catch (e) {
    console.log("ERROR PEREGRINACION (TIPO ROL):\n\n" + tipo);
}

// LISTAMOS LAS PEREGRINACIONES
respuesta = AJAXCall("10_peregrinacion", "OPC=PEREGRINACIONES");
try {
    resp = eval(respuesta);
}
catch (e) {
    console.log("ERROR PEREGRINACION:\n\n" + respuesta);
}

// <div class="card border-dark m-2">
//     <div class="card-header card-title bg-primary text-light border-dark">Islas Canarias</div>
//         <div class="card-body text-dark bg-primary">
//             <p class="text-light text-justify">Esta es la descripción de la pereregrinación donde se va a detallar que se va
//                 hacer en ella así como, las reuinones que habrán, las distintas actividades que aresmos etc.</p>
//             <p class="text-light"><strong>Precio:</strong> 200 €</p>
//         </div>
//     <div class="card-footer bg-primary text-light border-dark">2019-03-30 21:00:00</div>
// </div>

// 1,Esta es la descripción de la pereregrinación donde se va a detallar que se va hacer en ella así como, 
// las reuinones que habrán, las distintas actividades que aresmos etc.,350,Francia,2019-07-28 00:00:00

for (i = 0; i < resp.length; i++) {
    var div0 = document.createElement("div");
    var div1 = document.createElement("div");
    var div2 = document.createElement("div");
    var div3 = document.createElement("div");
    var p2 = document.createElement("p2");
    var p = document.createElement("p");
    var strong = document.createElement("STRONG");

    // CERO DIV
    div0.setAttribute("class", "card border-dark m-2");

    // PRIMER DIV
    div1.setAttribute("class", "card-header bg-primary border-dark text-light");
    div1.innerHTML = resp[i][3];

    // SEGUNDO DIV
    div2.setAttribute("class", "card-body bg-primary text-justify");
    p2.setAttribute("class", "card-title text-light");
    p2.innerHTML = resp[i][1];
    p.setAttribute("class", "text-light");
    strong.appendChild(document.createTextNode("Precio: "));
    p.appendChild(strong);
    p.innerHTML += resp[i][2] + '€';

    // METO H5 Y P DENTRO DEL DIV2
    div2.appendChild(p2);
    div2.appendChild(p);

    // TERCER DIV
    div3.setAttribute("class", "card-footer bg-primary border-dark text-light");
    div3.innerHTML = resp[i][4];

    if (rol) {
        var div4 = document.createElement("div");
        var bEdit = document.createElement("button");
        var bDel = document.createElement("button");
        div4.setAttribute("class", "btn-group btn-group-sm float-right");
        bEdit.setAttribute("id-pere", i);
        bEdit.setAttribute("class", "btn btn-secondary large material-icons bg-primary");
        bEdit.innerHTML = "edit";
        bDel.setAttribute("class", "btn btn-secondary large material-icons bg-primary");
        bDel.innerHTML = "delete_forever";
        bDel.setAttribute("id-pere", i);
        div4.appendChild(bEdit);
        div4.appendChild(bDel);

        // BOTON LAPIZ
        bEdit.onclick = function (e) {
            var id = this.getAttribute("id-pere");
            ID_PERE = resp[id][0];
            $2("letrero").innerHTML = "Actualizar Peregrinación";
            $2("nuevaPere").style.display = 'none';
            $2("actualizarPere").style.display = '';
            $2("opcion").value = "ACTUALIZAR";
            $2("idPere").value = ID_PERE;
            $2("activador2").click();

            var respuestaPere = AJAXCall("10_peregrinacion", "OPC=DATOS_ACTUALIZAR&idPere=" + ID_PERE);
            try {
                var resp2 = eval(respuestaPere);
            }
            catch (e) {
                console.log("ERROR PEREGRINACION DATOS_ACTUALIZAR:\n\n" + respuestaPere);
            }

            // MUESTRO LOS DATOS DEL USUARIO EN EL FORMULARIO
            $2("titulo").value = resp2[0][3];
            $2("detalles").value = resp2[0][1];
            $2("precio").value = resp2[0][2];
            var fecha = resp2[0][4];
            var primero = fecha.substr(0, 10);
            var segundo = fecha.substr(11, 15);
            primero += "T";
            fecha = primero + segundo;
            $2("fecha").value = fecha;
            ev = e || event;
            ev.stopPropagation();
        }

        // BOTON PAPELERA  
        bDel.onclick = function (e) {
            var id = this.getAttribute("id-pere");
            $2("eliminado").innerHTML = resp[id][3];
            ID_PERE = resp[id][0];
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
    button.setAttribute("data-target", "#myModal-añadirPeregrinacion");

    button.onclick = function () {
        $2("formPeregrinacion").reset();
        $2("opcion").value = "INSERTAR";
        $2("nuevaPere").style.display = '';
        $2("actualizarPere").style.display = 'none';
        $2("letrero").innerHTML = "Añadir Peregrinación";
    }
    i.setAttribute('class', 'large material-icons');
    i.innerHTML = 'add';
    button.appendChild(i);
    $2("mensaje").appendChild(button);

    // BOTON AÑADIR
    $2("nuevaPere").onclick = function () {
        $2("formPeregrinacion").onsubmit = function () {
            event.preventDefault();
            insertar = AJAXCall("10_peregrinacion", "formPeregrinacion");
            if (insertar) {
                $2("btn-cerrar2").click();
                GetModule("10_peregrinacion", "main");
            } else {
                alert("ERROR, al insertar la peregrinacion");
            }
        }
    }

    // BOTON ELIMINAR
    $2("modalEliminar").onclick = function () {
        Eliminar = AJAXCall("10_peregrinacion", "OPC=ELIMINAR&idPere=" + ID_PERE);
        if (Eliminar) {
            GetModule("10_peregrinacion", "main");
        } else {
            alert("ERROR, al eliminar el usuario");
        }
    }

    // // BOTON ACTUALIZAR
    $2("actualizarPere").onclick = function () {
        $2("formPeregrinacion").onsubmit = function () {
            event.preventDefault();
            $2("opcion").value = "ACTUALIZAR";
            $2("idPere").value = ID_PERE;

            var actualizar = AJAXCall("10_peregrinacion", "formPeregrinacion");
            if (actualizar) {
                $2("btn-cerrar2").click();
                GetModule("10_peregrinacion", "main");
            } else {
                alert("ERROR, al actualizar la peregrinación");
            }

        }
    }
}