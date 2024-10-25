<?php
// Incluir la conexión a la base de datos
include 'php/conexion.php';  // Cambia la ruta si es necesario

// Consultar las recetas en la base de datos
$sql = "SELECT titulo, subtitulo, imagen_url FROM receta";
$result = $conn->query($sql);

// Verificar si hubo un error en la consulta
if (!$result) {
    die("Error en la consulta: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutricionista Lara</title>
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">Sobre mí</a></li>
                <li><a href="recetas.php">Recetas</a></li>
                <li><a href="contacto.html">Contacto</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Recetas saludables</h1>

        <section id="recetas">
            <div class="recetas-container">
                <?php
                // Verificar si hay recetas en la base de datos
                if ($result->num_rows > 0) {
                    // Recorrer las recetas y mostrarlas en HTML
                    while ($row = $result->fetch_assoc()) {
                        // Asumiendo que la columna "titulo" o "imagen_url" se utiliza para decidir la redirección
                        $titulo = strtolower(str_replace(' ', '', $row["titulo"])); // Formatear el título para el nombre del archivo
                        echo '<a href="' . $titulo . '.php" class="recetas-box">'; // Cambia la ruta según sea necesario
                        echo '<img src="' . $row["imagen_url"] . '" alt="' . $row["titulo"] . '">';
                        echo '<h3>' . $row["titulo"] . '</h3>';
                        echo '<p>' . $row["subtitulo"] . '</p>';
                        echo '</a>'; // Cerrar el enlace
                    }
                } else {
                    echo "<p>No hay recetas disponibles en este momento.</p>";
                }

                // Cerrar la conexión al final
                $conn->close();
                ?>
            </div>
        </section>
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
