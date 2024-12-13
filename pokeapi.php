<?php
session_start();
if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}

// Función para obtener datos del Pokémon desde la API
function obtenerPokemon($nombrePokemon) {
    $url = "https://pokeapi.co/api/v2/pokemon/" . strtolower(trim($nombrePokemon));
    
    // Inicializar cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $respuesta = curl_exec($ch);
    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpStatus !== 200) {
        return null; // Retorna null si no se puede obtener el Pokémon
    }
    
    return json_decode($respuesta, true);
}

// Verificar si se envió el nombre del Pokémon
$pokemonHtml = "";
if (isset($_GET['nombrePokemon']) && !empty($_GET['nombrePokemon'])) {
    $nombrePokemon = $_GET['nombrePokemon'];
    $pokemon = obtenerPokemon($nombrePokemon);

    // Generar el contenido HTML basado en la existencia del Pokémon
    if ($pokemon) {
        $habilidades = "";
        foreach ($pokemon['abilities'] as $ability) {
            $habilidades .= "<li>" . ucfirst($ability['ability']['name']) . "</li>";
        }

        $pokemonHtml = "
            <div class='card shadow-sm p-4'>
                <div class='row'>
                    <div class='col-md-4 text-center'>
                        <img src='{$pokemon['sprites']['front_default']}' alt='Imagen de " . ucfirst($pokemon['name']) . "' class='img-fluid rounded'>
                    </div>
                    <div class='col-md-8'>
                        <h2 class='text-secondary'>Nombre: " . ucfirst($pokemon['name']) . "</h2>
                        <p><strong>ID:</strong> {$pokemon['id']}</p>
                        <p><strong>Altura:</strong> {$pokemon['height']} decímetros</p>
                        <p><strong>Peso:</strong> {$pokemon['weight']} hectogramos</p>
                        <p><strong>Habilidades:</strong></p>
                        <ul>{$habilidades}</ul>
                    </div>
                </div>
            </div>
        ";
    } else {
        $pokemonHtml = "<div class='alert alert-danger'>No se pudo obtener la información del Pokémon. Verifique el nombre ingresado.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémon Info</title>
    <!-- Agregar Bootstrap desde un CDN -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Pokémon Info</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <!-- Botón para regresar a bienvenida.php -->
      <li class="nav-item">
        <a class="nav-link" href="bienvenida.php">Volver a Bienvenida</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Contenedor principal -->
<div class="container mt-5">
    <form method="GET" action="">
        <div class="form-group">
            <label for="nombrePokemon">Nombre del Pokémon:</label>
            <input type="text" class="form-control" id="nombrePokemon" name="nombrePokemon" placeholder="Ingresa el nombre del Pokémon">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <!-- Mostrar el resultado -->
    <div class="mt-4">
        <?php echo $pokemonHtml; ?>
    </div>
</div>

<!-- Incluir el script de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>