<?php

require_once "_com/DAO.php";

// Esto es la v0.8.
//echo '{"id":1,"nombre":"piratas",dimensiones:"150x160x180",tipo:2,descripcion:"hola"}';

// Esto es la v0.9 (está hecha OK).
//$hinchable = DAO::hinchableObtenerPorId(1);


// TODO Esto es la v1.0:
$hinchables = DAO::tipoObtenerTodas();
echo json_encode($hinchables);

?>