<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $contraseña = $_POST['contraseña'];
    $confirmar_contraseña = $_POST['confirmar_contraseña'];

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Correo electrónico no válido.");
    }
    if ($contraseña !== $confirmar_contraseña) {
        die("Las contraseñas no coinciden.");
    }
    if (strlen($contraseña) < 8 || !preg_match('/[A-Z]/', $contraseña) || !preg_match('/[a-z]/', $contraseña) || !preg_match('/[0-9]/', $contraseña)) {
        die("La contraseña no cumple con los requisitos.");
    }

    $contraseñaHash = password_hash($contraseña, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO tabla_de_usuarios (nombre, apellido, correo, contraseña) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $apellido, $correo, $contraseñaHash);

    if ($stmt->execute()) {
        header("Location: login.php");
    } else {
        die("Error al registrar usuario: " . $conn->error);}
}
?>