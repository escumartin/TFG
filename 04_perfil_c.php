var global = "";
// PARA MOSTRAR EL PERFIL DEL USUARIO
resPerfil = AJAXCall("04_perfil", "opcion=infoPerfil");
// RECOGO EL JSON QUE HA ESCUPIDO EL PHP
try { respuestaPerfil = JSON.parse(resPerfil); }
catch (e) { console.log(resPerfil); }
if (respuestaPerfil.Tipo == "RESPONSABLE") {
    $2("nombre").value = respuestaPerfil.Nombre;
    $2("nombre").disabled = false;
    $2("apellido1").value = respuestaPerfil.Apellido_1;
    $2("apellido1").disabled = false;
    $2("apellido2").value = respuestaPerfil.Apellido_2;
    $2("apellido2").disabled = false;
    $2("email").value = respuestaPerfil.correo;
    $2("direccion").value = respuestaPerfil.Direccion;
    $2("sexo").value = respuestaPerfil.Sexo;
    $2("sexo").disabled = false;
    $2("fijo").value = respuestaPerfil.Fijo;
    $2("fijo").disabled = false;
    $2("movil").value = respuestaPerfil.Movil;
    $2("comunidad").value = respuestaPerfil.Nº_comunidad;
} else if (respuestaPerfil.Tipo == "ADMIN") {
    $2("nombre").value = respuestaPerfil.Nombre;
    $2("nombre").disabled = false;
    $2("apellido1").value = respuestaPerfil.Apellido_1;
    $2("apellido1").disabled = false;
    $2("apellido2").value = respuestaPerfil.Apellido_2;
    $2("apellido2").disabled = false;
    $2("email").value = respuestaPerfil.correo;
    $2("direccion").value = respuestaPerfil.Direccion;
    $2("sexo").value = respuestaPerfil.Sexo;
    $2("sexo").disabled = false;
    $2("fijo").value = respuestaPerfil.Fijo;
    $2("fijo").disabled = false;
    $2("movil").value = respuestaPerfil.Movil;
    $2("comunidad").value = respuestaPerfil.Nº_comunidad;
} else {
    $2("nombre").value = respuestaPerfil.Nombre;
    $2("apellido1").value = respuestaPerfil.Apellido_1;
    $2("apellido2").value = respuestaPerfil.Apellido_2;
    $2("email").value = respuestaPerfil.correo;
    $2("direccion").value = respuestaPerfil.Direccion;
    $2("sexo").value = respuestaPerfil.Sexo;
    $2("fijo").value = respuestaPerfil.Fijo;
    $2("movil").value = respuestaPerfil.Movil;
    $2("comunidad").value = respuestaPerfil.Nº_comunidad;
}

$2("perfilUsuario").onsubmit = function () {
    event.preventDefault();
    // if ($2("movil").checkValidity() == false || $2("fijo").checkValidity() == false || $2("email").checkValidity() == false) {
    //     // $2("mensaje").innerHTML = "No se ha podido actualizar su perfil, por favor revise los campos.";
    //     // $2("activador").click();
    // } else {
    $2("opcion").value = "ACTUALIZAR";
    var actualizarPerfil = AJAXCall("04_perfil", "perfilUsuario");
    if (actualizarPerfil) {
        $2("mensaje").innerHTML = "Tu perfil ha sido actualizado con <strong>éxito</strong>.";
        $2("activador").click();
        GetModule("04_perfil", "main");
    } else {
        alert("ERROR, al actualizar el perfil");
    }
    // }
    return false;
}

