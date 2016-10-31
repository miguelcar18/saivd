<?php
define('_HOST_NAME','localhost');
define('_DATABASE_NAME','karla');
define('_DATABASE_USER_NAME','root');
define('_DATABASE_PASSWORD','');

$conexion = new mysqli(_HOST_NAME,_DATABASE_USER_NAME,_DATABASE_PASSWORD,_DATABASE_NAME) or die("ERROR : -> ".$conexion->connect_error);
mysqli_set_charset($conexion, "utf8");