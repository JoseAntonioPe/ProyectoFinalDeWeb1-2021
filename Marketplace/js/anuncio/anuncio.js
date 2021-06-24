
$(document).ready(function() {
    mostrarAnuncio();
});

function mostrarAnuncio() {
    const values = window.location.search;
    const params = new URLSearchParams(values);
    var id_anuncio = params.get('id_anuncio');
    //alert('anuncio: '+id_anuncio);
    var request = {
        'peticion' : 'obtenerAnuncio',
        'id_anuncio': id_anuncio
    };
    
    $.ajax({
        url: 'http://localhost/mp-api/anuncio.php',
        method: 'GET',
        data: request,
        success: function(response) {
            var anuncio = JSON.parse(response);
            //alert('respuesta recibidad '+anuncio.titulo);
            var contenedor = $('#contenedor_info_anuncio');
            contenedor.append('<header style="margin-bottom: 0.1em"><h2>'+anuncio.titulo+'</h2></header>');
            contenedor.append('<div><img src="data:image/png;base64,'+anuncio.fotografia+'" alt="Anuncio Fotografia" style="width: 50%;"></div>');
            contenedor.append('<div style="margin-bottom: 0.5em"><h2>Descripcion:</h2></div>');
            contenedor.append('<div><p>'+anuncio.descripcion+'</p></div>');
            contenedor.append('<div style="margin-bottom: 0.5em"><h2>Informacion:</h2></div>')
            var info = $('<div>');
            info.append('<p><strong>Vendedor: </strong>'+anuncio.nombres+' '+anuncio.apellidos+'</p>');
            info.append('<p><strong>Categoria: </strong>'+anuncio.cat_titulo+'</p>');
            info.append('<p><strong>Precio: </strong>'+anuncio.precio+' Bs.'+'</p>')
            info.append('<p><strong>Telefono: </strong>'+anuncio.telefono+'</p>');
            contenedor.append(info);
            console.log('lista obtenida!');
        },
        error: function(err) {
            console.log('no se pudo conectar al servidor!');
        }
    });
}