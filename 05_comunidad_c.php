var ID_USUARIO = "";

// RECOJO EL TIPO DE ROL QUE SOY
var rol = AJAXCall("05_comunidad", "OPC=TIPO");
var admin = AJAXCall("05_comunidad", "OPC=ADMIN");

if (admin) {
    NC = $2("numeroComunidad").value;
    respuestaComu = AJAXCall("05_comunidad", "OPC=LISTADO_COMUNIDAD&NC=" + NC);
    try {
        resp = eval(respuestaComu);
    }
    catch (e) {
        console.log("ERROR COMUNIDADES ADMIN:\n\n" + respuestaComu);
    }
    var ncomunidad = NC;

} else {
    // RECOGO EL LISTADO DE LA COMUNIDAD
    var respuestaComu = AJAXCall("05_comunidad", "OPC=LISTADO_COMUNIDAD");
    try {
        var resp = eval(respuestaComu);
    }
    catch (e) {
        console.log("ERROR COMUNIDAD:\n\n" + respuestaComu);
    }
    ncomunidad = resp[0][10];
}
$2("MenuTitulo").innerHTML = 'Comunidad ' + ncomunidad  // nº comunidad



// <th scope="row">
//     <!-- MENÚ KEBAB -->
//     <div class="btn-group dropleft">
//         <i class="btn large material-icons" role="button" 
//             data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">more_vert</i>
//         <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
//             <li class="dropdown-item">Editar</li>
//             <li class="dropdown-item">Eliminar</li>
//         </div>
//     </div>
// </th>

//     < div class="btn-group btn-group-sm" role = "group" >
//         <button type="button" class="btn btn-secondary large material-icons transparent">edit</button>
//         <button type="button" class="btn btn-secondary large material-icons transparent">delete</button>
//     </div >


for (i = 0; i < resp.length; i++) {
    var tr = document.createElement("tr");
    var th1 = document.createElement("th");
    var th2 = document.createElement("th");
    var th3 = document.createElement("th");

    th1.innerHTML = resp[i][1] + ' ' + resp[i][2] + ' ' + resp[i][3];
    th2.innerHTML = resp[i][9];
    th3.innerHTML = "";

    if (rol) {
        var div3 = document.createElement("div");
        var bEdit = document.createElement("button");
        var bDel = document.createElement("button");
        div3.setAttribute("class", "btn-group btn-group-sm");
        bEdit.setAttribute("id-user", i);
        bEdit.setAttribute("class", "btn btn-secondary large material-icons bg-dark");
        bEdit.innerHTML = "edit";
        bDel.setAttribute("class", "btn btn-secondary large material-icons bg-dark");
        bDel.innerHTML = "delete_forever";
        bDel.setAttribute("id-user", i);
        div3.appendChild(bEdit);
        div3.appendChild(bDel);

        // BOTON LAPIZ
        bEdit.onclick = function (e) {
            $2("NC").value = NC;
            var id = this.getAttribute("id-user");
            ID_USUARIO = resp[id][0];
            $2("letrero").innerHTML = "Actualizar miembro";
            $2("nuevoMiembro").style.display = 'none';
            $2("actualizarMiembro").style.display = '';
            $2("opcion").value = "ACTUALIZAR";
            $2("idUser").value = ID_USUARIO;
            $2("activador2").click();

            var respuestaUsuarioComu = AJAXCall("05_comunidad", "OPC=DATOS_ACTUALIZAR&idUsuario=" + ID_USUARIO);
            try {
                var resp2 = eval(respuestaUsuarioComu);
            }
            catch (e) {
                console.log("ERROR COMUNIDAD:\n\n" + respuestaUsuarioComu);
            }

            // MUESTRO LOS DATOS DEL USUARIO EN EL FORMULARIO
            $2("nombreE").value = resp2[0][1];
            $2("apellido1E").value = resp2[0][2];
            $2("apellido2E").value = resp2[0][3];
            $2("tipoE").value = resp2[0][4];
            $2("emailE").value = resp2[0][5];
            $2("direccionE").value = resp2[0][6];
            $2("sexoE").value = resp2[0][7];
            $2("fijoE").value = resp2[0][8];
            $2("movilE").value = resp2[0][9];
            $2("contraseña").value = null;
            ev = e || event;
            ev.stopPropagation();
        }

        // BOTON PAPELERA  
        bDel.onclick = function (e) {
            var id = this.getAttribute("id-user");
            $2("eliminado").innerHTML = resp[id][1] + ' ' + resp[id][2] + ' ' + resp[id][3];
            ID_USUARIO = resp[id][0];
            $2("activador").click();
            ev = e || event;
            ev.stopPropagation();
        }
        th3.appendChild(div3);
    }

    tr.appendChild(th1);
    tr.appendChild(th2);
    tr.appendChild(th3);

    tr.style.cursor = "pointer";
    tr.setAttribute("idUser", i);
    tr.setAttribute("data-toggle", "modal");
    tr.setAttribute("data-target", "#myModal");
    tr.onclick = function () {
        id = this.getAttribute("idUser");
        $2("idUsuario").innerHTML = resp[id][0];
        $2("nombre").innerHTML = resp[id][1];
        $2("apellido1").innerHTML = resp[id][2];
        $2("apellido2").innerHTML = resp[id][3];
        $2("email").innerHTML = resp[id][5];
        $2("calle").innerHTML = resp[id][6];
        $2("sexo").innerHTML = resp[id][7];
        $2("fijo").innerHTML = resp[id][8];
        $2("movil").innerHTML = resp[id][9];
    };
    $2("comunidad").appendChild(tr);
};


