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


    public function __construct(int $id, string $identificador, string $password,int $tipoUsuario, string $nombre, string $apellidos, string $telefono)
    {
        $this->setId($id);
        $this->setIdentificador($identificador);
        $this->setPassword($password);
        $this->setTipoUsuario($tipoUsuario);
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
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "telefono" => $this->telefono,
            "estrella" => $this->estrella,
            "categoriaId" => $this->categoriaId,
            "id" => $this->id,

        ];
    }
}

class Reserva extends Dato implements JsonSerializable
{

    use Identificable;

    private $idUsuario;
    private $idHinchable;
    private $fecha;
    private $direcion;
    private $ciudad;
    private $codPostal;

    public function __construct(int $id, int $idUsuario, int $idHinchable, Date $fecha, string $direcion, string $ciudad, string $codPostal)
    {
        $this->setId($id);
        $this->setidUsuario($idUsuario);
        $this->setIdHinchable($idHinchable);
        $this->setFecha($fecha);
        $this->setDirecion($direcion);
        $this->setCiudad($ciudad);
        $this->setCodPostal($codPostal);
    }

    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(int $idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdHinchable(): int
    {
        return $this->idHinchable;
    }

    public function setIdHinchable(int $idHinchable): void
    {
        $this->idHinchable = $idHinchable;
    }

    public function getFecha(): Date
    {
        return $this->fecha;
    }

    public function setFecha(Date $fecha): void
    {
        $this->fecha = $fecha;
    }

    public function getDirecion(): string
    {
        return $this->direcion;
    }

    public function setDirecion(string $direcion): void
    {
        $this->direcion = $direcion;
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

    public function jsonSerialize()
    {
        return [
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "telefono" => $this->telefono,
            "estrella" => $this->estrella,
            "categoriaId" => $this->categoriaId,
            "id" => $this->id,

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

    public function __construct(int $id, string $nombre, string $dimensiones, string $tipo, string $descripcion)
    {
        $this->setId($id);
        $this->setNombre($nombre);
        $this->setDimensiones($dimensiones);
        $this->setTipo($tipo);
        $this->setDescripcion($descripcion);
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

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "nombre" => $this->nombre,
            "dimensiones" => $this->dimensiones,
            "tipo" => $this->tipo,
            "descripcion" => $this->descripcion
        ];
    }

}