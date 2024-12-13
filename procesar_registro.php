<?php
session_start();
require 'db.php'; // Incluye el archivo de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si los datos están en POST
    if (!isset($_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['contraseña'])) {
        $_SESSION['error'] = "Faltan datos del formulario.";
        header("Location: index.php");
        exit();
    }

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Validación del correo (por ejemplo, si ya está registrado)
    $query = $conn->prepare("SELECT * FROM tabla_de_usuarios WHERE correo = ?");
    if ($query === false) {
        $_SESSION['error'] = "Error al preparar la consulta de búsqueda: " . $conn->error;
        printf("Error al preparar consulta: %s\n", $conn->error);
        exit();
    }
    $query->bind_param('s', $correo);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "El correo electrónico ya está registrado.";
        header("Location: index.php");
        exit();
    }

    // Hash de la contraseña
    $hash_contraseña = password_hash($contraseña, PASSWORD_BCRYPT);

    // Insertar usuario en la base de datos
    $insert = $conn->prepare("INSERT INTO tabla_de_usuarios (nombre, apellido, correo, contraseña) VALUES (?, ?, ?, ?)");
    if ($insert === false) {
        $_SESSION['error'] = "Error al preparar la consulta de inserción: " . $conn->error;
        printf("Error al preparar consulta: %s\n", $conn->error);
        exit();
    }

    // Vincular parámetros y ejecutar
    $insert->bind_param('ssss', $nombre, $apellido, $correo, $hash_contraseña);
    if ($insert->execute()) {
        $_SESSION['success'] = "Registro exitoso. Ahora puedes iniciar sesión.";
        header("Location: login.php");
    } else {
        $_SESSION['error'] = "Error al registrar el usuario: " . $insert->error;
        printf("Error al ejecutar la consulta: %s\n", $insert->error); // Mostrar el error específico
        header("Location: index.php");
        exit();
    }

    // Cerrar las conexiones
    $query->close();
    $insert->close();
    $conn->close();
}
?>
