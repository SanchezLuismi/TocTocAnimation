<?php
require_once "_com/Varios.php";
require_once "_com/DAO.php";

$idHinchable = $_REQUEST["id"];

$hinchable = DAO::hinchableObtenerPorId($idHinchable);

echo json_encode($hinchable);