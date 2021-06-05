<?php
session_start();
require_once "_com/Varios.php";
require_once "_com/DAO.php";


$arrayUsuario = DAO::usuarioObtenerPorIdentificadoryPassword($_REQUEST["identificador"], $_REQUEST["contrasenna"]);

if ($arrayUsuario->getId()) { // Identificador existía y contraseña era correcta.
    establecerSesionRam($arrayUsuario);

    if (isset($_REQUEST["recordar"])) {
        establecerSesionCookie($arrayUsuario);
    }

    if(isset($_REQUEST["Reserva"]) && isset($_SESSION["hinchable"])){
        redireccionar("ReservaFinal.php?id=". $_SESSION["hinchable"]);
    }else{
        redireccionar("index.php");
    }
} else {
   redireccionar("SesionInicioFormulario.php?datosErroneos");
}