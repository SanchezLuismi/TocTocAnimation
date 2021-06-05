<?php

require_once "_com/DAO.php";

// Esto es la v0.8.
//echo '{"id":1,"nombre":"piratas",dimensiones:"150x160x180",tipo:2,descripcion:"hola"}';

// Esto es la v0.9 (está hecha OK).
//$hinchable = DAO::hinchableObtenerPorId(1);
if(isset($_REQUEST["tipo"])){
    $tipo=$_REQUEST["tipo"];
}else{
    $tipo=null;
}

if(isset($_REQUEST["precioMenor"])){
    $precioMenor =$_REQUEST["precioMenor"];
}else{
    $precioMenor=null;
}

if(isset($_REQUEST["precioMayor"])){
    $precioMayor =$_REQUEST["precioMayor"];
}else{
    $precioMayor=null;
}

if(isset($_REQUEST["dAnchura"])){
    $dAnchura =$_REQUEST["dAnchura"];
}else{
    $dAnchura = null;
}

if(isset($_REQUEST["dAltura"])){
    $dAltura = $_REQUEST["dAltura"];
}else{
    $dAltura = null;
}

if(isset($_REQUEST["dLargo"])){
    $dLargo = $_REQUEST["dLargo"];
}else{
    $dLargo = null;
}

if($dAnchura !="" && $dAltura !="" && $dLargo !=""){
    $dimensiones=$dAnchura."X".$dAltura."X".$dLargo;
}else{
    $dimensiones=null;
}


// TODO Esto es la v1.0:
if(($tipo == null && $dimensiones == null && $precioMayor ==null && $precioMenor ==null) || ($tipo == "" && $dimensiones == null && $precioMayor =="" && $precioMenor =="")){
    $hinchables = DAO::hinchableObtenerTodas();
}else if(($tipo != null && $dimensiones == null && $precioMayor ==null && $precioMenor ==null)|| ($tipo != "" && $dimensiones == null && $precioMayor =="" && $precioMenor =="")){
    $hinchables = DAO::hinchableObtenerPorTipo($tipo);
}else if(($precioMayor !=null && $precioMenor !=null && $dimensiones == null && $tipo ==null)|| ($tipo == "" && $dimensiones == null && $precioMayor !="" && $precioMenor !="")){
    $hinchables = DAO::hinchableObtenerPorPrecio($precioMayor,$precioMenor);
}else if(($precioMayor ==null && $precioMenor ==null && $dimensiones != null && $tipo ==null)|| ($tipo == "" && $dimensiones != null && $precioMayor =="" && $precioMenor =="")){
    $hinchables = DAO::hinchableObtenerPorDimensiones($dimensiones);
}else{
    $hinchables = DAO::hinchableObtenerPorParametros($tipo,$dimensiones,$precioMayor,$precioMenor);
}

echo json_encode($hinchables);

?>
