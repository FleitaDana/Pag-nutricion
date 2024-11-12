<?php
session_start();
include 'php/conexion.php';

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: login.php");
    exit();
}

// Procesar el formulario de actualización de presentación
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['presentacion'])) {
        $presentacion = $_POST['presentacion'];
        $sql = "UPDATE usuario SET presentacion = ? WHERE id_usuario = 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $presentacion);
        $stmt->execute();
    }

    // Agregar un nuevo servicio
    if (isset($_POST['nuevo_servicio'])) {
        $nuevo_servicio = $_POST['nuevo_servicio'];
        $sql = "INSERT INTO Servicio (tipo) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nuevo_servicio);
        $stmt->execute();
    }

    // Eliminar servicio
if (isset($_POST['eliminar_servicio'])) {
    $id_servicio = $_POST['id_servicio'];
    $sql = "DELETE FROM Servicio WHERE id_servicio = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_servicio);
    $stmt->execute();
}

    // Eliminar receta
    if (isset($_POST['eliminar_receta'])) {
        $id_receta = $_POST['id_receta'];
        $sql = "DELETE FROM Receta WHERE id_receta = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_receta);
        $stmt->execute();
    }
}

// Obtener presentación
$sql = "SELECT presentacion FROM Usuario WHERE id_usuario = 1";
$result = $conn->query($sql);
$presentacion = $result->fetch_assoc()['presentacion'] ?? '';

// Obtener servicios
$sql = "SELECT id_servicio, tipo FROM Servicio";
$result = $conn->query($sql);
$servicios = [];
while ($row = $result->fetch_assoc()) {
    $servicios[] = $row;
}

// Obtener todas las recetas
$sql = "SELECT * FROM Receta";
$result = $conn->query($sql);
$recetas = [];
while ($row = $result->fetch_assoc()) {
    $recetas[] = $row;
}

// Obtener todas las consultas
$sql = "SELECT c.id_consulta, c.nombre, c.apellido, c.telefono, c.mensaje_consulta, s.tipo as servicio
        FROM Consulta c
        JOIN Servicio s ON c.servicio_id_servicio = s.id_servicio";
$result = $conn->query($sql);
$consultas = [];
while ($row = $result->fetch_assoc()) {
    $consultas[] = $row;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <!-- Verificar si no estamos en el panel de administración para mostrar los enlaces -->
            <?php if (basename($_SERVER['PHP_SELF']) !== 'admin.php'): ?>
                <li><a href="index.php">Sobre mí</a></li>
                <li><a href="recetas.php">Recetas</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            <?php else: ?>
                <!-- Mostrar solo el enlace de Volver en el panel de administración -->
                <li><a href="admin.php" class="disabled-link">Panel de Administración</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main class="admin-panel">
    <h1 class="admin-title">Panel de Administración</h1>

    <!-- Sección Presentación -->
    <section class="section-presentacion">
        <h2 class="section-title">Presentación</h2>
        <form method="post" class="form-section">
            <label for="presentacion" class="form-label">Texto de Presentación:</label><br>
            <textarea name="presentacion" id="presentacion" rows="4" cols="50" class="form-textarea"><?php echo htmlspecialchars($presentacion); ?></textarea><br><br>
            <button type="submit" class="btn-submit">Actualizar Presentación</button>
        </form>
    </section>
    
    <!-- Sección Servicios -->
    <section class="section-servicios">
    <h2 class="section-title">Servicios</h2>
    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Servicio</th>
            <th>Acciones</th> <!-- Tercera columna para las acciones -->
        </tr>
        <?php foreach ($servicios as $servicio): ?>
            <tr>
                <td><?php echo $servicio['id_servicio']; ?></td>
                <td><?php echo htmlspecialchars($servicio['tipo']); ?></td>
                <td>
                    <!-- Botón para eliminar el servicio -->
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="id_servicio" value="<?php echo $servicio['id_servicio']; ?>">
                        <button type="submit" name="eliminar_servicio" class="btn-delete" onclick="return confirmDeletion()">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <h3 class="section-subtitle">Agregar Nuevo Servicio</h3>
    <form method="post" class="form-section">
        <input type="text" name="nuevo_servicio" id="nuevo_servicio" required class="form-input" placeholder="Escribe aquí el nuevo servicio..."><br><br>
        <button type="submit" class="btn-submit">Agregar Servicio</button>
    </form>
</section>


    <!-- Sección Recetas -->
    <section class="section-recetas">
        <h2 class="section-title">Recetas</h2>
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Subtítulo</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($recetas as $receta): ?>
                <tr>
                    <td><?php echo $receta['id_receta']; ?></td>
                    <td><?php echo htmlspecialchars($receta['titulo']); ?></td>
                    <td><?php echo htmlspecialchars($receta['subtitulo']); ?></td>
                    <td>
                        <!-- Botones para eliminar y redirigir a editar -->

                        <form method="get" action="crear_editar_receta.php" style="display:inline;">
                            <input type="hidden" name="id_receta" value="<?php echo $receta['id_receta']; ?>">
                            <button type="submit" class="btn-edit">Editar</button>
                        </form>

                        <form method="post" style="display:inline;">
                            <input type="hidden" name="id_receta" value="<?php echo $receta['id_receta']; ?>">
                            <button type="submit" name="eliminar_receta" class="btn-delete" onclick="return confirmDeletion()">Eliminar</button>
                        </form>
        
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

        <form action="crear_editar_receta.php" method="get">
            <button type="submit" class="btn-submit">Agregar Nueva Receta</button>
        </form>
    </section>

    <!-- Sección Consultas -->
    <section class="section-consultas">
        <h2 class="section-title">Consultas Recibidas</h2>
        <table class="admin-table">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Teléfono</th>
                <th>Mensaje</th>
                <th>Servicio</th>
            </tr>
            <?php foreach ($consultas as $consulta): ?>
                <tr>
                    <td><?php echo $consulta['id_consulta']; ?></td>
                    <td><?php echo htmlspecialchars($consulta['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($consulta['apellido']); ?></td>
                    <td><?php echo htmlspecialchars($consulta['telefono']); ?></td>
                    <td><?php echo htmlspecialchars($consulta['mensaje_consulta']); ?></td>
                    <td><?php echo htmlspecialchars($consulta['servicio']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>

    
    <form action="index.php" method="get">
    <button type="submit" class="btn-cerrar-sesion">Cerrar sesión</button>
</form>
</main>

<script src="js/confirmacion_eliminar_receta.js"></script>


</body>
</html>

<?php
// Cerrar la conexión al final
$conn->close();
?>
