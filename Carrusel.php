<?php

require_once "_com/Varios.php";

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
                                <li class="nav-item active">
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
<div class="container filtro">
    <div id="captioned-gallery">
        <figure class="slider">
            <figure>
                <img src="img/img1.jpeg" alt>
            </figure>
            <figure>
                <img src="img/hinch23.jpg" alt>
            </figure>
            <figure>
                <img src="img/img3.jpeg" alt>
            </figure>
            <figure>
                <img src="img/hinch21.jpg" alt>
            </figure>
            <figure>
                <img src="img/img5.jpeg" alt>
            </figure>
        </figure>
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
