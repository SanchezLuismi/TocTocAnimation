<?php


abstract class Dato
{
}

trait Identificable
{
    protected $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

class Usuario extends Dato implements JsonSerializable
{
    use Identificable;

    private $identificador;
    private $password;
    private $tipoUsuario;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $codigoCookie;
    private $caducidadCookie;


    public function __construct(int $id, string $identificador, string $password, string $nombre, string $apellidos, string $telefono)
    {
        $this->setId($id);
        $this->setIdentificador($identificador);
        $this->setPassword($password);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setTelefono($telefono);
    }

    public function getIdentificador(): string
    {
        return $this->identificador;
    }

    public function setIdentificador(string $identificador): void
    {
        $this->identificador = $identificador;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    public function getTipoUsuario()
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario($tipoUsuario): void
    {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getCodigoCookie(): ?string
    {
        return $this->codigoCookie;
    }

    public function setCodigoCookie(?string $codigoCookie): void
    {
        $this->codigoCookie = $codigoCookie;
    }
    public function getCaducidadCookie(): ?string
    {
        return $this->caducidadCookie;
    }
    public function setCaducidadCookie(?string $caducidadCookie): void
    {
        $this->caducidadCookie = $caducidadCookie;
    }



    public function jsonSerialize()
    {
        return [
            "nombre" => $this->getNombre(),
            "apellido" => $this->getApellidos(),
            "telefono" => $this->getTelefono(),
            "identificador" => $this->getIdentificador(),
            "contrasenna" => $this->getPassword(),
            "id" => $this->getId(),

        ];
    }
}

class Reserva extends Dato implements JsonSerializable
{

    use Identificable;

    private $idUsuario;
    private $idHinchable;
    private $fecha;
    private $direccion;
    private $ciudad;
    private $codPostal;
    private $precio;
    private $monitor;
    private $horaInicial;
    private $horaFinal;

    public function __construct(int $id, int $idUsuario, string $nombreHinchable, string $fecha, string $direccion, string $ciudad, string $codPostal,float $precio,int $monitor,string $horaInicial,string $horaFinal)
    {
        $this->setId($id);
        $this->setidUsuario($idUsuario);
        $this->setNombreHinchable($nombreHinchable);
        $this->setFecha($fecha);
        $this->setDireccion($direccion);
        $this->setCiudad($ciudad);
        $this->setCodPostal($codPostal);
        $this->setPrecio($precio);
        $this->setMonitor($monitor);
        $this->setHoraInicial($horaInicial);
        $this->setHoraFinal($horaFinal);
    }

    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(int $idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    public function getNombreHinchable(): string
    {
        return $this->nombreHinchable;
    }

    public function setNombreHinchable(string $nombreHinchable): void
    {
        $this->nombreHinchable = $nombreHinchable;
    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): void
    {
        $this->direccion = $direccion;
    }

    public function getCiudad(): string
    {
        return $this->ciudad;
    }

    public function setCiudad(string $ciudad): void
    {
        $this->ciudad = $ciudad;
    }

    public function getCodPostal(): string
    {
        return $this->codPostal;
    }

    public function setCodPostal(string $codPostal): void
    {
        $this->codPostal = $codPostal;
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

    public function getMonitor(): int
    {
        return $this->monitor;
    }

    public function setMonitor(int $monitor): void
    {
        $this->monitor = $monitor;
    }

    public function getHoraInicial(): string
    {
        return $this->horaInicial;
    }

    public function setHoraInicial(string $horaInicial): void
    {
        $this->horaInicial = $horaInicial;
    }

    public function getHoraFinal(): string
    {
        return $this->horaFinal;
    }

    public function setHoraFinal(string $horaFinal): void
    {
        $this->horaFinal = $horaFinal;
    }



    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "idUsuario" => $this->getIdUsuario(),
            "NombreHinchable" => $this->getNombreHinchable(),
            "fecha" => $this->getFecha(),
            "direccion" => $this->getDireccion(),
            "ciudad" => $this->getCiudad(),
            "codPostal" => $this->getCodPostal(),
            "horaInicial" => $this->getHoraInicial(),
            "horaFinal" => $this->getHoraFinal(),
            "monitor" => $this->getMonitor(),
            "precio" => $this->getPrecio()
        ];
    }

}

class Hinchable extends Dato implements JsonSerializable
{

    use Identificable;

    private $nombre;
    private $dimensiones;
    private $tipo;
    private $descripcion;
    private $precio1;
    private $precio2;

    public function __construct(int $id, string $nombre, string $dimensiones, string $tipo, string $descripcion,float $precio1,float $precio2)
    {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setDimensiones($dimensiones);
        $this->setTipo($tipo);
        $this->setDescripcion($descripcion);
        $this->setPrecio1($precio1);
        $this->setPrecio2($precio2);
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getDimensiones(): string
    {
        return $this->dimensiones;
    }

    public function setDimensiones(string $dimensiones): void
    {
        $this->dimensiones = $dimensiones;
    }

    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getPrecio1(): float
    {
        return $this->precio1;
    }

    public function setPrecio1(float $precio1): void
    {
        $this->precio1 = $precio1;
    }

    public function getPrecio2(): float
    {
        return $this->precio2;
    }

    public function setPrecio2(float $precio2): void
    {
        $this->precio2 = $precio2;
    }



    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "nombre" => $this->getNombre(),
            "dimensiones" => $this->getDimensiones(),
            "tipo" => $this->getTipo(),
            "descripcion" => $this->getDescripcion(),
            "precio1" => $this->getPrecio1(),
            "precio2" => $this->getPrecio2()
        ];
    }

}