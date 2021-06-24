$(document).ready(function() {
    //alert('id '+sessionStorage.getItem("id_usuario"));
    
    if (sessionStorage.getItem("id_usuario") != null) {
        $('#btn-publicar').show();
        $('#btn-login').hide();
        $('#btn-salir').show();
    }else{
        $('#btn-publicar').hide();
        $('#btn-login').show();
        $('#btn-salir').hide();
    }
    
});


$('#btn-salir').on('click', function () {
    //sessionStorage.removeItem("id_usuario");
    sessionStorage.clear();
    window.location = "index.html";
});

//