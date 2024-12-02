<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
    $contraseña = $_POST['contraseña'];

    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        die("Correo electrónico no válido.");
    }

    $stmt = $conn->prepare("SELECT id, nombre, apellido, contraseña FROM tabla_usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();

        if (password_verify($contraseña, $usuario['contraseña'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['apellido'] = $usuario['apellido'];

            $log = fopen("log.txt", "a");
            fwrite($log, "Usuario " . $usuario['id'] . " inició sesión el " . date('Y-m-d H:i:s') . "\n");
            fclose($log);

            header("Location: bienvenida.php");
        } else {
            die("Contraseña incorrecta.");
        }
    } else {
        die("Correo electrónico no encontrado.");}
}
?>