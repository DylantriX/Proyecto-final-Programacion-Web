<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'sistema_registro_login';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de Conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4"); 
?>
