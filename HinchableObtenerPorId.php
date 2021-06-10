<?php
require_once "_com/Varios.php";
require_once "_com/DAO.php";

$idHinchable = $_REQUEST["id"];

if(isset($_REQUEST["comprobarFecha"])){
    $fecha=$_REQUEST["fecha"];

    $boolean=DAO::hinchableObtenerPorIdFecha($idHinchable,$fecha);
    echo json_encode($boolean);

}else{
    $hinchable = DAO::hinchableObtenerPorId($idHinchable);
    echo json_encode($hinchable);
}

