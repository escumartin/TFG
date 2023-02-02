function $2(id) {
    return document.getElementById(id);
}

function AJAXCall(module, formId) {
    var m = module + "_m.php";

    var f, i, data, pair, postData = "";
    if ((f = $2(formId)) && (data = new FormData($2(formId)))) {
        if (data.entries) {
            // para chrome y firefox
            for (pair of data.entries())
                postData += pair[0] + "=" + encodeURIComponent(pair[1]) + "&"; // encodeURIComponent -> scape de caracteres como '+' y otros
        } else {
            // para edge, explorer, safari, opera, ...
            postData = GetDataForm(f);
        }
    } else
        postData = formId;

    ajaxM = new XMLHttpRequest();
    ajaxM.open("POST", m, false);
    ajaxM.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxM.send(postData);
    return ajaxM.responseText;
}


var VAL_VERDADERO = '1';
var VAL_FALSO = '0';

function GetDataForm(f) {
    if (!f)
        return "";

    var i, j, x;
    var cad = "";
    var val;
    var radioNom = "";

    for (i = 0; i < f.length; i++) {
        x = f.elements[i];
        if (typeof (x.name) != "undefined" && x.name.length > 0) {
            switch (x.type) {
                case "text":
                case "password":
                case "hidden":
                case "textarea":
                    val = x.value.trim();
                    break;

                case "select-one":
                    if (x.options.length > 0 && x.selectedIndex >= 0 && x.selectedIndex < x.options.length)
                        val = (x.options[x.selectedIndex].value) ?
                            x.options[x.selectedIndex].value : x.options[x.selectedIndex].text;
                    else
                        val = "__NO__VAL__";
                    break;

                case "checkbox":
                    val = (x.checked) ? VAL_VERDADERO : VAL_FALSO;
                    break;

                case "radio":
                    val = "";
                    if (radioNom != x.name) {
                        radioNom = x.name;
                        j = 0;
                        while (f.elements[radioNom][j] && val == "") {
                            if (f.elements[radioNom][j].checked)
                                val = f.elements[radioNom][j].value;
                            j++;
                        }
                    }
                    break;

                default: //case "button": case "reset": case "submit": case "file":
                    val = "__NO__VAL__";
                    break;
            }

            if (val != "__NO__VAL__") {
                if (val != "") {
                    if (cad != "")
                        cad += "&";
                    cad += x.name + "=" + encodeURIComponent(val);
                }
            }
        }
    }
    return cad;
}

function GetModule(module, target) {
    var v = module + "_v.php"; // Nombre del fichero 'VISTA'
    var c = module + "_c.php"; // Nombre del fichero 'CONTROLADOR'
    var css = module + ".css"; // Nombre del CSS para esta vista
    var cssID = module; // ID del objeto para añadir el CSS al <head>

    // Carga del CSS para esta vista (opcional, se puede eliminar/comentar esta línea)
    // LoadCSS(css, cssID);

    // Carga la vista
    ajaxV = new XMLHttpRequest();
    ajaxV.open("POST", v, false);
    ajaxV.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxV.send();
    $2(target).innerHTML = ajaxV.responseText;

    // Carga del controlador
    ajaxC = new XMLHttpRequest();
    ajaxC.open("POST", c, false);
    ajaxC.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    ajaxC.send();
    eval(ajaxC.responseText);
}


function EmailOK(cad) {
    var arrPos, puntPos, str;
    arrPos = cad.indexOf("@");
    puntPos = cad.lastIndexOf(".");

    if (arrPos < 1 || arrPos != cad.lastIndexOf("@") || puntPos < arrPos || puntPos == (arrPos + 1) || puntPos < cad.length - 5 || puntPos > cad.length - 3)
        return 0;

    str = cad.substring(0, arrPos);
    if (!StrOK(str))
        return 0;

    str = cad.substring(arrPos + 1, puntPos);
    if (!StrOK(str))
        return 0;

    str = cad.substring(puntPos + 1);
    if (!StrOK(str))
        return 0;

    return 1;
}

function AMD2DMA(x) {
    // 2019-05-17 12:12:00
    if (x) {
        var a = x.substr(0, 4);
        var m = x.substr(5, 2);
        var d = x.substr(8, 2);
        var H = x.substr(11, 2);
        var M = x.substr(14, 2);

        return d + "/" + m + "/" + a + " " + H + ":" + M;
    }
    return false
}