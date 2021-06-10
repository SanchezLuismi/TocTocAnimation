window.onload = inicio;

var usuId,usuNombre,usuApellidos,usuIdentificador,usuPassword,reservas,tablaReservas,mostrarPass;

function inicio(){
    usuId = document.getElementById("usuId");
    usuNombre = document.getElementById("usuNombre");
    usuApellidos = document.getElementById("usuApellidos");
    usuPassword = document.getElementById("usuPassword");
    usuIdentificador = document.getElementById("usuIdentificador");
    usuTelefono = document.getElementById("usuTelefono");
    document.getElementById("mostarCambioPass").addEventListener('click',mostrarCambioPass);
    document.getElementById("cambioDatos").addEventListener('click',edicionDatos);
    document.getElementById("guardarDatos").addEventListener('click',guardarDatos);
    document.getElementById("guardarPass").addEventListener('click',guardarPasswd);
    document.getElementById("mostarReservas").addEventListener('click',mostrarReservas);
    reservas=document.getElementById("reservas");
    tablaReservas=document.getElementById("tablaReservas");
    mostrarPass=document.getElementById("mostrarPass");
}

function mostrarCambioPass(){
    var parametros = {
        "id":usuId.value
    }
    document.getElementById("mostarCambioPass").style.visibility="hidden";
    llamadaAjax("UsuarioObtenerDatos.php", objetoAParametrosParaRequest(parametros),
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var usuario = JSON.parse(xml);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            cargarPasswd(usuario);
        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );
}

function cargarPasswd(usuario){
    if(usuario.contrasenna != null){
        usuPassword.value=usuario.contrasenna;
        mostrarPass.style.visibility="visible";
    }
}

function comprobarPassword(){

    if(contrasenna.value.length > 8 && contrasenna.value.length < 16){
        document.getElementById("guardarPass").style.visibility="visible";
    }else{
        alert("La contraseña debe tener al entre 8 y 16 caracteres.")
        document.getElementById("guardarPass").style.visibility="hidden";
    }

}

function guardarPasswd(){
    var parametros = {
        "id":usuId.value,
        "contrasenna":usuPassword.value,
    }
    llamadaAjax("UsuarioGuardar.php?GuardarPass", objetoAParametrosParaRequest(parametros),
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var usuario = JSON.parse(xml);

            if(!usuario){
                alert("Fallo al guardar");
            }else{
                alert("Contraseña cambiada");
                document.getElementById("mostrarPass").style.visibility="hidden";
                document.getElementById("mostarCambioPass").style.visibility="visible";
            }

        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );
}

function mostrarReservas(){

    var parametros = {
        "id":usuId.value
    }

    llamadaAjax("ObtenerReservasUsuario.php", objetoAParametrosParaRequest(parametros),
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var reservas = JSON.parse(xml);

            // Se fuerza la ordenación, ya que este elemento podría no quedar ordenado si se pone al final.
            cargarReservas(reservas);
        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );
}

function cargarReservas(objeto){
    //var objeto =JSON.parse(xml);
    var tamano=objeto.length

    if(tamano !=0){
        for(var i=0;i<tamano;i++){
            var tr = document.createElement("tr");
            var tdNombre = document.createElement("td");
            var textoNombre = document.createTextNode(objeto[i].NombreHinchable);
            var tdFecha = document.createElement("td");
            var textoFecha = document.createTextNode(objeto[i].fecha);
            var tdDireccion = document.createElement("td");
            var textoDireccion = document.createTextNode(objeto[i].direccion);
            var tdCiudad = document.createElement("td");
            var textoCiudad = document.createTextNode(objeto[i].ciudad);
            var tdPrecio = document.createElement("td");
            var textoPrecio = document.createTextNode(objeto[i].precio + " €");
            var tdHoraInicial = document.createElement("td");
            var textoHoraInicial= document.createTextNode(objeto[i].horaInicial);
            var tdHoraFinal = document.createElement("td");
            var textoHoraFinal = document.createTextNode(objeto[i].horaFinal);
            var tdCancelar = document.createElement("td");
            var botonCancelar = document.createElement("button");
            botonCancelar.innerHTML= "Cancelar Reserva";
            botonCancelar.setAttribute("onclick", "cancelarReserva("+objeto[i].id+",this)");
            botonCancelar.setAttribute("class", "btnReserva");

            tdFecha.appendChild(textoFecha);
            tdNombre.appendChild(textoNombre);
            tdDireccion.appendChild(textoDireccion);
            tdCiudad.appendChild(textoCiudad);
            tdPrecio.appendChild(textoPrecio)
            tdHoraInicial.appendChild(textoHoraInicial);
            tdHoraFinal.appendChild(textoHoraFinal);
            tdCancelar.appendChild(botonCancelar);

            tr.appendChild(tdNombre);
            tr.appendChild(tdFecha);
            tr.appendChild(tdDireccion);
            tr.appendChild(tdCiudad);
            tr.appendChild(tdHoraInicial);
            tr.appendChild(tdHoraFinal);
            tr.appendChild(tdPrecio);
            tr.appendChild(tdCancelar);
            tablaReservas.appendChild(tr);

        }
        reservas.style.visibility="visible";
    }else{
        alert("No hay reservas para mostrar");
    }
}

function deleteRow(row){
    var d = row.parentNode.parentNode.rowIndex;
    document.getElementById('tablaReserva').deleteRow(d);
}

function cancelarReserva(id,i){
    var parametros = {
        "id":id
    }
    llamadaAjax("ReservasCancelar.php", objetoAParametrosParaRequest(parametros),
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var dev = JSON.parse(xml);

            if(!dev){
                alert("Fallo al borrar");
            }else{
                alert("Reserva eliminada");
               deleteRow(i)
            }

        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );
}

function edicionDatos(){
    usuApellidos.readOnly=false;
    usuNombre.readOnly=false;
    usuIdentificador.readOnly=false;
    usuTelefono.readOnly=false;

    document.getElementById("cambioDatos").style.visibility="hidden";
    document.getElementById("guardarDatos").style.visibility="visible";

}

function guardarDatos(){
    var parametros = {
        "id":usuId.value,
        "apellidos":usuApellidos.value,
        "identificador":usuIdentificador.value,
        "telefono":usuTelefono.value,
        "nombre":usuNombre.value,
    }
    llamadaAjax("UsuarioGuardar.php?guardarUsu", objetoAParametrosParaRequest(parametros),
        function(xml) {
            // Se re-crean los datos por si han modificado/normalizado algún valor en el servidor.
            var usuario = JSON.parse(xml);

            if(usuario == null){
                alert("Fallo al guardar");
            }else{
                alert("Datos cambiados");
                usuApellidos.readOnly=true;
                usuNombre.readOnly=true;
                usuIdentificador.readOnly=true;
                usuTelefono.readOnly=true;

                usuApellidos.value=usuario.apellido;
                usuNombre.value=usuario.nombre;
                usuIdentificador.value=usuario.identificador;
                usuTelefono.value=usuario.telefono;



                document.getElementById("cambioDatos").style.visibility="visible";
                document.getElementById("guardarDatos").style.visibility="hidden";
            }

        },
        function(texto) {
            alert("Error Ajax al crear: " + texto);
        }
    );
}
