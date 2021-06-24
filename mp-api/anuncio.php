<?php

header('Access-Control-Allow-Origin: *');

if (isset($_REQUEST['peticion'])) {
    switch ($_REQUEST['peticion']) {
        case "crearAnuncio":
            crearAnuncio();
            break;
        case "obtenerAnuncio":
            obtenerAnuncio();
            break;
        case "obtenerMisAnuncios":
            obtenerMisAnuncios();
            break;
        case "modificarAnuncio":
            modificarAnuncio();
            break;
        case "modificarAnuncioFotografia":
            modificarAnuncioFotografia();
            break;
        case "eliminarAnuncio":
            eliminarAnuncio();
            break;
        case "listaAnunciosPorTitulo":
            listaAnunciosPorTitulo();
            break;
        case "listaAnunciosPorCategoria":
            listaAnunciosPorCategoria();
            break;
        default:
            listaAnuncios();
    }
}

function crearAnuncio() {
    include_once './conexion.php';
    $id_usuario = $_POST['id_usuario'];
    $id_categoria = $_POST['id_categoria'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    //$fotografia = $_FILES['fotografia']['name'];
    $fotografia = addslashes(file_get_contents($_FILES['fotografia']['tmp_name']));
    $vistas = 0;
    $habilitado = $_POST['habilitado'];
    $query = "CALL crearAnuncio('$id_usuario', '$id_categoria', '$titulo', '$descripcion', '$precio', '$fotografia', '$vistas', '$habilitado');";
    $execute = mysqli_query($conn, $query);
    mysqli_close($conn); 
}

function modificarAnuncio() {
    include_once './conexion.php';
    $id_anuncio = $_POST['id_anuncio'];
    $id_usuario = $_POST['id_usuario'];
    $id_categoria = $_POST['id_categoria'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    //$fotografia = addslashes(file_get_contents($_FILES['fotografia']['tmp_name']));
    $habilitado = $_POST['habilitado'];
    $query = "CALL modificarAnuncio('$id_anuncio', '$id_usuario', '$id_categoria', '$titulo', '$descripcion', '$precio', '$habilitado');";
    $execute = mysqli_query($conn, $query);
    mysqli_close($conn); 
}

function modificarAnuncioFotografia() {
    include_once './conexion.php';
    $id_anuncio = $_POST['id_anuncio'];
    $id_usuario = $_POST['id_usuario'];
    $fotografia = addslashes(file_get_contents($_FILES['fotografia']['tmp_name']));
    $query = "CALL modificarAnuncioFotografia('$id_anuncio', '$id_usuario', '$fotografia');";
    $execute = mysqli_query($conn, $query);
    mysqli_close($conn); 
}

function obtenerAnuncio() {
    include_once './conexion.php';
    $id_anuncio = $_REQUEST['id_anuncio'];
    $query = "CALL obtenerAnuncio('$id_anuncio');";
    $data = mysqli_query($conn, $query);
    
    while ($row = mysqli_fetch_array($data)) {
        $anuncio = array(
            'id_anuncio' => $row['id_anuncio'],
            'id_usuario' => $row['id_usuario'],
            'nombres' => $row['nombres'],
            'apellidos' => $row['apellidos'],
            'id_categoria' => $row['id_categoria'],
            'cat_titulo' => $row['cat_titulo'],
            'titulo' => $row['titulo'],
            'descripcion' => $row['descripcion'],
            'precio' => $row['precio'],
            'fotografia' => base64_encode($row['fotografia']),
            'fecha' => $row['fecha'],
            'vistas' => $row['vistas'],
            'habilitado' => $row['habilitado'],
            'telefono' => $row['telefono']
        );
    }
    echo json_encode($anuncio);
    mysqli_close($conn);
}

function obtenerMisAnuncios() {
    include_once './conexion.php';
    $id_usuario = $_REQUEST['id_usuario'];
    $query = "CALL obtenerMisAnuncios('$id_usuario');";
    $data = mysqli_query($conn, $query);
    
    while ($row = mysqli_fetch_array($data)) {
        $misAnuncios[] = array(
            'id_anuncio' => $row['id_anuncio'],
            'id_usuario' => $row['id_usuario'],
            'nombres' => $row['nombres'],
            'apellidos' => $row['apellidos'],
            'id_categoria' => $row['id_categoria'],
            'cat_titulo' => $row['cat_titulo'],
            'titulo' => $row['titulo'],
            'descripcion' => $row['descripcion'],
            'precio' => $row['precio'],
            'fotografia' => base64_encode($row['fotografia']),
            'fecha' => $row['fecha'],
            'vistas' => $row['vistas'],
            'habilitado' => $row['habilitado'],
            'telefono' => $row['telefono']
        );
    }
    echo json_encode($misAnuncios);
    mysqli_close($conn);
}

function eliminarAnuncio() {
    include_once './conexion.php';
    $id_anuncio = $_REQUEST['id_anuncio'];
    $query = "CALL eliminarAnuncio('$id_anuncio');";
    $execute = mysqli_query($conn, $query);
    mysqli_close($conn); 
}

function listaAnuncios() {
    include_once 'conexion.php';
    $query = "CALL listaAnuncios()";
    $data = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($data)) {
        $id_anuncio = $row['id_anuncio'];
        $id_usuario = $row['id_usuario'];
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $id_categoria = $row['id_categoria'];
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
            'id_usuario' => $id_usuario,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'id_categoria' => $id_categoria,
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

function listaAnunciosPrueba() {
    include_once 'conexion.php';
    $query = "CALL listaAnuncios";
    $data = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($data)) {
        $id_anuncio = $row['id_anuncio'];
        $id_usuario = $row['id_usuario'];
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $id_categoria = $row['id_categoria'];
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
            'id_usuario' => $id_usuario,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'id_categoria' => $id_categoria,
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

    mysqli_close($conn);
    return $listaAnuncios;
}

function listaAnunciosPorTitulo() {
    include_once 'conexion.php';
    $titulo = $_GET['titulo'];
    $query = "CALL listaAnunciosPorTitulo('$titulo')";
    $data = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($data)) {
        $id_anuncio = $row['id_anuncio'];
        $id_usuario = $row['id_usuario'];
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $id_categoria = $row['id_categoria'];
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
            'id_usuario' => $id_usuario,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'id_categoria' => $id_categoria,
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

function  listaAnunciosPorCategoria() {
    include_once 'conexion.php';
    $id_categoria = $_GET['id_categoria'];
    $query = "CALL listaAnunciosPorCategoria('$id_categoria')";
    $data = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($data)) {
        $id_anuncio = $row['id_anuncio'];
        $id_usuario = $row['id_usuario'];
        $nombres = $row['nombres'];
        $apellidos = $row['apellidos'];
        $id_categoria = $row['id_categoria'];
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
            'id_usuario' => $id_usuario,
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'id_categoria' => $id_categoria,
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
