
<?php
require_once "_com/DAO.php";
require_once "_com/Varios.php";



if(isset($_REQUEST["GuardarPass"])){
    $contrasenna = $_REQUEST["contrasenna"];
    $id = $_REQUEST["id"];

    $usuario = DAO::usuarioActualizarPasswd($contrasenna,$id);
    if($usuario){
        establecerSesionRam($usuario);
    }else{
        $usuario=null;
    }
    echo json_encode($usuario);

}else if(isset($_REQUEST["guardarUsu"])){
    $apellidos = $_REQUEST["apellidos"];
    $identificador = $_REQUEST["identificador"];
    $telefono = $_REQUEST["telefono"];
    $nombre = $_REQUEST["nombre"];
    $id = $_REQUEST["id"];

    $usuario = DAO::usuarioActualizar($nombre,$apellidos,$telefono,$identificador,$id);

    if($usuario){
        establecerSesionRam($usuario);
    }else{
        $usuario=null;
    }

    echo json_encode($usuario);

}else{
    $nombre = $_REQUEST["nombre"];
    $apellidos = $_REQUEST["apellidos"];
    $telefono = $_REQUEST["telefono"];
    $identificador = $_REQUEST["identificador"];
    $contrasenna = $_REQUEST["contrasenna"];
    if (isset($_REQUEST["nombre"])        && isset($_REQUEST["apellidos"]) &&
        isset($_REQUEST["identificador"]) && isset($_REQUEST["contrasenna"])){
        //validamos si los campos introducidos son vacíos o no (se debe hacer una validación mejor)
        if ($_REQUEST["nombre"]=="" || $_REQUEST["nombre"]==null) {
            redireccionar("UsuarioNuevoCrear.php");
        } else {
            $nombre=$_REQUEST["nombre"];
        }
        if ($_REQUEST["apellidos"]=="" || $_REQUEST["apellidos"]==null) {
            redireccionar("UsuarioNuevoCrear.php");
        } else {
            $apellidos=$_REQUEST["apellidos"];
        }
        if ($_REQUEST["identificador"]=="" || $_REQUEST["identificador"]==null) {
            redireccionar("UsuarioNuevoCrear.php");
        } else {
            $identificador=$_REQUEST["identificador"];
        }
        if ($_REQUEST["contrasenna"]=="" || $_REQUEST["contrasenna"]==null) {
            redireccionar("UsuarioNuevoCrear.php");
        } else {
            $contrasenna=$_REQUEST["contrasenna"];
        }
        DAO::usuarioCrear($nombre, $apellidos, $identificador, $contrasenna);
        redireccionar("SesionInicioMostrarFormulario.php");
    } else {
        redireccionar("UsuarioNuevoCrear.php");
    }
}



