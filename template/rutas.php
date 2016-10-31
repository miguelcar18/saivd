<?php
    $carpeta = "saivd";
    $url_actual = str_replace('/'.$carpeta.'/', '', $_SERVER["REQUEST_URI"]);
    $url_actual1 = explode('/', $url_actual);
    if(isset($url_actual1[1]) && isset($url_actual1[2]))
    {
        $url_actual = $url_actual1[1].'/'.$url_actual1[2];
    }
    else if(!isset($url_actual1[0]))
    {
        $url_actual = "index.php";
    }
    //Puntos rutas
    if(isset($url_actual1[3]))
        $ruta='../../../';
    else if(isset($url_actual1[2]))
        $ruta='../../';
    else 
        $ruta='';
?>