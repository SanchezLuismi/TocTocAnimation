window.onload = inicio;
var btnEnviar,contrasenna;
function inicio(){
    btnEnviar = document.getElementById("btnEnviar");
    contrasenna = document.getElementById("contrasenna");
}

function comprobarPassword(){

    if(contrasenna.value.length > 8 && contrasenna.value.length < 16){
        btnEnviar.style.visibility="visible"
    }else{
        alert("La contraseña debe tener al entre 8 y 16 caracteres.")
        btnEnviar.style.visibility="hidden"
    }

}