<?php // Consulta para obtener los servicios
include 'php/conexion.php'; 

$sql = "SELECT tipo FROM Servicio"; // Cambia 'tipo' si tu columna tiene otro nombre
$result = $conn->query($sql);

// Crear un array para almacenar los servicios
$servicios = [];
if ($result->num_rows > 0) {
    // Almacenar cada fila en el array
    while ($row = $result->fetch_assoc()) {
        $servicios[] = $row['tipo'];
    }
} else {
    echo "No se encontraron servicios.";
}
$conn->close();
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
        <!-- Sección Portada -->
        <h1>¡Hola, soy ...!</h1>
        <h2>Nutricionista Graduada</h2>

        <section class="carrusel">
            <div class="carrusel-container">
                <div class="carrusel-imagenes">
                    <img src="img/carrusel1.jpg" alt="Imagen 1">
                    <img src="img/carrusel3.jpg" alt="Imagen 3">
                    <img src="img/carrusel4.jpg" alt="Imagen 4">
                    <img src="img/carrusel5.jpg" alt="Imagen 5">
                    <img src="img/carrusel6.jpg" alt="Imagen 6">
                    <img src="img/carrusel7.jpg" alt="Imagen 7">
                    <img src="img/carrusel8.jpg" alt="Imagen 8">
                    <img src="img/carrusel9.jpg" alt="Imagen 9">
                    <img src="img/carrusel2.jpg" alt="Imagen 2">
                    <img src="img/carrusel10.jpg" alt="Imagen 10">
                    <img src="img/carrusel11.jpg" alt="Imagen 11">
                </div>
            </div>
        </section>

        <section class="sobreMi">
            <div class="cover-text">
                <h3>Apasionada por la salud y el bienestar, me dedico a ayudar a las personas a alcanzar sus objetivos
                    nutricionales a través de una alimentación equilibrada y personalizada.</h3>
            </div>
        </section>

        <!-- Sección Servicios -->
        <section class="servicios">
            <h2>Descubre Mis Servicios</h2>
            <table>
                <?php if (!empty($servicios)): ?>
                    <?php foreach ($servicios as $servicio): ?>
                        <tr>
                            <td>
                                <h3><?php echo htmlspecialchars($servicio); ?></h3>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td>
                            <h3>No hay servicios disponibles.</h3>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>
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

    <script src="js/carrusel.js"></script>

</body>

</html>