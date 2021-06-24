<?php

header('Access-Control-Allow-Origin: *');
if (isset($_REQUEST['peticion'])) {
    switch ($_REQUEST['peticion']) {
        case "create":
            crearUsuario();
            break;
        case "get":
            echo "obtenerDatosIndividual";
            break;
        case "update":
            echo "actualizar usuario";
            break;
        case "delete":
            echo "borrar usuario";
            break;
        default:
            obtenerTodo();
    }
}

function obtenerTodo() {
    include_once 'conexion.php';
    $query = "SELECT * FROM usuario";
    $data = mysqli_query($conn, $query);
    $listaUsuario = array();

    while ($row = mysqli_fetch_array($data)) {
        $usuarioId = $row['usuarioId'];
        $nombreCompleto = $row['nombreCompleto'];
        $username = $row['username'];
        $password = $row['password'];
        $tipoUsuario = $row['tipoUsuario'];

        $listaUsuario[] = array('usuarioId' => $usuarioId, 'nombreCompleto' => $nombreCompleto, 'username' => $username, 'password' => $password, 'tipoUsuario' => $tipoUsuario);
    }
    echo json_encode($listaUsuario);
    mysqli_close($conn);
}

function crearUsuario() {
    include_once 'conexion.php';
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];
    $query = "CALL registrarUsuario('$nombres', '$apellidos', '$email', '$password', '$telefono');";

    if (mysqli_query($conn, $query)) {
        echo json_encode(array("statusCode" => 200));
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
