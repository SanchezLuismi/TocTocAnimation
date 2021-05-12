<?php


require_once "_com/DAO.php";



// TODO Esto es la v1.0:
$hinchables = DAO::hinchableObtenerPorParametros(1, "");
echo json_encode($hinchables);
?>