// BOTON FLOATING +
if (rol) {
    var button = document.createElement('button');
    var i = document.createElement('i');

    button.setAttribute('id', 'floating');
    button.setAttribute('class', 'floating');
    button.setAttribute("data-toggle", "modal");
    button.setAttribute("data-target", "#myModal-añadirMiembroComunidad");

    button.onclick = function () {
        $2("miembroComunidad").reset();
        $2("opcion").value = "INSERTAR";
        $2("nuevoMiembro").style.display = '';
        $2("actualizarMiembro").style.display = 'none';
        $2("letrero").innerHTML = "Añadir miembro";
        $2("contraseña").value = generarClave(8);
    }
    i.setAttribute('class', 'large material-icons');
    i.innerHTML = 'add';
    button.appendChild(i);
    $2("comunidad").appendChild(button);

    // BOTON AÑADIR
    $2("nuevoMiembro").onclick = function () {
        ONSUBMIT = 0;
        $2("miembroComunidad").onsubmit = function () {
            event.preventDefault();
            $2("NC").value = NC;
            var insertar = AJAXCall("05_comunidad", "miembroComunidad");
            if (insertar) {
                $2("btn-cerrar2").click();
                GetModule("05_comunidad", "main");
            } else {
                alert("ERROR, al insertar el usuario");
            }
            return false;
        }
    }

    // BOTON ELIMINAR
    $2("modalEliminar").onclick = function () {
        Eliminar = AJAXCall("05_comunidad", "OPC=ELIMINAR&idMiembro=" + ID_USUARIO);
        if (Eliminar) {
            GetModule("05_comunidad", "main");
        } else {
            alert("ERROR, al eliminar el usuario");
        }
    }

    // BOTON ACTUALIZAR
    $2("actualizarMiembro").onclick = function () {
        $2("miembroComunidad").onsubmit = function () {
            event.preventDefault();
            $2("opcion").value = "ACTUALIZAR";
            $2("idUsuario").value = ID_USUARIO;
            var actualizar = AJAXCall("05_comunidad", "miembroComunidad");
            if (actualizar) {
                $2("btn-cerrar2").click();
                GetModule("05_comunidad", "main");
            } else {
                alert("ERROR, al actualizar el usuario");
            }
            return false;
        }
    }
}

function generarClave(longitud) {
    var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
    var contraseña = "";
    for (i = 0; i < longitud; i++) {
        contraseña += caracteres.charAt(Math.floor(Math.random() * caracteres.length));
    }
    return contraseña;
}



