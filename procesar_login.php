<?php
session_start();
require 'db.php'; // Incluye el archivo de conexión

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si los datos del formulario están presentes
    if (!isset($_POST['correo'], $_POST['contraseña'])) {
        $_SESSION['error'] = "Por favor, ingrese todos los datos requeridos.";
        header("Location: login.php");
        exit();
    }

    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Buscar usuario por correo
    $query = $conn->prepare("SELECT * FROM tabla_de_usuarios WHERE correo = ?");
    if ($query === false) {
        $_SESSION['error'] = "Error al preparar la consulta: " . $conn->error;
        printf("Error al preparar consulta: %s\n", $conn->error); // Mostrar el error de la consulta
        exit();
    }

    $query->bind_param('s', $correo);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($contraseña, $usuario['contraseña'])) {
            // Iniciar sesión
            $_SESSION['nombre'] = $usuario['nombre'];
            $_SESSION['apellido'] = $usuario['apellido'];

            $log = fopen("log.txt", "a");
            fwrite($log, "Usuario " . $usuario['id'] . " inició sesión el " . date('Y-m-d H:i:s') . "\n");
            fclose($log);

            header("Location: bienvenida.php");
            exit();
        } else {
            // Contraseña incorrecta
            $_SESSION['error'] = "Contraseña incorrecta.";
            header("Location: index.php");
            exit();
        }
    } else {
        // Correo no registrado
        $_SESSION['error'] = "El correo no está registrado.";
        header("Location: index.php");
        exit();
    }

    // Cerrar la conexión
    $query->close();
    $conn->close();
}
?>
