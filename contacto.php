<?php
// Incluimos el archivo de conexión a la base de datos
include 'php/conexion.php';

// Verificamos si el formulario ha sido enviado mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario y sanitizarlos
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $consulta = $conn->real_escape_string($_POST['consulta']);
    $servicio = (int) $_POST['servicio']; // Este es el ID del servicio seleccionado

    // Sentencia SQL para insertar los datos en la tabla `Consulta`
    $sql = "INSERT INTO Consulta (nombre, apellido, telefono, servicio_id_servicio, mensaje_consulta) 
            VALUES ('$nombre', '$apellido', '$telefono', '$servicio', '$consulta')";

    // Ejecutamos la consulta
    if ($conn->query($sql) === TRUE) {
        // Si la inserción es exitosa, activamos el modal
        echo "<script>document.getElementById('modal').style.display = 'block';</script>";
    } else {
        // Si hay un error, muestramos el error
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Consultamos los servicios desde la base de datos
$servicios = [];
$sql_servicios = "SELECT id_servicio, tipo FROM Servicio";
$result = $conn->query($sql_servicios);
if ($result->num_rows > 0) {
    // Guardamos los servicios en un arreglo
    while ($row = $result->fetch_assoc()) {
        $servicios[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Nutricionista Lara</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
</head>

<body class="fondo-contacto">
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Sobre mí</a></li>
                <li><a href="recetas.php">Recetas</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="login.php">Panel de Administración</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Contactame</h1>
        <div class="container_contacto">
            <form id="formularioContacto" action="contacto.php" method="post">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="nombre" value="Escribe tu nombre..." onFocus="vaciar(this)">
                <br>

                <label for="lastname">Apellido</label>
                <input type="text" id="lastname" name="apellido" value="Escribe tu apellido.." onFocus="vaciar(this)">
                <br>

                <label for="phone">Teléfono</label>
                <input type="tel" id="phone" name="telefono" value="Escribe tu número de teléfono..." onFocus="vaciar(this)">
                <span id="message" class="validar-datos" style="display: none;">⚠️ Solo números permitidos.</span>

                <label for="service">Por cual servicio quieres contactarme?</label>
                <select id="service" name="servicio">
                    <?php
                    // Mostramos los servicios de la base de datos en el select
                    foreach ($servicios as $servicio) {
                        echo "<option value='{$servicio['id_servicio']}'>{$servicio['tipo']}</option>";
                    }
                    ?>
                </select>

                <label for="consultation">Deja tu consulta</label>
                <textarea id="consultation" name="consulta" onFocus="vaciar(this)">Deja tu consulta aquí...</textarea>

                <div class="boton-enviar">
                    <input type="submit" value="Enviar">
                </div>
            </form>
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

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Formulario enviado con éxito</p>
            <button id="modalOk">OK</button>
        </div>
    </div>

    <script src="js/validarTelefono.js"></script>
    <script src="js/vaciarCampos.js"></script>
    <script src="js/botonEnviar.js"></script>
    <script src="js/implementandoPlugin.js"></script>
</body>

</html>