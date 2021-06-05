<?php

require_once "_com/DAO.php";

$id=$_REQUEST["id"];

// TODO Esto es la v1.0:
$usuario = DAO::usuarioObtenerPorId($id);
echo json_encode($usuario);
?>
