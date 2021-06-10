<?php

require_once "_com/Varios.php";
if (!haySesionRamIniciada()) redireccionar("index.php");
$id=$_SESSION["id"];
$nombre=$_SESSION["nombre"];
$apellidos=$_SESSION["apellidos"];
$identificador=$_SESSION["identificador"];
$telefono=$_SESSION["telefono"] ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Toc Toc Animación</title>
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/carrusel.css">
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="js/ScriptsPerfil.js"></script>
    <script src="js/ConexionPHP.js"></script>
</head>
<body class="main-layout">
<header>
    <div class="header">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                    <div class="full">
                        <div class="center-desk">
                            <div class="logo">
                                <a href="index.php"><img src="img/logo.png" alt="#" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
                    <nav class="navigation navbar navbar-expand-md navbar-dark ">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarsExample04">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Reservas.php"> Catálogo  </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Contacto.php"> Contacto</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="Carrusel.php">Carrusel de imágenes</a>
                                </li>
                                <li class="nav-item">
                                    <?php pintarInfoSesion(); ?>
                                </li>
                                <li class="nav-item">
                                    <?php pintarCerrarSesion(); ?>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<div id="" class="hosting">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Datos del usuario</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="web_hosting">
                    <input type="hidden" id="usuId" value="<?= $id ?>"></h4>
                    <h4>Nombre: <input type="text" id="usuNombre" value="<?= $nombre ?>" readonly> </h4>
                    <h4>Apellidos: <input type="text" id="usuApellidos" value="<?= $apellidos ?>"readonly> </h4>
                    <h4>Identificador: <input type="text" id="usuIdentificador" value="<?= $identificador ?>"readonly></h4>
                    <h4>Teléfono: <input type="text" id="usuTelefono" value="<?= $telefono ?>"readonly></h4><br />
                    <button id="cambioDatos">Editar mis datos</button><br />
                    <button id="guardarDatos" class="divReserva">Guardar datos</button><br /> <br />
                    <button id="mostarCambioPass">Cambiar contraseña</button><br />
                    <div id="mostrarPass" class="divReserva">
                        <h4>Contraseña:  <input type="text" id="usuPassword" onchange="comprobarPassword()"></h4><br />
                        <button id="guardarPass">Guardar contraseña</button>
                    </div>
                    <h6><button id="mostarReservas">Mostrar mis reservas</button></h6>
                    <div id="reservas" class="divReserva">
                        <table id="tablaReservas" class="tablaReserva" border="1">
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Direccion</th>
                                <th>Ciudad</th>
                                <th>Hora inicio</th>
                                <th>Hora final</th>
                                <th>Precio</th>
                                <th></th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container filtro">

</div>


</body>
</html>
