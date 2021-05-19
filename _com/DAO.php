<?php

require_once "Clases.php";
require_once "Varios.php";

class DAO
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD()
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "TocToc"; // Schema
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // Modo emulación desactivado para prepared statements "reales"
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Que los errores salgan como excepciones.
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // El modo de fetch que queremos por defecto.
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }

        return $pdo;
    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $select = self::$pdo->prepare($sql);
        $select->execute($parametros);
        $rs = $select->fetchAll();

        return $rs;
    }

    // Devuelve:
    //   - null: si ha habido un error
    //   - int: el id autogenerado para el nuevo registro.
    private static function ejecutarInsert(string $sql, array $parametros):  ?int
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $insert = self::$pdo->prepare($sql);
        $sqlConExito = $insert->execute($parametros);

        if (!$sqlConExito) return null;
        else return self::$pdo->lastInsertId();
    }

    // Devuelve:
    //   - null: si ha habido un error
    //   - 0, 1 u otro número positivo: OK (no errores) y estas son las filas afectadas.
    private static function ejecutarUpdate(string $sql, array $parametros): ?int
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $update = self::$pdo->prepare($sql);
        $sqlConExito = $update->execute($parametros);

        if (!$sqlConExito) return null;
        else return $update->rowCount();
    }

    // Devuelve:
    //   - null: si ha habido un error
    //   - 0, 1 o más: OK (no errores) y estas son las filas afectadas.
    private static function ejecutarDelete(string $sql, array $parametros): ?int
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $delete = self::$pdo->prepare($sql);
        $sqlConExito = $delete->execute($parametros);

        if (!$sqlConExito) return null;
        else return $delete->rowCount();
    }

    public function destruirSesionRamYCookie()
    {
        session_destroy();
        setcookie('codigoCookie', "");
        setcookie('identificador',"");
        unset($_SESSION);
    }


    /* HINCHABLE */

    private static function hinchableCrearDesdeRs(array $fila): Hinchable
    {
        print_r($fila);
        return new Hinchable($fila["hId"], $fila["hNombre"],$fila["hDescripcion"],$fila["tNombre"],$fila["hDimensiones"]);
    }

    public static function hinchableObtenerPorId(int $id): ?Hinchable
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM hinchable WHERE id=?",
            [$id]
        );

        if ($rs) return self::hinchableCrearDesdeRs($rs[0]);
        else return null;
    }

    public static function hinchableObtenerTodas(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM hinchable ORDER BY nombre",
            []
        );

        foreach ($rs as $fila) {
            $hinchable = self::hinchableCrearDesdeRs($fila);
            array_push($datos, $hinchable);
        }

        return $datos;
    }

    public static function hinchableObtenerPorParametros(int $tipo, string $dimensiones): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT h.id AS hId,h.nombre AS hNombre, h.dimensiones as hDimensiones,h.descripcion as hDescripcion,t.nombre AS tNombre
                FROM hinchable AS h INNER JOIN tipo AS t ON h.tipo = t.id WHERE h.tipo=? and h.dimensiones=? ORDER BY hNombre",
            [$tipo,$dimensiones]
        );

        print_r($rs);

        foreach ($rs as $fila) {
            $hinchable = self::hinchableCrearDesdeRs($fila);
            array_push($datos, $hinchable);
        }

        return $datos;
    }

    public static function hinchableCrear(string $nombre): ?Hinchable
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO hinchable (nombre) VALUES (?)",
            [$nombre]
        );

        if ($idAutogenerado == null) return null;
        else return self::hinchableObtenerPorId($idAutogenerado);
    }

    public static function hinchableActualizar(Hinchable $categoria): ?Hinchable
    {
        $filasAfectadas = self::ejecutarUpdate(
            "UPDATE hinchable SET nombre=? WHERE id=?",
            [$categoria->getNombre(), $categoria->getId()]
        );

        if ($filasAfectadas = null) return null;
        else return $categoria;
    }

    public static function hinchableEliminarPorId(int $id): bool
    {
        $filasAfectadas = self::ejecutarUpdate(
            "DELETE FROM hinchable WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function hinchableEliminar(Hinchable $categoria): bool
    {
        return self::hinchableEliminarPorId($categoria->id);
    }

    /*TIPOS*/

    public static function tipoObtenerTodas(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM tipo ORDER BY nombre",
            []
        );

        foreach ($rs as $fila) {
            array_push($datos,$fila );
        }

        return $datos;
    }

    /*USUARIO*/
    private static function usuarioCrearDesdeRs(array $fila): Usuario
    {
        return new Usuario($fila["id"],$fila["identificador"],$fila["contrasenna"],$fila["tipoUsuario"], $fila["nombre"],$fila["apellidos"],
            $fila["telefono"]);
    }

    public static function usuarioObtenerPorId(int $id): ?Usuario
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario WHERE id=?",
            [$id]
        );

        if ($rs) return self::usuarioCrearDesdeRs($rs[0]);
        else return null;
    }

    public static function usuarioObtenerPorIdentificadoryPassword(string $identificador, string $contrasenna): ?Usuario
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario WHERE identificador=? and contrasenna=?",
            [$identificador,$contrasenna]
        );

        if ($rs) return self::usuarioCrearDesdeRs($rs[0]);
        else return null;
    }

   /*public static function usuarioObtenerTodas(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario ORDER BY nombre",
            []
        );

        foreach ($rs as $fila) {
            $persona = self::usuarioCrearDesdeRs($fila);
            array_push($datos, $persona);
        }

        return $datos;
    }*/

    public static function usuarioCrear(string $identificador,string $password,string $nombre,string $apellidos, string $telefono): ?Usuario
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO usuario (nombre) VALUES (?,?,?,?,?,?,?)",
            [$identificador,$password,$nombre,$apellidos,$telefono]
        );

        if ($idAutogenerado == null) return null;
        else return self::usuarioObtenerPorId($idAutogenerado);
    }

    public static function usuarioActualizar(Usuario $persona): ?Usuario
    {
        $filasAfectadas = self::ejecutarUpdate(
            "UPDATE usuario SET identificador=?,password=?,nombre=?,apellidos=?,telefono=?,estrella=?,categoriaId=? WHERE id=?",
            [$persona->getNombre(),$persona->getApellido(),$persona->getTelefono(),
                $persona->getEstrella(),$persona->getCategoriaId(), $persona->getId()]
        );

        if ($filasAfectadas = null) return null;
        else return $persona;
    }

    public static function usuarioEliminarPorId(int $id): bool
    {
        $filasAfectadas = self::ejecutarUpdate(
            "DELETE FROM Usuario WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function usuarioEliminar(Usuario $persona): bool
    {
        return self::usuarioEliminarPorId($persona->id);
    }

    /* RESERVAS */

    private static function reservaCrearDesdeRs(array $fila): Reserva
    {
        return new reserva($fila["id"], $fila["nombre"],$fila["apellidos"],
            $fila["telefono"],$fila["estrella"],$fila["categoriaId"]);
    }

    public static function reservaObtenerPorId(int $id): ?Reserva
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM reserva WHERE id=?",
            [$id]
        );

        if ($rs) return self::reservaCrearDesdeRs($rs[0]);
        else return null;
    }

    public static function reservaObtenerTodas(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM reserva ORDER BY nombre",
            []
        );

        foreach ($rs as $fila) {
            $reserva = self::reservaCrearDesdeRs($fila);
            array_push($datos, $reserva);
        }

        return $datos;
    }

    public static function reservaCrear(string $nombre,string $apellidos, string $telefono,int $estrella,int $categoriaId): ?Reserva
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO reserva (nombre) VALUES (?,?,?,?,?)",
            [$nombre,$apellidos,$telefono,$estrella,$categoriaId]
        );

        if ($idAutogenerado == null) return null;
        else return self::reservaCrearDesdeRs($idAutogenerado);
    }

    public static function reservaActualizar(Reserva $reserva): ?Reserva
    {
        $filasAfectadas = self::ejecutarUpdate(
            "UPDATE reserva SET nombre=?,apellidos=?,telefono=?,estrella=?,categoriaId=? WHERE id=?",
            [$reserva->getNombre(),$reserva->getApellido(),$reserva->getTelefono(),
                $reserva->getEstrella(),$reserva->getCategoriaId(), $reserva->getId()]
        );

        if ($filasAfectadas = null) return null;
        else return $reserva;
    }

    public static function reservaEliminarPorId(int $id): bool
    {
        $filasAfectadas = self::ejecutarUpdate(
            "DELETE FROM reserva WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function reservaEliminar(Reserva $reserva): bool
    {
        return self::reservaEliminarPorId($reserva->id);
    }


}



