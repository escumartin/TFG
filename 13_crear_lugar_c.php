var ID_LUGAR = "";

// RECOJO EL LISTADO DE LOS LUGARES
var respuestaComu = AJAXCall("13_crear_lugar", "OPC=LISTADO");
try {
    var resp = eval(respuestaComu);
}
catch (e) {
    console.log("ERROR COMUNIDADES:\n\n" + respuestaComu);
}

$2("MenuTitulo").innerHTML = "Lugares";

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

    th1.innerHTML = resp[i][1];     // NOMBRE LUGAR
    th2.innerHTML = "";

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
        ID_LUGAR = resp[id][0];
        $2("letrero").innerHTML = "Actualizar lugar";
        $2("nuevoMiembro").style.display = 'none';
        $2("actualizarMiembro").style.display = '';
        $2("opcion").value = "ACTUALIZAR";
        $2("idUser").value = ID_LUGAR;
        $2("activador2").click();

        var respuestaComu = AJAXCall("13_crear_lugar", "OPC=DATOS_ACTUALIZAR&ID_lugar=" + ID_LUGAR);
        try {
            var resp2 = eval(respuestaComu);
        }
        catch (e) {
            console.log("ERROR COMUNIDAD:\n\n" + respuestaComu);
        }

        // MUESTRO LOS DATOS DEL LUGAR EN EL FORMULARIO
        $2("nombreLugar").value = resp2[0][1];
        ev = e || event;
        ev.stopPropagation();
    }

    // BOTON PAPELERA  
    bDel.onclick = function (e) {
        var id = this.getAttribute("id-user");
        $2("eliminado").innerHTML = resp[id][1];
        ID_LUGAR = resp[id][0];
        $2("activador").click();
        ev = e || event;
        ev.stopPropagation();
    }
    th2.appendChild(div3);

    tr.appendChild(th1);
    tr.appendChild(th2);

    tr.style.cursor = "pointer";
    tr.setAttribute("idComu", resp[i][0]);

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
    $2("formLugar").reset();
    $2("opcion").value = "INSERTAR";
    $2("nuevoMiembro").style.display = '';
    $2("actualizarMiembro").style.display = 'none';
    $2("letrero").innerHTML = "Añadir lugar";
}
i.setAttribute('class', 'large material-icons');
i.innerHTML = 'add';
button.appendChild(i);
$2("comunidad").appendChild(button);

// BOTON AÑADIR
$2("nuevoMiembro").onclick = function () {
    var insertar = AJAXCall("13_crear_lugar", "formLugar");
    if (insertar) {
        GetModule("13_crear_lugar", "main");
    } else {
        alert("ERROR, al insertar la comunidad");
    }
}

// BOTON ELIMINAR
$2("modalEliminar").onclick = function () {
    Eliminar = AJAXCall("13_crear_lugar", "OPC=ELIMINAR&ID_lugar=" + ID_LUGAR);
    if (Eliminar) {
        GetModule("13_crear_lugar", "main");
    } else {
        alert("ERROR, al eliminar el usuario");
    }
}

// BOTON ACTUALIZAR
$2("actualizarMiembro").onclick = function () {
    $2("opcion").value = "ACTUALIZAR";
    var actualizar = AJAXCall("13_crear_lugar", "formLugar");
    if (actualizar) {
        GetModule("13_crear_lugar", "main");
    } else {
        alert("ERROR, al actualizar la comunidad");
    }
}






