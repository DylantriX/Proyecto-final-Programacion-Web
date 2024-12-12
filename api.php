<?php session_start();
    if (!isset($_SESSION['usuario_id'])) {
        header("Ubicación: login.php");
        exit();
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

<!-- Contenedor principal con la información del Pokémon -->
<div class="container mt-5" id="pokemon-info">
    <div class="alert alert-info">Cargando datos del Pokémon...</div>
</div>

<!-- Incluir el script de Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // URL de la API
    const url = 'https://pokeapi.co/api/v2/pokemon/ditto';

    // Hacer la solicitud con fetch
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('No se pudo obtener la información del Pokémon');
            }
            return response.json(); // Convertir la respuesta a formato JSON
        })
        .then(pokemon => {
            // Una vez que obtenemos los datos, mostramos la información
            const pokemonInfo = `
                <div class="card shadow-sm p-4">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="${pokemon.sprites.front_default}" alt="Imagen de Ditto" class="img-fluid rounded">
                        </div>
                        <div class="col-md-8">
                            <h2 class="text-secondary">Nombre: ${capitalizeFirstLetter(pokemon.name)}</h2>
                            <p><strong>ID:</strong> ${pokemon.id}</p>
                            <p><strong>Altura:</strong> ${pokemon.height}</p>
                            <p><strong>Peso:</strong> ${pokemon.weight}</p>
                            <p><strong>Habilidades:</strong></p>
                            <ul>
                                ${pokemon.abilities.map(ability => `<li>${capitalizeFirstLetter(ability.ability.name)}</li>`).join('')}
                            </ul>
                        </div>
                    </div>
                </div>
            `;

            // Actualizar el contenido del contenedor con la nueva información
            document.getElementById('pokemon-info').innerHTML = pokemonInfo;
        })
        .catch(error => {
            // En caso de error, mostrar un mensaje
            document.getElementById('pokemon-info').innerHTML = `
                <div class="alert alert-danger">${error.message}</div>
            `;
        });

    // Función para capitalizar la primera letra del texto
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
</script>

</body>
</html>
