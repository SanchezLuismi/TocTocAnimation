<?php
require_once "_com/Varios.php";
require_once "_com/DAO.php";

$id = $_REQUEST["id"];

$dev = DAO::reservaEliminarPorId($id);

echo json_encode($dev);

