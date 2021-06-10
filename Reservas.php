<?php

    require_once "_com/Varios.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <!-- site metas -->
    <title>Reservas</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/js/lightbox.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.10.0/css/lightbox.css" rel="stylesheet"/>
    <script src="js/ScriptsReservas.js"></script>
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
                                <li class="nav-item active">
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
<br />

<body>
<div id="" class="hosting">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <h2>Catálogo</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="web_hosting">
                    <div id="divFiltros" class="">
                    <h4>Filtros para buscar:</h4>
                    <p>
                        <label>Tipo: </label><select name="tipo" id="tipo" class="">
                            <option value=""></option>
                        </select>
                        <label>Precio mínimo:</label><input type='number' id='precioMenor'/> <label>Precio máximo:</label><input type='number' id='precioMayor'/>
                    </p>
                    <p>
                        <label>Dimensiones (en metros): </label><br />
                        <label>Anchura:</label><input type='number' id='dAnchura'/>
                        <label>Altura: </label><input type='number' id='dAltura'/>
                        <label>Largo: </label><input type='number' id='dLargo'/>
                    </p>
                        <button id='btnFiltros'>Buscar</button>

                    </div>
                <br />
                <div id="divReserva">
                    <table id="tablaReserva" class="tablaReserva" border="1">
                        <tr>
                            <th>Imagen</th>
                            <th>Nombre</th>
                            <th>Dimensiones en metros (ancho x altura x largo)</th>
                            <th>Tipo</th>
                            <th>Descripción</th>
                            <th>Precio (4 horas con monitor)</th>
                            <th>Precio (día completo sin monitos)</th>
                            <th></th>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="footer">
    <div class="container">
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Copyright © 2021 Toc Toc Animación</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>