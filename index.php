<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registro de Usuario</h2>
        <form id="formRegistro" action="procesar_registro.php" method="POST">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" class="form-control" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
            </div>
            <div class="mb-3">
                <label for="confirmar_contraseña" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="confirmar_contraseña" name="confirmar_contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrarse</button>
            <a href="login.php" class="btn btn-secondary">Iniciar Sesión</a>
        </form>
    </div>

    <script>
        document.getElementById('formRegistro').addEventListener('submit', function(e) {
            const contraseña = document.getElementById('contraseña').value;
            const confirmarContraseña = document.getElementById('confirmar_contraseña').value;

            if (contraseña.length < 8 || !/[A-Z]/.test(contraseña) || !/[a-z]/.test(contraseña) || !/[0-9]/.test(contraseña)) {
                e.preventDefault();
                alert('La contraseña debe tener al menos 8 caracteres, una mayúscula, una minúscula y un número.');
                return;
            }

            if (contraseña !== confirmarContraseña) {
                e.preventDefault();
                alert('Las contraseñas no coinciden.');
            }
        });
    </script>
</body>
</html>
