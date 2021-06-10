window.onload = inicio;

var divReserva,fecha,busqueda,filtros;
var tablaReserva;

function inicio(){
    busqueda = 0;
    filtros=1;
    tablaReserva = document.getElementById("tablaReserva");
    divReserva = document.getElementById("divReserva");
    divFiltros = document.getElementById("divFiltros");
    document.getElementById("btnFiltros").addEventListener('click',buscarReserva);
    var selectTipo = document.getElementById("tipo");
    cargarTipos(selectTipo);
    buscarReserva();
}

function cargarTipos(select){

    llamadaAjax("TiposObtenerTodos.php", "",
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var tipos = JSON.parse(xml);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            cargarSelectTipos(select,tipos);
        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );


}

function cargarSelectTipos(select,tipos){

    for(var i=0;i<tipos.length;i++){
        var option = document.createElement("option");
        option.text = tipos[i].nombre;
        option.value = tipos[i].id;
        select.add(option);
    }


}


function buscarReserva(){

    if(busqueda > 0){
        while (tablaReserva.firstChild) {
            //var children = parg.childNodes;
            //The list is LIVE so it will re-index each call
            tablaReserva.removeChild(tablaReserva.firstChild);
        }
        tablaReserva.innerHTML=" <tr>\n" +
            "            <th>Imagen</th>\n" +
            "            <th>Nombre</th>\n" +
            "            <th>Dimensiones en metros (ancho x altura x largo)</th>\n" +
            "            <th>Tipo</th>\n" +
            "            <th>Descripción </th>\n" +
            "            <th>Precio (4 horas con monitor)</th>\n" +
            "            <th>Precio (día completo sin monitos)</th>\n" +
            "            <th></th>\n" +
            "        </tr>";
    }



    var tipo = document.getElementById("tipo").value;
    var precioMenor = document.getElementById("precioMenor").value;
    var precioMayor = document.getElementById("precioMayor").value;
    var dAnchura = document.getElementById("dAnchura").value;
    var dAltura = document.getElementById("dAltura").value;
    var dLargo = document.getElementById("dLargo").value;



    let parametros = {
        "tipo" : tipo,
        "dAnchura" : dAnchura,
        "dAltura":dAltura,
        "dLargo":dLargo,
        "precioMenor":precioMenor,
        "precioMayor":precioMayor
    }


    llamadaAjax("HinchablesPorParametros.php", objetoAParametrosParaRequest(parametros),
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var hinchables = JSON.parse(xml);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            cargaReserva(hinchables);
        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );


}

function cargaReserva(objeto){

    //var objeto =JSON.parse(xml);
    var tamano=objeto.length

    if(tamano !=0){
        for(var i=0;i<tamano;i++){
            var tr = document.createElement("tr");
            var tdImagen = document.createElement("td");
            var imagen = document.createElement("img");
            imagen.setAttribute("src","img/hinch"+objeto[i].id+".jpg");
            imagen.setAttribute("height","100%");
            imagen.setAttribute("width","100%");
            imagen.setAttribute("className","img");
            var imgReserva = document.createElement("a");
            imgReserva.setAttribute("href", "img/hinch"+objeto[i].id+".jpg");
            imgReserva.setAttribute("data-lightbox", "smile");
            var tdNombre = document.createElement("td");
            var textoNombre = document.createTextNode(objeto[i].nombre);
            var tdDimensiones = document.createElement("td");
            var textoDimensiones = document.createTextNode(objeto[i].dimensiones);
            var tdTipo = document.createElement("td");
            var textoTipo = document.createTextNode(objeto[i].tipo);
            var tdPrecio1 = document.createElement("td");
            var textoPrecio1 = document.createTextNode(objeto[i].precio1 + " €");
            var tdPrecio2 = document.createElement("td");
            if(objeto[i].precio2 == 0){
                var textoPrecio2 = document.createTextNode("Solo con monitor");
            }else{
                var textoPrecio2 = document.createTextNode(objeto[i].precio2 + " €");
            }
            var tdDescripcion = document.createElement("td");
            var textoDescripcion = document.createTextNode(objeto[i].descripcion);
            var tdReserva = document.createElement("td");
            var botonReserva = document.createElement("a");
            botonReserva.innerHTML= "Reserva";
            botonReserva.setAttribute("href", "ReservaInicial.php?idHinchable="+objeto[i].id);
            botonReserva.setAttribute("class", "btnReserva");
            imgReserva.appendChild(imagen);
            tdImagen.appendChild(imgReserva);
            tdNombre.appendChild(textoNombre);
            tdDimensiones.appendChild(textoDimensiones);
            tdTipo.appendChild(textoTipo);
            tdDescripcion.appendChild(textoDescripcion)
            tdPrecio1.appendChild(textoPrecio1);
            tdPrecio2.appendChild(textoPrecio2);
            tdReserva.appendChild(botonReserva);
            tr.appendChild(tdImagen);
            tr.appendChild(tdNombre);
            tr.appendChild(tdDimensiones);
            tr.appendChild(tdTipo);
            tr.appendChild(tdDescripcion);
            tr.appendChild(tdPrecio1);
            tr.appendChild(tdPrecio2);
            tr.appendChild(tdReserva);
            tablaReserva.appendChild(tr);

        }
        busqueda++;
    }else{
        alert("No hay datos para mostrar");
    }

}

