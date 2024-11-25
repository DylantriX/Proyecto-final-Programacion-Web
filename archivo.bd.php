<?php
$host = 'localhost';
$user = 'root';
$password ='';
$bdname = 'sistema_login';

$conn = new mysqli($host, $user, $password, $bdname);

if ($conn->connect_error) {
    die("Error de Conexion: ". $conn->connect_error);
}

?>