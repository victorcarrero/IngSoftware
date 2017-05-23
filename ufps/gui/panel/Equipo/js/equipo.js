
var pos = 1;
var posD = 1;
var ajax;
var error = "divError";
var tiempo = 5000;
var participante = "participantes";
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
    noti.style.top = ((window.innerHeight - 80)) + "px";
    noti.style.left = ((window.innerWidth / 2) - 150) + "px";
    noti.className = "ufps-alert ufps-alert-" + tipo;
    document.getElementById("mensaje").innerHTML = mensaje;
    setTimeout(function () {
        noti.style.display = "none";
        console.log("quita clase");
    }, 3000);
}


function registrarEquipo() {
    var usuario = document.getElementById("usuario").value;
    var nombre = document.getElementById("nombre").value;
    var contraseña1 = document.getElementById("contraseña1").value;
    var contraseña2 = document.getElementById("contraseña2").value;
    registrarEquipoAjax(usuario, nombre, contraseña1, "divError");
}
function registrarEquipoAjax(usuario, nombre, contraseña, campo) {
    aleatorio = Math.random();
    ajax = nuevoAjax();
    parametros = "usuario=" + usuario + "&nombre=" + nombre + "&contraseña=" + contraseña + "&aleatorio=" + aleatorio;
    url = "procesar/procesarRegistroEquipo.php";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var rta = ajax.responseText;
            if (rta.indexOf("1") >= 0) {
                formularioEquipo.action = "../visualizar/visualizarRankingGeneral.php";
                formularioEquipo.submit();
            } else {
                notification("una cuenta con ese identificador ya ha sido creada", tiempo);
            }
        } else {
            notification("cargando...........", tiempo);
        }
    }
}
function actualizarEquipo() {
    var nombre = document.getElementById("nombre").value;
    var contraseña1 = document.getElementById("contraseña1").value;
    var contraseña2 = document.getElementById("contraseña2").value;
    actualizarEquipoAjax(nombre, contraseña1, "divError");
}
function actualizarEquipoAjax(nombre, contraseña, campo) {
    aleatorio = Math.random();
    ajax = nuevoAjax();
    parametros = "nombre=" + nombre + "&contraseña=" + contraseña + "&aleatorio=" + aleatorio;
    url = "procesar/procesarActualizarEquipo.php";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText.indexOf("1") >= 0) {
                formulario.action = "Ajustes.php";
                formulario.submit();
                notification("datos actualizados", "green");
            } else {
                notification("los datos no se pudieron actualizar", "red");
            }
        } else {
            notification("cargando........", "yellow");
        }
    }
}

function direccionRegistrarParticipante() {
    formulario.action = "registrarParticipante.php";
    formulario.submit();
}
function registrarParticipante() {
    var nombre = document.getElementById("nombre").value;
    var apellido = document.getElementById("apellido").value;
    var codigo = document.getElementById("codigo").value;
    var correo = document.getElementById("correo").value;
    registrarParticipanteAjax(nombre, apellido, codigo, correo, "divError");
}
function registrarParticipanteAjax(nombre, apellido, codigo, correo, campo) {
    aleatorio = Math.random();
    ajax = nuevoAjax();
    parametros = "nombre=" + nombre + "&apellido=" + apellido + "&codigo=" + codigo + "&correo=" + correo + "&aleatorio=" + aleatorio;
    url = "procesar/procesarRegistroParticipante.php";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText.indexOf("1") >= 0) {
                formulario.action = "Ajustes.php";
                formulario.submit();
                notification("Registro exitoso", "green");
            } else {
                notification("no se pudo registrar a ese participante", "red");
            }
        } else {
            notification("cargando...............", "yellow");
        }
    }
}
function eliminarParticipante(codigo, obj) {
    aleatorio = Math.random();
    ajax = nuevoAjax();
    parametros = "codigo=" + codigo + "&aleatorio=" + aleatorio;
    url = "procesar/procesarEliminarParticipante.php";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText.indexOf("1") >= 0) {
                formulario.action = "Ajustes.php";
                formulario.submit();
                notification("participante eliminado", "green");
            } else {
                notification("no se pudo eliminar el participante", "red");
            }
        } else {
            notification("eliminado.................", "yellow");
        }
    }
}
function inscribirseMaraton(id_evento, obj) {
    aleatorio = Math.random();
    ajax = nuevoAjax();
    parametros = "id_evento=" + id_evento + "&aleatorio=" + aleatorio;
    url = "procesar/procesarInscribirseMaraton.php";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var res = ajax.responseText;
            if (res.indexOf("1") >= 0) {
                formulario.action = "proximasMaratones.php";
                formulario.submit();
                notification("maraton inscrita", "green");
            } else {
                notification("no se puede inscribir en la maraton", "red");
            }
        } else {
            notification("cargando............", "yellow");
        }
    }
}
function ingresarMaraton(id_evento, obj) {
    aleatorio = Math.random();
    ajax = nuevoAjax();
    parametros = "id_evento=" + id_evento + "&aleatorio=" + aleatorio;
    url = "procesar/procesarIngresarMaraton.php";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText.indexOf("1") >= 0) {
                formulario.action = "../Maraton/maraton.php";
                formulario.submit();
            } else {
                notification("no se puede ingresar en la maraton", "red");
            }
        } else {
            notification("entrando...............", "yellow");
        }
    }
}
function eliminarSubscripcion(id_evento, obj) {
    aleatorio = Math.random();
    ajax = nuevoAjax();
    parametros = "id_evento=" + id_evento + "&aleatorio=" + aleatorio;
    url = "procesar/procesarEliminarSubscripcion.php";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText.indexOf("1") >= 0) {
                formulario.action = "maratonesActivas.php";
                formulario.submit();
                notification("subscripcion anulada", "green");
            } else {
                notification("no se pudo desuscribir de la maraton", "red");
            }
        } else {
            notification("desuscribiendo..................", "yellow");
        }
    }
}

function actualizarParticipante(id_participante, obj) {
    var nombre = document.getElementById("nombre_" + id_participante).value;
    var apellido = document.getElementById("apellido_" + id_participante).value;
    var codigo = document.getElementById("codigo_" + id_participante).value;
    var correo = document.getElementById("correo_" + id_participante).value;
    actualizarParticipanteAjax(nombre, apellido, codigo, correo, id_participante).value;
}
function actualizarParticipanteAjax(nombre, apellido, codigo, correo, id_participante) {
    aleatorio = Math.random();
    ajax = nuevoAjax();
    parametros = "nombre=" + nombre + "&apellido=" + apellido + "&codigo=" + codigo + "&correo=" + correo + "&id=" + id_participante + "&aleatorio=" + aleatorio;
    url = "procesar/procesarActualizarParticipante.php";
    ajax.open("POST", url, true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    ajax.send(parametros);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            if (ajax.responseText.indexOf("1") >= 0) {
                notification("Actualizacion exitosa", "green");
            } else {
                notification("no se pudo actualizar el participante", "red");
            }
        } else {
            notification("cargando...............", "yellow");
        }
    }


}