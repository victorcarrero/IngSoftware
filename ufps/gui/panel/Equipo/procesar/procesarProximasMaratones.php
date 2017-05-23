<?php

require_once '../../../controlador/Controlador.php';
$controlador = new Controlador();
session_start();
$arreglo = $controlador->listarMaratonesNoInscritas($_SESSION["equipo"]["usuario"]);
$codigo = "";
for ($index = 0; $index < count($arreglo); $index++) {
    $codigo.="<tr><td>" . $arreglo[$index]["nombre"] . "</td><td>" . $arreglo[$index]["fecha_inicio"] . "</td>"
            . "<td>" . $arreglo[$index]["hora_inicio"] . "</td><td>" . $arreglo[$index]["fecha_fin"] . "</td><td>" . $arreglo[$index]["hora_fin"] . "</td>"
            . "<td id='campo" . $index . "'><div class='ufps-tooltip'>"
            . "<a onclick='inscribirseMaraton(".$arreglo[$index]["id_evento"].",this)' id='". $index ."' "
            . "class='' href='#!'><image src='../../imagenes/agregar1.png'/></a>"
            . "<span class='ufps-tooltip-content-top'>inscribirse</span></div></td></tr>";
}
if (count($arreglo) == 0) {
    $codigo = '</tbody></table><br><image src="../../imagenes/lupaR.png"/>'
            . '<h3><b>No Se Encontraron Resultados</b></h3>';
}
echo $codigo;
$_SESSION["equipo"]["mostrar"] = $codigo;
header("Location:../proximasMaratones.php");
