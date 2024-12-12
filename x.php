<?php // URL de la API 
        
$url = "https:/ /pokeapi.co/api/v2/pokemon/ditto"; // Realizar la solicitud a la API 
        
$response = file_get_contents($url); if ($response === FALSE) { 
    echo "<div class='alert alert-danger'>No se pudo obtener la información del Pokémon.</div>";
} else { // Convertir la respuesta JSON a un array asociativo 
    $pokemon = json_decode($response, true); // Mostrar información relevante 
    echo "<div class='card shadow-sm p-4'>"; 
    echo "<div clase='fila'>"; 
    echo "<div class='col-md-4 text-center'>"; 
    echo "<img src='" . $pokemon['sprites']['front_default'] . "' alt='Imagen de Ditto' class='img-fluid rounded'>"; 
    echo "</div>"; 
    echo "<div class='col-md-8'>"; 
    echo "<h2 class='text-secundario'>Nombre: ". ucfirst($pokemon['nombre']) . "</h2>";
    echo "<p><strong>ID:<strong>Altura:</strong> " . $pokemon['id'] . "</p>";
    echo "<p><strong>Peso:</strong> " . $pokemon['weight'] . "</p>"; // Mostrar habilidades 
    echo "<p><strong>Habilidades:</strong></p>"; 
    echo "<ul>"; 
    foreach ($pokemon['abilities'] as $ability) { 
        echo "<li>" . ucfirst($ability['ability']['name']) . "</li>"; 
    } 
    echo "</ul>"; 
    echo "</div>"; 
    echo "</div>"; 
    echo "</div>";
} 
?>