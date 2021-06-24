<?php
    header('Access-Control-Allow-Origin: *');
    if (isset($_REQUEST['peticion'])) {
        switch ($_REQUEST['peticion']) {
            case "verificar":
                verificar();
            break;
            default:
                echo 'no request';
        }
    }  
     
    function verificar() {
        header('Access-Control-Allow-Origin: *');
        include_once 'conexion.php';
        
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];
        
        if ($email != "" && $password != ""){

            $sql_query = "select count(*) as cntUser, id_usuario from usuario where email='".$email."' and password='".$password."'";
            $result = mysqli_query($conn, $sql_query);
            $row = mysqli_fetch_array($result);
        
            $count = $row['cntUser'];
        
            if($count > 0) {
                echo $row['id_usuario'];
            }else{
                echo 0;
            }
        
        }
        
    }
?>