window.onload = inicio;

function inicio(){
    var tablaReservas = document.getElementById("tablaReservas");
    document.getElementById("btnFiltros").addEventListener('click',buscarReserva);

}

function buscarReserva(){

    var fecha = document.getElementById("fecha");
    var hora = document.getElementById("hora");
    var dimensiones = document.getElementById("dimensiones");

    var req = new XMLHttpRequest();

    req.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){

            cargaReserva(this.response);
        }

    };

    req.open("GET","HinchablesObtenerTodas.php",true);
    req.send();


}

function cargaReserva(xml){

    var objeto = JSON.parse(xml);
    var tamano=objeto.length


    for(var i=0;i<tamano;i++){
        var tr = document.createElement("tr");
        var td = document.createElement("td");
        var textoContenido = document.createTextNode(objeto[i].nombre);

        var tdReserva = document.createElement("td");
        var boton = document.createElement("input");
        boton.setAttribute("type", "button");
        boton.setAttribute("id", objeto[i].id);

        boton.setAttribute('onclick', "crearReserva("+objeto[i].id+")");
        boton.setAttribute("value", "X")

        td.appendChild(textoContenido);
        tdReserva.appendChild(boton);

        tr.appendChild(td);
        tr.appendChild(tdReserva);
        tablaCategorias.appendChild(tr);
    }
}