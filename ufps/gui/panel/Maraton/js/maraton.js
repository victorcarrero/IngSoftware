
var pos = 1;
var posD = 1;
var ajax;
var error = "divError";
var participante = "participantes";
var tiempo = 5000;

/* Crea el objeto AJAX. Esta funcion es generica para cualquier utilidad de este tipo, por
 lo que se puede copiar tal como esta aqui */
function nuevoAjax() {
    var xmlhttp = false;
    try {
        // Creacion del objeto AJAX para navegadores no IE Ejemplo:Mozilla, Safari 
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            // Creacion del objet AJAX para IE
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
                xmlhttp = new XMLHttpRequest();
        }
    }
    return xmlhttp;
}
function notification(mensaje, tipo) {
    var noti = document.getElementById("notificacion");
    noti.style.display = "block";
    noti.style.top = ((window.innerHeight - 60)) + "px";
    noti.style.left = ((window.innerWidth / 2) - 150) + "px";
    noti.className = "ufps-alert ufps-alert-" + tipo;
    document.getElementById("mensaje").innerHTML = mensaje;
    setTimeout(function () {
        noti.style.display = "none";
        console.log("quita clase");
    }, 3000);
}

function enviarEjercico() {
    var ejercicio = document.getElementById("ejercicio").value;
    var solucion = document.getElementById("solucion").value;
    enviarEjercicioAjax(ejercicio, solucion, "divError");
}

function enviarEjercicioAjax(ejercicio, solucion, campo) {
    aleatorio = Math.random();
    ajax = nuevoAjax();
    parametros = "ejercicio=" + ejercicio + "&solucion=" + solucion + "&aleatorio=" + aleatorio;
    url = "procesar/procesarEnviarEjercicio.php";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var rta = ajax.responseText;
            alert(rta);
            if (rta.indexOf("1") >= 0) {
                formulario.action = "enviarEjercicio.php";
                formulario.submit();
                notification("ejercicio enviado", "green");
            } else {
                notification("nose pudo enviar la solucion", "red");
            }
        } else {
            notification("cargando.............", "yellow");
        }
    }
}
function abrirVentana() {
    window.open('../Maraton/Problemas.php');
}

