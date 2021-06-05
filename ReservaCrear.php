<?php


require_once "_com/DAO.php";

// Esto es la v0.8.
//echo '{"id":1,"nombre":"piratas",dimensiones:"150x160x180",tipo:2,descripcion:"hola"}';

// Esto es la v0.9 (está hecha OK).
//$hinchable = DAO::hinchableObtenerPorId(1);
$idUsuario =$_SESSION["id"];
$fecha =$_REQUEST["fecha"];
$idHinchable = $_REQUEST["idHinchable"];
$direccion = $_REQUEST["direccion"];
$localidad = $_REQUEST["localidad"];
$codPostal = $_REQUEST["codPostal"];
$precio = $_REQUEST["precio"];
$horaInicial = $_REQUEST["horaInicial"];
$horaFinal = $_REQUEST["horaFinal"];

if($_REQUEST["monitor"] == "S"){
    $monitor=1;
}else{
    $monitor=0;
}

// TODO Esto es la v1.0:
$hinchables = DAO::reservaCrear($idUsuario,$idHinchable,$fecha,$direccion,$localidad,$codPostal,$precio,$monitor,$horaInicial,$horaFinal);
//$hinchables = DAO::reservaCrear(1,16,"2021-06-03","Calle Zorzales 19a 3b","Aranjuez","28300",150 ,1,"10:00","14:00");

if($hinchables){
    redireccionar("index.php");
}else{
    redireccionar("ReservaFinal.php?Error");
}

//echo json_encode($hinchables);


