<?php

header('Access-Control-Allow-Origin: *');

if (isset($_REQUEST['peticion'])) {
    switch ($_REQUEST['peticion']) {
        case "listaCategorias":
            listaCategorias();
            break;
        default:
            echo 'comando desconocido';
    }
}

function listaCategorias() {
    include_once 'conexion.php';
    $query = "CALL listaCategorias()";
    $data = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($data)) {
        $listaCategorias[] = array (    
            'id_categoria' => $row['id_categoria'],
            'cat_titulo' => $row['cat_titulo']
        );
    }
    echo json_encode($listaCategorias);
    mysqli_close($conn);
}
