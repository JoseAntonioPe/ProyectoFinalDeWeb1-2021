
$(document).ready(function() {
    cargarAnuncios();
});

function cargarAnuncios() {
    const values = window.location.search;
    const params = new URLSearchParams(values);
    var titulo = params.get('busqueda');

    var request = {
        'peticion' : 'listaAnunciosPorTitulo',
        'titulo': titulo
    };
    
    $.ajax({
        url: 'http://localhost/mp-api/anuncio.php',
        method: 'GET',
        data: request,
        success: function(response) {
            $.each(JSON.parse(response), function(i, item) {
                if(item.habilitado == 1) {
                    var article = $('<article>');
                    article.append('<header><h3>'+item.titulo+'</h3></header>');
                    article.append('<div><img src="data:image/png;base64,'+item.fotografia+'" alt="Anuncio Fotografia"></div>');
                    var footer = $('<footer>');
                    footer.append('<p><strong>Bs. '+item.precio+'</strong></p>');
                    footer.append('<a href="anuncio.html?id_anuncio='+item.id_anuncio+'">Ver Anuncio</a>');
                    article.append(footer); 
                    $('.seccion-contenedor').append(article);
                }
            });
            console.log('lista obtenida!');
        },
        error: function(err) {
            console.log('no se pudo conectar al servidor!');
        }
    });
}