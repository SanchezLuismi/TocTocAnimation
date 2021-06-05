window.onload = inicio;

var divFormContacto;

function inicio(){
    divFormContacto = document.getElementById("formContacto");
    document.getElementById("mostrarFormulario").addEventListener('click',mostrarFormulario);

}

function mostrarFormulario(){
    divFormContacto.style.visibility="visible";
}