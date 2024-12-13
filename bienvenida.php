<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#">PokeApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link btn btn-danger text-white px-3 py-1 ms-2" href="cerrar_sesion.php">Cerrar Sesión</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenido Principal -->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8 mx-auto text-center">
            <h1 class="text-primary">Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?>!</h1>
            <p class="lead mt-3">Esta aplicación utiliza la <strong>PokeAPI</strong>, una API que permite obtener información sobre Pokémon, como su altura, peso, habilidades, y mucho más.</p>
            <hr class="my-4">
            <h2 class="text-secondary">¿Cómo funciona la PokeAPI?</h2>
            <p class="mt-3">
                La PokeAPI es un servicio gratuito que expone datos relacionados con Pokémon mediante una interfaz RESTful. A través de esta API, puedes consultar detalles sobre los Pokémon usando su nombre o ID único.
            </p>
            <p>Algunos ejemplos de información que puedes obtener:</p>
            <ul class="list-group list-group-flush text-start">
                <li class="list-group-item">Nombre y clasificación del Pokémon.</li>
                <li class="list-group-item">Altura y peso.</li>
                <li class="list-group-item">Tipos y habilidades.</li>
                <li class="list-group-item">Imágenes representativas del Pokémon.</li>
            </ul>
            <div class="mt-4">
                <a href="pokeapi.php" class="btn btn-primary btn-lg">Explorar la API</a>
            </div>
            <hr class="my-5">

            <!-- Tabla de Desarrolladores -->
            <h2 class="text-secondary">Conoce a los desarrolladores</h2>
            <table class="table table-bordered table-striped mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="img/Ancor.jpg" alt="Desarrollador 1" class="img-fluid rounded" style="width: 100px;"></td>
                        <td>Ancor Gonzalez</td>
                        <td>Desarrollador de pagina inicio y registro</td>
                    </tr>
                    <tr>
                        <td><img src="img/Dylan.jpg" alt="Desarrollador 2" class="img-fluid rounded" style="width: 100px;"></td>
                        <td>Dylan Hernandez</td>
                        <td>Desarrollador de la pagina de Bienvenida</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
