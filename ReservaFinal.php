<?php

require_once "_com/Varios.php";

if(!haySesionRamIniciada()) redireccionar("SesionInicioFormulario.php?Reserva");
$datosErroneos = isset($_REQUEST["datosErroneos"]);
$idHinchable = $_REQUEST["id"];
$telefono = $_SESSION["telefono"];
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
    <script src="js/ConexionPHP.js"></script>
    <script src="js/ScriptsReservaFinal.js"></script>
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
                    <h2>Reserva Final</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="web_hosting">
                    <?php if ($datosErroneos) { ?>
                        <p style='color: red;'>No se ha podido reservar por algun fallo. Inténtelo de nuevo.</p>
                    <?php } ?>
                    <table id="tablaHinchable" class="tablaReserva" border="1">
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Dimensiones</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Precio (4 horas con monitor)</th>
                            <th>Precio (día completo sin monitor)</th>
                        </tr>
                    </table>
                    <form action="ReservaCrear.php" method="post">
                        <h4>Opciones de la reserva</h4>
                        <label>Opciones</label><br/>
                        <input type="Radio" name="opciones" id ="monitor" value="monitor" onchange="cargarPrecio()"> 4 Horas con monitor
                        <input type="Radio" name="opciones" id="completo" value="completo" onchange="cargarPrecio()"> Día completo sin monitor
                        <br />
                        Precio: <input type="text" id="precio" name ="precio" readonly required><br />
                        Fecha: <input type="date" id='fecha' name="fecha" required onchange="comprobarFecha()"/>
                        Hora inicio: <input type="time" name="horaInicial" id='horaInicial' onchange="calcularHora()" required/>
                        Hora final: <input type="time" name="horaFinal" id='horaFinal'/>
                        <br />
                        Telefono : <input type="text" id="telefono" name ="telefono" value="<?=$telefono?>" readonly><br />
                        Dirección: <input type="text" id="direccion" name ="direccion" required><br />
                        Localidad: <input type="text" id="localidad" name ="localidad" required><br />
                        Código Postal : <input type="text" id="codPostal" name ="codPostal" required><br />
                        <input type="hidden" name="idHinchable" id="idHinchable" value="<?=$idHinchable?>">
                        <input type="hidden" name="monitor" id="control">
                        <input type='submit' value='Reservar'>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container filtro">



</div>


</body>
</html>