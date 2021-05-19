<?php

    require_once "_com/Varios.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservas</title>
    <script src='js/Scripts.js'></script>
</head>


<body>
<?php pintarInfoSesion(); ?>
<br />
<div id="filtros">
    <h4>Filtros para buscar:</h4>
    <p>
        <label>Fecha: </label><input type="date" id='fecha'/>
        <label>Hora: </label><input type="text" id="hora">
        <label>Tipo: </label><select name="tipo" id="tipo">
            <option value=""></option>
        </select>
        <br />
        <div>
            <label>Dimensiones: </label><br />
            <label>Anchura:</label><input type='number' id='dAnchura'/>
            <label>Altura: </label><input type='number' id='dAltura'/>
            <label>Largo: </label><input type='number' id='dLargo'/>
        </div>
        <br />
        <label>Precio: </label><input type='number' id='precio'/> <br />
        <button id='btnFiltros'>Buscar</button>
    </p>
</div>

<div id="divReserva" style="visibility: hidden">
    <table id="tablaReserva" border="1">
        <tr>
            <td>Nombre</td>
            <td>Dimensiones</td>
            <td>Tipo</td>
            <td>Descripción</td>
            <td>Reserva</td>
        </tr>
    </table>
</div>



</body>
</html>