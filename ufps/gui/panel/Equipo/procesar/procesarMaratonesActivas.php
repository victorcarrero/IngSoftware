<?php

require_once '../../../controlador/Controlador.php';
$controlador = new Controlador();
session_start();
$arreglo = $controlador->listarMaratonesActivasPorEquipo($_SESSION["equipo"]["usuario"]);
$codigo = "";
for ($index = 0; $index < count($arreglo); $index++) {
    $fecha = date("Y-m-d");
    $img = "<td id='campo" . $index . "'><div class='ufps-tooltip'>"
            . "<a onclick='ingresarMaraton(" . $arreglo[$index]["id_evento"] . ",this)' id='" . $index . "' href='#!'>"
            . "<image src='../../imagenes/ingresar5.png'/></a>"
            . "<span class='ufps-tooltip-content-top'>Ingresar</span></div></td>";
    $img2 = "<td id='campos" . $index . "'><div class='ufps-tooltip'>"
            . "<a onclick='eliminarSubscripcion(" . $arreglo[$index]["id_evento"] . ",this)' id='s" . $index . "'href='#!'>"
            . "<image src='../../imagenes/x.png'/></a>"
            . "<span class='ufps-tooltip-content-top'>Desuscribirse</span></div></td>";
    if ($arreglo[$index]["fecha_inicio"] > $fecha) {
        $img = "<td id='campo" . $index . "'><div class='ufps-tooltip'><image src='../../imagenes/ingresar6.png'/>"
                . "<span class='ufps-tooltip-content-top'>Todavia No</span></div></td>";
    }
    $codigo.="<tr><td>" . ($index + 1) . "</td><td>" . $arreglo[$index]["nombre"] . "</td><td>" . $arreglo[$index]["fecha_inicio"] . "</td>"
            . "<td>" . $arreglo[$index]["hora_inicio"] . "</td><td>" . $arreglo[$index]["fecha_fin"] . "</td><td>" . $arreglo[$index]["hora_fin"] . "</td>"
            . "" . $img2 . ""
            . "" . $img . ""
            . "</tr>";
}
if (count($arreglo) == 0) {
    $codigo = '</tbody></table><br><image src="../../imagenes/lupaR.png"/>'
            . '<h3><b>No Se Encontraron Resultados</b></h3>';
}
echo $codigo;
$_SESSION["equipo"]["mostrar"] = $codigo;
header("Location:../maratonesActivas.php");
