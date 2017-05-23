<?php
$id_evento=$_POST["id_evento"];
session_start();
$_SESSION["maraton"]=array("usuario"=>$id_evento,"estado"=>true,"mostrar"=>-1);
echo "1";