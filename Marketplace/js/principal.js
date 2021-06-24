$(document).ready(function() {
    obtenerAnunciosNuevos();
    obtenerMasVistosCasas();
    obtenerMasVistosAutos();
});
function obtenerMasVistosAutos() {
    var request = {
        'peticion' : 'obtenerMasVistosAutos',
    };
    
    $.ajax({
        url: 'http://localhost/mp-api/consultas.php',
        method: 'GET',
        data: request,
        success: function(response) {
            $('#contenedor_principal').append('<div class="seccion-encabezado"><h2>Anuncios Mas Vistos en Vehiculos</h2></div>');
            var contenedor = $('<section>');
            contenedor.attr('class', 'seccion-contenedor');
            
            $.each(JSON.parse(response), function(i, item) {
                if(item.habilitado == 1) {
                    var article = $('<article>');
                    article.append('<header><h3>'+item.titulo+'</h3></header>');
                    article.append('<div><img src="data:image/png;base64,'+item.fotografia+'" alt="Anuncio Fotografia"></div>');
                    var footer = $('<footer>');
                    footer.append('<p><strong>Bs. '+item.precio+'</strong></p>');
                    footer.append('<a href="anuncio.html?id_anuncio='+item.id_anuncio+'">Ver Anuncio</a>');
                    article.append(footer); 
                    contenedor.append(article);
                }
            });
            $('#contenedor_principal').append(contenedor);
            console.log('lista obtenida!');
        },
        error: function(err) {
            console.log('no se pudo conectar al servidor!');
        }
    });
}

function obtenerMasVistosCasas() {
    var request = {
        'peticion' : 'obtenerMasVistosCasas',
    };
    
    $.ajax({
        url: 'http://localhost/mp-api/consultas.php',
        method: 'GET',
        data: request,
        success: function(response) {
            $('#contenedor_principal').append('<div class="seccion-encabezado"><h2>Anuncios Mas Vistos en Inmuebles</h2></div>');
            var contenedor = $('<section>');
            contenedor.attr('class', 'seccion-contenedor');
            
            $.each(JSON.parse(response), function(i, item) {
                if(item.habilitado == 1) {
                    var article = $('<article>');
                    article.append('<header><h3>'+item.titulo+'</h3></header>');
                    article.append('<div><img src="data:image/png;base64,'+item.fotografia+'" alt="Anuncio Fotografia"></div>');
                    var footer = $('<footer>');
                    footer.append('<p><strong>Bs. '+item.precio+'</strong></p>');
                    footer.append('<a href="anuncio.html?id_anuncio='+item.id_anuncio+'">Ver Anuncio</a>');
                    article.append(footer); 
                    contenedor.append(article);
                }
            });
            $('#contenedor_principal').append(contenedor);
            console.log('lista obtenida!');
        },
        error: function(err) {
            console.log('no se pudo conectar al servidor!');
        }
    });
}

function obtenerAnunciosNuevos() {
    var request = {
        'peticion' : 'obtenerAnunciosNuevos',
    };
    
    $.ajax({
        url: 'http://localhost/mp-api/consultas.php',
        method: 'GET',
        data: request,
        success: function(response) {
            $('#contenedor_principal').append('<div class="seccion-encabezado"><h2>Anuncios Nuevos</h2></div>');
            var contenedor = $('<section>');
            contenedor.attr('class', 'seccion-contenedor');
            
            $.each(JSON.parse(response), function(i, item) {
                if(item.habilitado == 1) {
                    var article = $('<article>');
                    article.append('<header><h3>'+item.titulo+'</h3></header>');
                    article.append('<div><img src="data:image/png;base64,'+item.fotografia+'" alt="Anuncio Fotografia"></div>');
                    var footer = $('<footer>');
                    footer.append('<p><strong>Bs. '+item.precio+'</strong></p>');
                    footer.append('<a href="anuncio.html?id_anuncio='+item.id_anuncio+'">Ver Anuncio</a>');
                    article.append(footer); 
                    contenedor.append(article);
                }
            });
            $('#contenedor_principal').append(contenedor);
            console.log('lista obtenida!');
        },
        error: function(err) {
            console.log('no se pudo conectar al servidor!');
        }
    });
}

