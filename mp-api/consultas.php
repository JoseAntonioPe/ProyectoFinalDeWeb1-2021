<?php
header('Access-Control-Allow-Origin: *');

if (isset($_REQUEST['peticion'])) {
    switch ($_REQUEST['peticion']) {
        case "obtenerAnunciosNuevos":
            obtenerAnunciosNuevos();
            break;
        case "obtenerMasVistosAutos":
            obtenerMasVistosAutos();
            break;
        case "obtenerMasVistosCasas":
            obtenerMasVistosCasas();
            break;
        default:
            echo 'comando desconocido';
    }
}


function obtenerAnunciosNuevos() {
    include_once 'conexion.php';
    $query = "CALL obtenerAnunciosNuevos()";
    $data = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($data)) {
        $id_anuncio = $row['id_anuncio'];
        $titulo = $row['titulo'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $fotografia = base64_encode($row['fotografia']);
        $fecha = $row['fecha'];
        $vistas = $row['vistas'];
        $habilitado = $row['habilitado'];

        $listaAnuncios[] = array(
            'id_anuncio' => $id_anuncio,
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'fotografia' => $fotografia,
            'fecha' => $fecha,
            'vistas' => $vistas,
            'habilitado' => $habilitado
        );
    }
    echo json_encode($listaAnuncios);
    mysqli_close($conn);
}

function obtenerMasVistosAutos() {
    include_once 'conexion.php';
    $query = "CALL obtenerMasVistosAutos()";
    $data = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($data)) {
        $id_anuncio = $row['id_anuncio'];
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $cat_titulo = $row['cat_titulo'];
        $titulo = $row['titulo'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $fotografia = base64_encode($row['fotografia']);
        $fecha = $row['fecha'];
        $vistas = $row['vistas'];
        $habilitado = $row['habilitado'];
        $telefono = $row['telefono'];


        $listaAnuncios[] = array(
            'id_anuncio' => $id_anuncio,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'cat_titulo' => $cat_titulo,
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'fotografia' => $fotografia,
            'fecha' => $fecha,
            'vistas' => $vistas,
            'habilitado' => $habilitado,
            'telefono' => $telefono
        );
    }
    echo json_encode($listaAnuncios);
    mysqli_close($conn);
}

function obtenerMasVistosCasas() {
        include_once 'conexion.php';
    $query = "CALL obtenerMasVistosCasas()";
    $data = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($data)) {
        $id_anuncio = $row['id_anuncio'];
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $cat_titulo = $row['cat_titulo'];
        $titulo = $row['titulo'];
        $descripcion = $row['descripcion'];
        $precio = $row['precio'];
        $fotografia = base64_encode($row['fotografia']);
        $fecha = $row['fecha'];
        $vistas = $row['vistas'];
        $habilitado = $row['habilitado'];
        $telefono = $row['telefono'];


        $listaAnuncios[] = array(
            'id_anuncio' => $id_anuncio,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'cat_titulo' => $cat_titulo,
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'fotografia' => $fotografia,
            'fecha' => $fecha,
            'vistas' => $vistas,
            'habilitado' => $habilitado,
            'telefono' => $telefono
        );
    }
    echo json_encode($listaAnuncios);
    mysqli_close($conn);
}