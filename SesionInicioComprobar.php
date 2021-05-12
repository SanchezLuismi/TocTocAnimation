<?php
session_start();
require_once "_com/Varios.php";
require_once "_com/DAO.php";

$arrayUsuario = DAO::usuarioObtenerPorIdentificadoryPassword($_REQUEST["identificador"], $_REQUEST["contrasenna"]);

//$arrayUsuario = DAO::usuarioObtenerPorIdentificadoryPassword("jlopez", "j");

//print_r($arrayUsuario);

if ($arrayUsuario->getId()) { // Identificador existía y contraseña era correcta.
    establecerSesionRam($arrayUsuario);

   /* if (isset($_REQUEST["recordar"])) {
        establecerSesionCookie($arrayUsuario);
    }*/

     redireccionar("Reservas.php");
} else {
    redireccionar("SesionInicioFormulario.php?datosErroneos");
}