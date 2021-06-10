window.onload = inicio;

var idHinchable,tablaHinchable,precioMonitor,precioCompleto;

function inicio(){
    idHinchable = document.getElementById("idHinchable");
    tablaHinchable = document.getElementById("tablaHinchable");
    cargarHinchable(idHinchable);
}

function cargarHinchable(idHinchable){

    var parametros={
        "id": idHinchable.value
    }

    llamadaAjax("HinchableObtenerPorId.php", objetoAParametrosParaRequest(parametros),
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var datos = JSON.parse(xml);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            mostrarDatosHinchable(datos);
        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );
}

function mostrarDatosHinchable(datos){
    var tamano=datos.length
    var tr = document.createElement("tr");
    var tdImagen = document.createElement("td");
    var imagen = document.createElement("img");
    imagen.setAttribute("src","img/hinch"+datos.id+".jpg");
    imagen.setAttribute("height","100px");
    imagen.setAttribute("width","100px");

    var tdNombre = document.createElement("td");
    var textoNombre = document.createTextNode(datos.nombre);

    var tdDimensiones = document.createElement("td");
    var textoDimensiones = document.createTextNode(datos.dimensiones);

    var tdTipo = document.createElement("td");
    var textoTipo = document.createTextNode(datos.tipo);

    var tdPrecio1 = document.createElement("td");
    var textoPrecio1 = document.createTextNode(datos.precio1 + " €");
    precioMonitor=datos.precio1;

    var tdPrecio2 = document.createElement("td");
    var textoPrecio2 = document.createTextNode(datos.precio2 + " €");
    precioCompleto=datos.precio2;

    var tdDescripcion = document.createElement("td");
    var textoDescripcion = document.createTextNode(datos.descripcion);


    tdImagen.appendChild(imagen);
    tdNombre.appendChild(textoNombre);
    tdDimensiones.appendChild(textoDimensiones);
    tdTipo.appendChild(textoTipo);
    tdDescripcion.appendChild(textoDescripcion)
    tdPrecio1.appendChild(textoPrecio1);
    tdPrecio2.appendChild(textoPrecio2);

    tr.appendChild(tdImagen);
    tr.appendChild(tdNombre);
    tr.appendChild(tdDimensiones);
    tr.appendChild(tdTipo);
    tr.appendChild(tdDescripcion);
    tr.appendChild(tdPrecio1);
    tr.appendChild(tdPrecio2);
    tablaHinchable.appendChild(tr);
}

function comprobarFecha(){
    var idHinchable = document.getElementById("idHinchable").value
    var fecha= document.getElementById("fecha").value
    var parametros={
        "id": idHinchable,
        "fecha" : fecha
    }

    llamadaAjax("HinchableObtenerPorId.php?comprobarFecha", objetoAParametrosParaRequest(parametros),
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var datos = JSON.parse(xml);
            var fecha= document.getElementById("fecha");

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            if(datos == 1){
                alert("Día de reserva no valido");
                fecha.value="";
            }
        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );

}

function cargarPrecio(){
    var precio = document.getElementById("precio")
    var monitor= document.getElementById("monitor")
    var control= document.getElementById("control")

    if(monitor.checked){
        precio.value=precioMonitor + " €"
        control.value="S";
    }else{
        precio.value=precioCompleto + " €"
        control.value="N";
    }

}
function calcularHora(){
    var horaInicial = document.getElementById("horaInicial").value
    var horaFinal= document.getElementById("horaFinal")
    var control= document.getElementById("control")

    if(monitor.checked){
        var split=horaInicial.split(":");
        var horaF=parseInt(split[0])+4 + ":" + split[1];

        horaFinal.value=horaF;
    }else{
        var split=horaInicial.split(":");
        var horaF=parseInt(split[0])+8 + ":" + split[1];

        horaFinal.value=horaF;
    }

}