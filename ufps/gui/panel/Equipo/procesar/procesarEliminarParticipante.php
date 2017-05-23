<?php
require_once '../../../controlador/Controlador.php';
$codigo=$_POST["codigo"];
$controlador=new Controlador();
$mensaje="";
if($controlador->eliminarParticipante($codigo)){
    $mensaje="1";
}else{
    $mensaje="datos incorrectos";
}
echo $mensaje;