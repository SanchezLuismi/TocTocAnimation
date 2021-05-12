window.onload = inicio;

var divReserva;
var tablaReserva;

function inicio(){
    tablaReserva = document.getElementById("tablaReserva");
    divReserva = document.getElementById("divReserva");
    document.getElementById("btnFiltros").addEventListener('click',buscarReserva);
    cargarTipos();

}

function llamadaAjax(url, parametros, manejadorOK, manejadorError) {
    //TODO PARA DEPURACIÓN: alert("Haciendo ajax a " + url + "\nCon parámetros " + parametros);

    var request = new XMLHttpRequest();

    request.open("POST", url);
    request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    request.onreadystatechange = function() {
        if (this.readyState == 4 && request.status == 200) {
            manejadorOK(request.responseText);
        }
        if (manejadorError != null && request.readyState == 4 && this.status != 200) {
            manejadorError(request.responseText);
        }
    };

    request.send(parametros);
}

function objetoAParametrosParaRequest(objeto) {
    // Esto convierte un objeto JS en un listado de clave1=valor1&clave2=valor2&clave3=valor3
    return new URLSearchParams(objeto).toString();
}

function cargarTipos(){

    var tipo = document.getElementById("tipo");




    llamadaAjax("HinchablesObtenerTodas.php", objetoAParametrosParaRequest(filtros),
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var hinchables = JSON.parse(xml);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            cargaReserva(categoria);
        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );


}


function buscarReserva(){

    var fecha = document.getElementById("fecha").value;
    var hora = document.getElementById("hora").value;
    var tipo = document.getElementById("tipo").value;
    var dimensiones = document.getElementById("dimensiones").value;

    let filtros = {
        "fecha" :fecha,
        "hora" : hora,
        "tipo" : tipo,
        "dimensiones" : dimensiones
    }


    llamadaAjax("HinchablesObtenerTodas.php", objetoAParametrosParaRequest(filtros),
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var hinchables = JSON.parse(xml);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            cargaReserva(categoria);
        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );


}

function cargaReserva(xml){

    var objeto =JSON.parse(xml);
    var tamano=objeto.length

    if(tamano !=0){
        for(var i=0;i<tamano;i++){
            var tr = document.createElement("tr");
            var tdNombre = document.createElement("td");
            var textoNombre = document.createTextNode(objeto[i].nombre);

            var tdDimensiones = document.createElement("td");
            var textoDimensiones = document.createTextNode(objeto[i].dimensiones);

            var tdTipo = document.createElement("td");
            var textoTipo = document.createTextNode(objeto[i].tipo);

            var tdDescripcion = document.createElement("td");
            var textoDescripcion = document.createTextNode(objeto[i].descripcion);

            var tdReserva = document.createElement("td");
            var botonReserva = document.createElement("input");
            botonReserva.setAttribute("type", "button");
            botonReserva.setAttribute('onclick', "crearReserva("+objeto[i].id+")");
            botonReserva.setAttribute("value", "Reserva")

            tdNombre.appendChild(textoNombre);
            tdDimensiones.appendChild(textoDimensiones);
            tdTipo.appendChild(textoTipo);
            tdDescripcion.appendChild(textoDescripcion);
            tdReserva.appendChild(botonReserva);

            tr.appendChild(tdNombre);
            tr.appendChild(tdDimensiones)
            tr.appendChild(tdTipo)
            tr.appendChild(tdDescripcion)
            tr.appendChild(tdReserva);
            tablaReserva.appendChild(tr);
        }
        divReserva.style.visibility="visible";
    }else{
        alert("No hay datos para mostrar");
    }





}