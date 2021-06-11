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


    /* HINCHABLE */

    private static function hinchableCrearDesdeRs(array $fila): Hinchable
    {
        //print_r($fila);

        if(!$fila["hId"]){
            return new Hinchable($fila["id"], $fila["nombre"],$fila["dimensiones"],$fila["tipo"],$fila["descripcion"],$fila["precio1"],$fila["precio2"]);
        }else{
            return new Hinchable($fila["hId"], $fila["hNombre"],$fila["hDimensiones"],$fila["tNombre"],$fila["hDescripcion"],$fila["hPrecio1"],$fila["hPrecio2"]);
        }

    }

    public static function hinchableObtenerPorId(int $id): ?Hinchable
    {
        $rs = self::ejecutarConsulta(
            "SELECT h.id AS hId,h.nombre AS hNombre, h.dimensiones as hDimensiones,h.descripcion as hDescripcion,h.precio1 as hPrecio1,h.precio2 as hPrecio2,t.nombre AS tNombre 
            FROM hinchable AS h INNER JOIN tipo AS t ON h.tipo = t.id WHERE h.id=?",
            [$id]
        );

        if ($rs) return self::hinchableCrearDesdeRs($rs[0]);
        else return null;
    }

    public static function hinchableObtenerTodas(): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT h.id AS hId,h.nombre AS hNombre, h.dimensiones as hDimensiones,h.descripcion as hDescripcion,h.precio1 as hPrecio1,h.precio2 as hPrecio2,t.nombre AS tNombre 
            FROM hinchable AS h INNER JOIN tipo AS t ON h.tipo = t.id ORDER BY h.nombre",
            []
        );

        foreach ($rs as $fila) {
            $hinchable = self::hinchableCrearDesdeRs($fila);
            array_push($datos, $hinchable);
        }

        return $datos;
    }

    public static function hinchableObtenerPorParametros(string $tipo,string $dimensiones,string $precioMenor, string $precioMayor): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT h.id AS hId,h.nombre AS hNombre, h.dimensiones as hDimensiones,h.descripcion as hDescripcion,h.precio1 as hPrecio1,h.precio2 as hPrecio2,t.nombre AS tNombre 
            FROM hinchable AS h INNER JOIN tipo AS t ON h.tipo = t.id WHERE t.id = ? and h.dimensiones = ? and h.precio1 > ? and h.precio1 < ?ORDER BY hNombre",
            [$tipo,$dimensiones,$precioMenor,$precioMayor]
        );

        foreach ($rs as $fila) {
            $hinchable = self::hinchableCrearDesdeRs($fila);
            array_push($datos, $hinchable);
        }

        return $datos;
    }

    public static function hinchableObtenerPorTipo(string $tipo): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT h.id AS hId,h.nombre AS hNombre, h.dimensiones as hDimensiones,h.descripcion as hDescripcion,h.precio1 as hPrecio1,h.precio2 as hPrecio2,t.nombre AS tNombre 
            FROM hinchable AS h INNER JOIN tipo AS t ON h.tipo = t.id WHERE t.id = ? ORDER BY hNombre",
            [$tipo]
        );

        foreach ($rs as $fila) {
            $hinchable = self::hinchableCrearDesdeRs($fila);
            array_push($datos, $hinchable);
        }

        return $datos;
    }

    public static function hinchableObtenerPorDimensiones(string $dimensiones): array
    {
        $datos = [];

        $rs = self::ejecutarConsulta(
            "SELECT h.id AS hId,h.nombre AS hNombre, h.dimensiones as hDimensiones,h.descripcion as hDescripcion,h.precio1 as hPrecio1,h.precio2 as hPrecio2,t.nombre AS tNombre 
            FROM hinchable AS h INNER JOIN tipo AS t ON h.tipo = t.id WHERE h.dimensiones = ? ORDER BY hNombre",
            [$dimensiones]
        );

        foreach ($rs as $fila) {
            $hinchable = self::hinchableCrearDesdeRs($fila);
            array_push($datos, $hinchable);
        }

        return $datos;
    }

    public static function hinchableObtenerPorPrecio(string $precioMenor,string $precioMayor): array
    {
        $datos = [];
        if($precioMenor == null){
            $rs = self::ejecutarConsulta(
                "SELECT h.id AS hId,h.nombre AS hNombre, h.dimensiones as hDimensiones,h.descripcion as hDescripcion,h.precio1 as hPrecio1,h.precio2 as hPrecio2,t.nombre AS tNombre 
            FROM hinchable AS h INNER JOIN tipo AS t ON h.tipo = t.id WHERE  h.precio1 < ? ORDER BY hNombre",
                [$precioMayor]
            );
        }else if($precioMayor == null){
            $rs = self::ejecutarConsulta(
                "SELECT h.id AS hId,h.nombre AS hNombre, h.dimensiones as hDimensiones,h.descripcion as hDescripcion,h.precio1 as hPrecio1,h.precio2 as hPrecio2,t.nombre AS tNombre 
            FROM hinchable AS h INNER JOIN tipo AS t ON h.tipo = t.id WHERE  h.precio1 > ? ORDER BY hNombre",
                [$precioMenor]
            );
        }else{
            $rs = self::ejecutarConsulta(
                "SELECT h.id AS hId,h.nombre AS hNombre, h.dimensiones as hDimensiones,h.descripcion as hDescripcion,h.precio1 as hPrecio1,h.precio2 as hPrecio2,t.nombre AS tNombre 
            FROM hinchable AS h INNER JOIN tipo AS t ON h.tipo = t.id WHERE  h.precio1 < ? and h.precio1 > ? ORDER BY hNombre",
                [$precioMenor,$precioMayor]
            );
        }


        foreach ($rs as $fila) {
            $hinchable = self::hinchableCrearDesdeRs($fila);
            array_push($datos, $hinchable);
        }

        return $datos;
    }

   /* public static function hinchableCrear(string $nombre): ?Hinchable
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO hinchable (nombre) VALUES (?)",
            [$nombre]
        );

        if ($idAutogenerado == null) return null;
        else return self::hinchableObtenerPorId($idAutogenerado);
    }

    public static function hinchableActualizar(Hinchable $hinchable): ?Hinchable
    {
        $filasAfectadas = self::ejecutarUpdate(
            "UPDATE hinchable SET nombre=? WHERE id=?",
            [$hinchable->getNombre(), $hinchable->getId()]
        );

        if ($filasAfectadas = null) return null;
        else return $hinchable;
    }*/

    public static function hinchableEliminarPorId(int $id): bool
    {
        $filasAfectadas = self::ejecutarUpdate(
            "DELETE FROM hinchable WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function hinchableEliminar(Hinchable $hinchable): bool
    {
        return self::hinchableEliminarPorId($hinchable->id);
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
        return new Usuario($fila["id"],$fila["identificador"],$fila["contrasenna"], $fila["nombre"],$fila["apellidos"], $fila["telefono"]);
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

    public static function usuarioObtenerPorIdentificador(string $identificador): int
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario WHERE identificador=?",
            [$identificador]
        );

        if ($rs) return 1;
        else return 0;
    }

    function obtenerUsuarioPorCodigoCookie(string $identificador, string $codigoCookie): ?Usuario
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario WHERE identificador=? AND BINARY codigoCookie=?",
            [$identificador, $codigoCookie]
        );
        if ($rs) return self::usuarioCrearDesdeRs($rs[0]);
        else return null;
    }


        public static function usuarioCrear(string $identificador,string $password,string $nombre,string $apellidos, string $telefono): ?Usuario
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO usuario (identificador,contrasenna,codigoCookie,caducidadCodigoCookie,nombre,apellidos,telefono) VALUES (?,?,?,?,?,?,?)",
            [$identificador,$password,null,null,$nombre,$apellidos,$telefono]
        );

        if ($idAutogenerado == null) return null;
        else return self::usuarioObtenerPorId($idAutogenerado);
    }

    public static function usuarioActualizar(string $nombre,string $apellidos,string $telefono,string $identificador,string $id): ?Usuario
    {
        $filasAfectadas = self::ejecutarUpdate(
            "UPDATE usuario SET identificador=?,nombre=?,apellidos=?,telefono=? WHERE id=?",
            [$identificador,$nombre,$apellidos,$telefono,$id]
        );

        if ($filasAfectadas = null) return null;
        else return self::usuarioObtenerPorId($id);
    }

    public static function usuarioActualizarPasswd(string $passwd,int $id): ?Usuario
    {
        $filasAfectadas = self::ejecutarUpdate(
            "UPDATE usuario SET contrasenna=? WHERE id=?",
            [$passwd,$id]
        );

        if ($filasAfectadas = null) return null;
        else return self::usuarioObtenerPorId($id);
    }

    public static function usuarioActualizarCodigoCookie(?string $codigoCookie,int $id)
    {
        $filasAfectadas = self::ejecutarUpdate(
            "UPDATE usuario SET codigoCookie=? WHERE id=?",
            [$codigoCookie,$id]
        );

    }

    public static function usuarioEliminarPorId(int $id): bool
    {
        $filasAfectadas = self::ejecutarUpdate(
            "DELETE FROM usuario WHERE id=?",
            [$id]
        );

        return ($filasAfectadas == 1);
    }

    public static function usuarioEliminar(Usuario $persona): bool
    {
        return self::usuarioEliminarPorId($persona->id);
    }

    /* RESERVAS */

    private static function reservaCrearDesdeRsConcatenado(array $fila): Reserva
    {
        return new Reserva($fila["rId"], $fila["rIdUser"],$fila["hNombre"], $fila["rFechaReserva"],$fila["rDireccion"],$fila["rCiudad"],
            $fila["rCodPostal"],$fila["rPrecio"],$fila["rMonitor"],$fila["rHoraInicial"],$fila["rHoraFinal"]);
    }

    private static function reservaCrearDesdeRs(array $fila): Reserva
    {
        return new Reserva($fila["id"], $fila["id_user"],$fila["id_hinchable"], $fila["fecha_reserva"],$fila["direccion"],$fila["ciudad"],
            $fila["cod_postal"],$fila["precio"],$fila["monitor"],$fila["hora_inicio"],$fila["hora_final"]);
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


    public static function reservaObtenerPorUsuario($id): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT r.id as rId,r.id_user as rIdUser,h.nombre as hNombre,r.fecha_reserva as rFechaReserva,r.direccion as rDireccion,r.ciudad as rCiudad,
                r.cod_postal as rCodPostal,r.precio as rPrecio,r.monitor as rMonitor,r.hora_inicio as rHoraInicial,r.hora_final as rHoraFinal
 FROM reserva AS r INNER JOIN hinchable AS h ON r.id_Hinchable = h.id WHERE r.id_user=?",
            [$id]
        );

        foreach ($rs as $fila) {
            $reserva = self::reservaCrearDesdeRsConcatenado($fila);
            array_push($datos, $reserva);
        }
        return $datos;
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

    public static function reservaCrear($idUsuario,$idHinchable, $fecha,$direccion,$ciudad,$codPostal,$precio,$monitor,$horaInicial,$horaFinal): ?Reserva
    {
        $idAutogenerado = self::ejecutarInsert(
            "INSERT INTO reserva (id_user,id_hinchable,fecha_reserva,direccion,ciudad,cod_postal,precio,monitor,hora_inicio,hora_final) VALUES (?,?,?,?,?,?,?,?,?,?)",
            [$idUsuario,$idHinchable,$fecha,$direccion,$ciudad,$codPostal,$precio,$monitor,$horaInicial,$horaFinal]
        );

        if ($idAutogenerado == null) return null;
        else return self::reservaObtenerPorId($idAutogenerado);
    }

    public static function hinchableObtenerPorIdFecha(int $id,string $fecha): int
    {
        $rs = self::ejecutarConsulta(
            "SELECT * FROM reserva where id=? and fecha_reserva=?",
            [$id,$fecha]
        );

        if ($rs) return 1;
        else return 0;
    }

    public static function reservaActualizar(Reserva $reserva): ?Reserva
    {
        $filasAfectadas = self::ejecutarUpdate(
            "UPDATE reserva SET idUsuario,idHinchable,fecha,direccion,ciudad,cod_postal,precio,monitor,hora_inicial,hora_final WHERE id=?",
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



