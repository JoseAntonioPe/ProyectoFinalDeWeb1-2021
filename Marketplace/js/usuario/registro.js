$("#form-registro").on("submit", function(event){
    event.preventDefault();

    var nombres = $("input[name=form-nombres]").val();
    var apellidos = $("input[name=form-apellidos]").val();
    var password = $("input[name=form-password]").val();
    var email = $("input[name=form-email]").val();
    var telefono = $("input[name=form-telefono]").val();
    
    
    var data = {
        peticion : 'create',
        nombres : nombres,
        apellidos : apellidos,
        email : email,
        password:  btoa(password),
        telefono : telefono
    };

    $.ajax({
        type: "post",
        url: 'http://localhost/mp-api/usuario.php',
        data: data,
        success: function(response) {
            window.location.href = "login.html";
        }
        
    });
    
});