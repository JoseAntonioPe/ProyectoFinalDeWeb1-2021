<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Marketplace</h1>
        <?php
        include_once 'anuncio.php';
        $listaAnuncios = listaAnunciosPrueba();
        $array = $listaAnuncios;
        ?>
        <ul>
            <?php foreach ($listaAnuncios as $item) { ?> 
                <li><?php echo $item['titulo']; ?></li>
                <li><?php echo $item['nombres']; ?></li>
                <li><?php echo $item['apellidos']; ?></li>
                <li><?php echo $item['cat_titulo']; ?></li>
                <li><?php echo $item['precio']; ?></li>
                <li><?php echo $item['vistas']; ?></li>
                <li><?php echo $item['descripcion']; ?></li>
                <li><?php echo $item['fecha']; ?></li>
                <li><?php echo $item['telefono']; ?></li>
                <img src="data:image/png;base64,<?php echo $item['fotografia']; ?>" alt="Auto" style="width: 50%; height: 50%">
            <?php } ?>
        </ul>
    </body>
</html>
