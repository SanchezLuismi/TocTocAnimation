<?php

require_once "_com/DAO.php";

$id=$_REQUEST["id"];

// TODO Esto es la v1.0:
$hinchables = DAO::reservaObtenerPorUsuario($id);
echo json_encode($hinchables);
?>
