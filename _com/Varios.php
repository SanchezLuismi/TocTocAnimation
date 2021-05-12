<?php

require_once "Clases.php";
session_start();


// (Esta función no se utiliza en este proyecto pero se deja por si se optimizase el flujo de navegación.)
// Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}

function obtenerFecha(): string
{
    return date("Y-m-d H:i:s");
}

function establecerSesionRam(Usuario $arrayUsuario)
{
    // Anotar en el post-it como mínimo el id.
    $_SESSION["id"] = $arrayUsuario->getId();

    // Además, podemos anotar todos los datos que podamos querer tener a mano, sabiendo que pueden quedar obsoletos...
    $_SESSION["identificador"] = $arrayUsuario->getIdentificador();
    $_SESSION["tipoUsuario"] = $arrayUsuario->getTipoUsuario();
    $_SESSION["nombre"] = $arrayUsuario->getNombre();
    $_SESSION["apellidos"] = $arrayUsuario->getApellidos();
    $_SESSION["telefono"] = $arrayUsuario->getTelefono();
}

function haySesionRamIniciada(): bool
{
    // Está iniciada si isset($_SESSION["id"])
    return isset($_SESSION["id"]);
}

function borrarCookies()
{
    setcookie("identificador", "", time() - 3600); // Tiempo en el pasado, para (pedir) borrar la cookie.
    setcookie("codigoCookie", "", time() - 3600); // Tiempo en el pasado, para (pedir) borrar la cookie.}
}

function generarCadenaAleatoria(int $longitud): string
{
    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != $longitud; $x = rand(0,$z), $s .= $a[$x], $i++);
    return $s;
}

function intentarCanjearSesionCookie(): bool
{
    if (isset($_COOKIE["identificador"]) && isset($_COOKIE["codigoCookie"])) {
        $arrayUsuario = obtenerUsuarioPorCodigoCookie($_COOKIE["identificador"], $_COOKIE["codigoCookie"]);

        if ($arrayUsuario) {
            establecerSesionRam($arrayUsuario);
            establecerSesionCookie($arrayUsuario); // Para re-generar el numerito.
            return true;
        } else { // Venían cookies pero los datos no estaban bien.
            borrarCookies(); // Las borramos para evitar problemas.
            return false;
        }
    } else { // No vienen ambas cookies.
        borrarCookies(); // Las borramos por si venía solo una de ellas, para evitar problemas.
        return false;
    }
}

function pintarInfoSesion() {
    if (haySesionRamIniciada()) {
        echo "<span>Sesión iniciada por <a href='UsuarioPerfilVer.php'>$_SESSION[identificador]</a> ($_SESSION[nombre] $_SESSION[apellidos]) <a href='SesionCerrar.php'>Cerrar sesión</a></span>";
    } else {
        echo "<a href='SesionInicioFormulario.php'>Iniciar sesión</a>";
    }
}

function establecerSesionCookie(array $arrayUsuario)
{
    // Creamos un código cookie muy complejo (no necesariamente único).
    $codigoCookie = generarCadenaAleatoria(32); // Random...

    actualizarCodigoCookieEnBD($codigoCookie);

    // Enviamos al cliente, en forma de cookies, el identificador y el codigoCookie:
    setcookie("identificador", $arrayUsuario["identificador"], time() + 600);
    setcookie("codigoCookie", $codigoCookie, time() + 600);
}

function destruirSesionRamYCookie()
{
    session_destroy();
    actualizarCodigoCookieEnBD(Null);
    borrarCookies();
    unset($_SESSION); // Por si acaso
}
