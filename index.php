<?php
include_once('controller/controlIndex.php');  
include_once('controller/ControlDashboard.php');  
include_once('controller/ControlDepartamento.php');  
include_once('controller/ControlEdificio.php');  
include_once('controller/ControlMascota.php');  
include_once('controller/ControlOcupante.php');  
include_once('controller/ControlPropietario.php');

//PARA LOS CARACTERES EXTRAÑOS
header('Content-Type: text/html; charset=utf-8');

//ZONA DE HORARIO
date_default_timezone_set("America/Lima");

//VARIABLES CONTROLADORES
$controlIndex = new ControlIndex();
$ControlDashboard = new ControlDashboard();
$controlDepartamento = new controlDepartamento();
$ControlEdificio = new ControlEdificio();
$ControlMascota = new ControlMascota();
$ControlOcupante = new ControlOcupante();
$ControlPropietario = new ControlPropietario();

//LLAMADA DE LOS METODOS
if (!isset($_REQUEST['ruta'])) {
    $controlIndex->Index();
} else {
    $peticion = $_REQUEST['ruta'];
    if (method_exists($controlIndex, $peticion)) {
        call_user_func(array($controlIndex, $peticion));
    }elseif(method_exists($ControlDashboard, $peticion)) {
        call_user_func(array($ControlDashboard, $peticion));
    }elseif(method_exists($controlDepartamento, $peticion)) {
        call_user_func(array($controlDepartamento, $peticion));
    }elseif(method_exists($ControlEdificio, $peticion)) {
        call_user_func(array($ControlEdificio, $peticion));
    }elseif(method_exists($ControlMascota, $peticion)) {
        call_user_func(array($ControlMascota, $peticion));
    }elseif(method_exists($ControlOcupante, $peticion)) {
        call_user_func(array($ControlOcupante, $peticion));
    }elseif(method_exists($ControlPropietario, $peticion)) {
        call_user_func(array($ControlPropietario, $peticion));
    }else{
        $controlIndex->Index();
    }
}


