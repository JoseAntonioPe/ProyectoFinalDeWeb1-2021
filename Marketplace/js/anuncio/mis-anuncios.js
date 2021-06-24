$(document).ready(function() {
    obtenerMisAnuncios();
    createModal();
    listaCategorias();
});

function listaCategorias() {
    var request = {
        'peticion' : 'listaCategorias',
    };
    $.ajax({
        url: 'http://localhost/mp-api/categoria.php',
        method: 'GET',
        data: request,
        success: function(response) {
            $.each(JSON.parse(response), function(i, item) {
                $('#categoria').append('<option value="'+item.id_categoria+'" >'+item.cat_titulo+'</option>');
            });
            console.log('connected!');
        },
        error: function(err) {
            console.log('no se pudo conectar al servidor!');
        }
    });

}

function crearAnuncio() {
    var titulo = $('#titulo').val();
    var descripcion = $('#descripcion').val();
    var categoria = $('#categoria').val();
    var precio = $('#precio').val();
    var fotografia = $('#fotografia')[0].files;
    var habilitado = $('#habilitado').val();
    var id_usuario = sessionStorage.getItem("id_usuario");
    var request = new FormData();

    request.append('peticion', 'crearAnuncio');
    request.append('id_usuario', id_usuario);
    request.append('id_categoria', categoria);
    request.append('titulo', titulo);
    request.append('descripcion', descripcion);
    request.append('precio', precio);
    request.append('fotografia', fotografia[0]);
    request.append('habilitado', habilitado);

    $.ajax({
        url: 'http://localhost/mp-api/anuncio.php',
        method: 'POST',
        data: request,
        contentType: false,
        processData: false,
        success: function(response) {
            var modal = document.getElementById("myModal");
            $('#contenedor_anuncio').empty();
            obtenerMisAnuncios();
            alert('Anuncio creado con Exito!');
            modal.style.display = "none";
        },
        error: function(err) {
            console.log('no se pudo conectar al servidor!');
        }
    });
}

function obtenerMisAnuncios() {
    var id_usuario = sessionStorage.getItem("id_usuario");
    var request = {
        'peticion' : 'obtenerMisAnuncios',
        'id_usuario': id_usuario
    };
    $.ajax({
        url: 'http://localhost/mp-api/anuncio.php',
        method: 'GET',
        data: request,
        success: function(response) {
            var table = $('<table>');
            table.attr('id', 'tabla_anuncios');
            table.attr('style', 'width: 100%;');
            var tableHeader = $('<tr>');
            tableHeader.append('<td>ID</td>');
            tableHeader.append('<td>CATEGORIA</td>');
            tableHeader.append('<td>TITULO</td>');
            tableHeader.append('<td>FOTOGRAFIA</td>');
            tableHeader.append('<td>HABILITADO</td>');
            tableHeader.append('<td>OPCIONES</td>');
            table.append(tableHeader);

            $.each(JSON.parse(response), function(i, item) {
                var row = $('<tr>');
                row.append('<td>'+item.id_anuncio+'</td>');
                row.append('<td>'+item.cat_titulo+'</td>');
                row.append('<td>'+item.titulo+'</td>');
                row.append('<td><img src="data:image/png;base64,'+item.fotografia+'" alt="Auto" style="width: 3em; height: 3em;"></td>');
                if(item.habilitado == 1) {
                    row.append('<td>'+'Habilitado'+'</td>');
                }else {
                    row.append('<td>'+'No Habilitado'+'</td>');
                }
                row.append('<td>'+
                    '<button type="button" class="btn_modificar" data-row="'+encodeURIComponent(JSON.stringify(item))+'">Modificar</button>'+
                    '<button type="button" class="btn_eliminar" data-id="'+item.id_anuncio+'" >Eliminar</button>'
                +'</td>');
                table.append(row); 
            });
            $('#contenedor_anuncio').append(table);
            console.log('lista obtenida!');
        },
        error: function(err) {
            console.log('no se pudo conectar al servidor!');
        }
    });
}

function modificarAnuncio() {
    var id_anuncio = $('#id_anuncio').val();
    var titulo = $('#titulo').val();
    var descripcion = $('#descripcion').val();
    var categoria = $('#categoria').val();
    var precio = $('#precio').val();
    var habilitado = $('#habilitado').val();
    var id_usuario = sessionStorage.getItem("id_usuario");
    var request = {
        'peticion': 'modificarAnuncio',
        'id_anuncio': id_anuncio,
        'id_usuario': id_usuario,
        'id_categoria' : categoria,
        'titulo' : titulo,
        'descripcion': descripcion,
        'precio': precio,
        'habilitado': habilitado
    };

    $.ajax({
        url: 'http://localhost/mp-api/anuncio.php',
        method: 'POST',
        data: request,
        success: function(response) {
            var modal = document.getElementById("myModal");
            $('#contenedor_anuncio').empty();
            obtenerMisAnuncios();
            alert('Anuncio Modificado con Exito!');
            modal.style.display = "none";
        },
        error: function(err) {
            console.log('no se pudo conectar al servidor!');
        }
    });
}

$(document).on('click', '[class=btn_modificar]', function() {
    $('#btn_modificar_anuncio').show();
    $('#btn_registrar').hide();
    var data = $(this).data('row');
    var anuncio = JSON.parse(decodeURIComponent(data));
    var modal = document.getElementById("myModal");

    $('#fotografia').hide();
    $('#label_fotografia').hide();

    $('#id_anuncio').val(anuncio.id_anuncio);
    $('#titulo').val(anuncio.titulo);
    $('#descripcion').val(anuncio.descripcion);
    $('#categoria').val(anuncio.id_categoria);
    $('#precio').val(anuncio.precio);
    $('#habilitado').val(anuncio.habilitado);
    
    modal.style.display = "block";
});

$(document).on('click', '[class=btn_eliminar]', function(){
    var id = $(this).data('id');
    var request = {
        'peticion' : 'eliminarAnuncio',
        'id_anuncio' : id
    };
    if(confirm('Esta seguro de eliminar este registro?')){
        $.ajax({
            url: 'http://localhost/mp-api/anuncio.php',
            method: 'GET',
            data: request, 
            success: function(response) {
                alert('Anuncio Eliminado con Exito!');
                $('#contenedor_anuncio').empty();
                obtenerMisAnuncios();
            },
            error: function(err) {
                console.log('no se pudo conectar al servidor!');
            }
        });
    }
});

function createModal() {
     // Get the modal
    var modal = document.getElementById("myModal");

     // Get the button that opens the modal
    var btn = document.getElementById("myBtn");
      // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    var btn_registrar = document.getElementById("btn_registrar");

    var btn_modificar_anuncio = document.getElementById("btn_modificar_anuncio");

    btn_registrar.onclick = function(e) {
        e.preventDefault(); 
        crearAnuncio();
    }

    btn_modificar_anuncio.onclick = function(e) {
        e.preventDefault();
        modificarAnuncio();
    }

     // When the user clicks the button, open the modal 
    btn.onclick = function() {
        $('#form_anuncio')[0].reset();
        modal.style.display = "block";
        $('#label_fotografia').show();
        $('#fotografia').show();
        
        btn_modificar_anuncio.style.display = "none";
        btn_registrar.style.display = "block";
    }
    
     // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
     // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}


