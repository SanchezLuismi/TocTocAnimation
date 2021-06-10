<?php

require_once "_com/Varios.php";
if(intentarCanjearSesionCookie())
?>

<!DOCTYPE html>
<html lang="es">
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
                              <li class="nav-item active">
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
      <section class="banner_main">
         <div class="container">
            <div class="row d_flex">
               <div class="col-md-5">
                  <div class="text-bg">
                     <h1>Empresa de Eventos de Animacion Infantil y Juvenil</h1>
                     <p>Organiza una fiesta por todo lo alto con castillos hinchables, atracciones y mucho mas.</p>
                  </div>
               </div>
               <div class="col-md-7">
                  <div class="text-img">
                     <figure><div id="captioned-gallery">
                             <figure class="slider">
                                 <figure>
                                     <img src="img/img1.jpeg" alt>
                                 </figure>
                                 <figure>
                                     <img src="img/img2.png" alt>
                                 </figure>
                                 <figure>
                                     <img src="img/img3.jpeg" alt>
                                 </figure>
                                 <figure>
                                     <img src="img/img4.jpeg" alt>
                                 </figure>
                                 <figure>
                                     <img src="img/img5.jpeg" alt>
                                 </figure>
                             </figure>
                         </div></figure>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <div id="" class="hosting">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2> Nuestra oferta de actividades de ocio y tiempo libre</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="web_hosting">
                      <p>Organiza una fiesta, evento infantil o juvenil alquilando o contratando alguno de nuestros servicios. ¡Echa un vistazo a nuestro catálogo!
                      </p>
                      <p><a href="Reservas.php">Catálogo</a></p>
                      <div class="titlepage">
                          <h2> ¿Donde estamos?</h2>
                      </div>
                      <p>Tenemos la oficina en Ontígola (Castilla-La Mancha) aunque organizamos eventos de animación en toda la Comunidad de Madrid, Toledo, Cuenca y alrededores.
                          Todo lo que necesitas para organizar eventos infantiles en Madrid. Toc Toc Animación tiene una experiencia de 15 años como animadores infantiles, con muchísimo material propio, por lo que el evento saldrá mucho más barato, ya que no dependemos de terceros. ¿Organizamos una fiesta?
                      </p>
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3056.7449998080892!2d-3.5892739332157153!3d39.99180359583126!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42061968510ba7%3A0xf8fe6f90e438795f!2sCalle%20Caset%C3%B3n%2C%2022%2C%2045340%20Ont%C3%ADgola%2C%20Toledo!5e0!3m2!1ses!2ses!4v1622909740755!5m2!1ses!2ses" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <footer>
         <div class="footer">
            <div class="container">

               <div class="col-md-10 offset-md-1">
                     <div class="cont">
                         <img src="img/logo.png" alt="#" />
                        <h3>Team Building</h3>
                         <br />
                        <p>
                            Si lo que buscas es un evento corporativo para mejorar cualquier aspecto de tu empresa accede a nuestra sección especialmente enfocada a empresas.
                        </p>
               </div>
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
    
      </footer>
   </body>
</html>

