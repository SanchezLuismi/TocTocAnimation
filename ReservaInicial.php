<?php
require_once "_com/Varios.php";
require_once "_com/DAO.php";

$idHinchable = $_REQUEST["idHinchable"];

$_SESSION["hinchable"]=$idHinchable;
if(!haySesionRamIniciada()){
    redireccionar("SesionInicioFormulario.php?Reserva");
}else{
    redireccionar("ReservaFinal.php?id=".$idHinchable);
}

