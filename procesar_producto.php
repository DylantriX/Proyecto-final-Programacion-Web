<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre_producto = htmlspecialchars($_POST['nombre_producto']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $precio = floatval($_POST['precio']);
    $usuario_id = $_SESSION['usuario_id'];

    if ($precio <= 0) {
        die("El precio debe ser mayor a 0.");
    }

    $stmt = $conn->prepare("INSERT INTO productos (nombre_producto, descripcion, precio, usuario_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssdi", $nombre_producto, $descripcion, $precio, $usuario_id);

    if ($stmt->execute()) {
        header("Location: bienvenida.php");
    } else {
        die("Error al crear el producto: " . $conn->error);}
}
?>