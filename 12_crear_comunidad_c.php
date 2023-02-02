var ID_COMUNIDAD = "";

// RECOJO EL LISTADO DE LAS COMUNIDADES
var respuestaComu = AJAXCall("12_crear_comunidad", "OPC=LISTADO_COMUNIDADES");
try {
    var resp = eval(respuestaComu);
}
catch (e) {
    console.log("ERROR COMUNIDADES:\n\n" + respuestaComu);
}

$2("MenuTitulo").innerHTML = "Comunidades";

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



    th1.innerHTML = resp[i][0];     // NUMERO DE COMUNIDAD
    th2.innerHTML = resp[i][1];     // NUMERO DE HERMANOS DE LA COMUNIDAD
    th3.innerHTML = "";

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
        var id = this.getAttribute("id-user");
        ID_COMUNIDAD = resp[id][0];
        $2("letrero").innerHTML = "Actualizar comunidad";
        $2("nuevoMiembro").style.display = 'none';
        $2("actualizarMiembro").style.display = '';
        $2("opcion").value = "ACTUALIZAR";
        $2("idUser").value = ID_COMUNIDAD;
        $2("activador2").click();

        var respuestaComu = AJAXCall("12_crear_comunidad", "OPC=DATOS_ACTUALIZAR&ID_comunidad=" + ID_COMUNIDAD);
        try {
            var resp2 = eval(respuestaComu);
        }
        catch (e) {
            console.log("ERROR COMUNIDAD:\n\n" + respuestaComu);
        }

        // MUESTRO LOS DATOS DEL USUARIO EN EL FORMULARIO
        $2("nComunidad").value = resp2[0][0];
        ev = e || event;
        ev.stopPropagation();
    }

    // BOTON PAPELERA  
    bDel.onclick = function (e) {
        var id = this.getAttribute("id-user");
        $2("eliminado").innerHTML = resp[id][0];
        ID_COMUNIDAD = resp[id][0];
        $2("activador").click();
        ev = e || event;
        ev.stopPropagation();
    }
    th3.appendChild(div3);

    tr.appendChild(th1);
    tr.appendChild(th2);
    tr.appendChild(th3);

    tr.style.cursor = "pointer";
    tr.setAttribute("idComu", resp[i][0]);
    tr.onclick = function () {
        id = this.getAttribute("idComu");
        $2("activador3").click();
        // LIMPIO LOS CAMPOS
        $2("idUsuario").innerHTML = "";
        $2("nombre").innerHTML = "";
        $2("apellido1").innerHTML = "";
        $2("apellido2").innerHTML = "";
        $2("email").innerHTML = "";
        $2("calle").innerHTML = "";
        $2("sexo").innerHTML = "";
        $2("fijo").innerHTML = "";
        $2("movil").innerHTML = "";

        // RECOJO EL RESPONSABLE DE CADA COMUNIDAD
        var responsables = AJAXCall("12_crear_comunidad", "OPC=CONTAR_RESPONSABLES&comunidad=" + id);
        try {
            var respon = eval(responsables);
        }
        catch (e) {
            console.log("ERROR COMUNIDADES USUARIOS:\n\n" + responsables);
        }

        if (respon.length > 0) {
            $2("idUsuario").innerHTML = respon[0][0];
            $2("nombre").innerHTML = respon[0][1];
            $2("apellido1").innerHTML = respon[0][2];
            $2("apellido2").innerHTML = respon[0][3];
            $2("email").innerHTML = respon[0][5];
            $2("calle").innerHTML = respon[0][6];
            $2("sexo").innerHTML = respon[0][7];
            $2("fijo").innerHTML = respon[0][8];
            $2("movil").innerHTML = respon[0][9];
        }
    };

    $2("comunidad").appendChild(tr);
};


// BOTON FLOATING +
var button = document.createElement('button');
var i = document.createElement('i');

button.setAttribute('id', 'floating');
button.setAttribute('class', 'floating');
button.setAttribute("data-toggle", "modal");
button.setAttribute("data-target", "#myModal-añadirMiembroComunidad");

button.onclick = function () {
    $2("formComunidades").reset();
    $2("opcion").value = "INSERTAR";
    $2("nuevoMiembro").style.display = '';
    $2("actualizarMiembro").style.display = 'none';
    $2("letrero").innerHTML = "Añadir comunidad";
}
i.setAttribute('class', 'large material-icons');
i.innerHTML = 'add';
button.appendChild(i);
$2("comunidad").appendChild(button);

// BOTON AÑADIR
$2("nuevoMiembro").onclick = function () {
    var insertar = AJAXCall("12_crear_comunidad", "formComunidades");
    if (insertar) {
        GetModule("12_crear_comunidad", "main");
    } else {
        alert("ERROR, al insertar la comunidad");
    }
}

// BOTON ELIMINAR
$2("modalEliminar").onclick = function () {
    Eliminar = AJAXCall("12_crear_comunidad", "OPC=ELIMINAR&idComunidad=" + ID_COMUNIDAD);
    if (Eliminar) {
        GetModule("12_crear_comunidad", "main");
    } else {
        alert("ERROR, al eliminar el usuario");
    }
}

// BOTON ACTUALIZAR
$2("actualizarMiembro").onclick = function () {
    $2("opcion").value = "ACTUALIZAR";
    $2("idUsuario").value = ID_COMUNIDAD;
    var actualizar = AJAXCall("12_crear_comunidad", "formComunidades");
    if (actualizar) {
        GetModule("12_crear_comunidad", "main");
    } else {
        alert("ERROR, al actualizar la comunidad");
    }
}






