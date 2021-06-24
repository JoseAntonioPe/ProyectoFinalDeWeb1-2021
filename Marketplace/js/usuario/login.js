$("#form-login").on("submit", function(event) {
    event.preventDefault();

    var email = $("input[name=login-email]").val();
    var password = $("input[name=login-password]").val();

    var data = {
        peticion: 'verificar',
        email: email,
        password: btoa(password)
    };

    $.ajax({
        type: "post",
        url: 'http://localhost/mp-api/signup.php',
        data: data,
        success: function(response) {

            if (response > 1) {
                // Store
                sessionStorage.setItem("id_usuario", response);
                window.location = "index.html";
            } else {
                alert('No funciono');
            }
        }

    });

});