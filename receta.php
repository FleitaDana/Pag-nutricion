<?php

include 'php/conexion.php';

// Obtenemos el título de la receta desde la URL
$titulo = isset($_GET['titulo']) ? $conn->real_escape_string($_GET['titulo']) : null; // Escapamos el título para evitar inyecciones SQL

// Verificamos que se haya recibido un título
if (!$titulo) {
    die("No se ha especificado una receta."); // Termina el script y muestra un mensaje de error
}

// Consultamos la receta específica usando el título pasado por la URL
$sql = "SELECT titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url FROM Receta WHERE titulo = '$titulo'";
$result = $conn->query($sql); // Ejecutamos la consulta en la base de datos

// Verificamos si hubo un error en la consulta
if (!$result || $result->num_rows == 0) {
    die("Error o receta no encontrada."); // Terminamos el script y muestra un mensaje de error
}

// Obtenemos la receta
$receta = $result->fetch_assoc(); // Obtenemos los resultados de la consulta como un array asociativo
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $receta['titulo']; ?></title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <header class="recetas">
        <nav>
            <a href="recetas.php"><i class="fas fa-arrow-left"></i></a>
            <ul>
                <li><a href="index.php">Sobre mí</a></li>
                <li><a href="recetas.php">Recetas</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="login.php">Panel de Administración</a></li>
            </ul>
        </nav>
    </header>

    <!-- Inicia la sección principal para mostrar la receta -->
    <main class="receta-container">
        <img src="<?php echo $receta['imagen_url']; ?>" alt="Imagen de <?php echo $receta['titulo']; ?>" class="receta-img">
        <div class="receta-contenido">
            <h1><?php echo $receta['titulo']; ?></h1>
            <h2>Ingredientes:</h2>
            <ul>
                <?php
                // Convertimos los ingredientes en un array y mostrar
                $ingredientes = explode(',', $receta['ingredientes']);
                foreach ($ingredientes as $ingrediente) {
                    echo '<li>' . trim($ingrediente) . '</li>';
                }
                ?>
            </ul>

            <h2>Cómo preparar <?php echo strtolower($receta['titulo']); ?>, paso a paso</h2>
            <ol>
                <?php
                // Convertimos pasos en un array y mostrar
                $pasos = explode(',', $receta['pasos_a_seguir']);
                foreach ($pasos as $paso) {
                    echo '<li>' . trim($paso) . '</li>';
                }
                ?>
            </ol>
        </div>
    </main>

    <footer>
        <p>Contáctame:</p>
        <div class="iconos-wpp-ins">
            <a href="https://wa.me/1234567890" target="_blank" class="social-icon">
                <i class="fab fa-whatsapp"></i> 3764636363
            </a>
            <a href="https://www.instagram.com/_fleitadana_" target="_blank" class="social-icon">
                <i class="fab fa-instagram"></i> TuNutri2025
            </a>
        </div>
        <p>&copy; 2024 Nutricionista Lara. Todos los derechos reservados.</p>
    </footer>

</body>

</html>

<?php
// Cerrar la conexión al final
$conn->close();
?>
