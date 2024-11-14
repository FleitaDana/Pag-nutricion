<?php
session_start();
include 'php/conexion.php';

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['auth']) || $_SESSION['auth'] !== true) {
    header("Location: login.php");
    exit();
}

// Procesamos formulario al enviar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'] ?? $_POST['nuevo_titulo'];
    $subtitulo = $_POST['subtitulo'] ?? $_POST['nuevo_subtitulo'];
    $ingredientes = $_POST['ingredientes'] ?? $_POST['nuevo_ingredientes'];
    $pasos = $_POST['pasos'] ?? $_POST['nuevo_pasos'];
    $id_receta = $_POST['id_receta'] ?? null;

    // Manejamos de la carga de imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        $directorio = 'img/';
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $rutaArchivo = $directorio . uniqid() . "_" . $nombreArchivo;

        // Movemos el archivo subido al directorio de destino
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo)) {
            $imagen_url = $rutaArchivo;
        } else {
            echo "Error al cargar la imagen.";
            exit();
        }
    } else {
        $imagen_url = $id_receta ? $_POST['imagen_actual'] : null;
    }

    if ($id_receta) {
        // Editar receta
        $sql = "UPDATE Receta SET titulo = ?, subtitulo = ?, ingredientes = ?, pasos_a_seguir = ?, imagen_url = ? WHERE id_receta = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $titulo, $subtitulo, $ingredientes, $pasos, $imagen_url, $id_receta);
        $stmt->execute();
    } else {
        // Crear nueva receta
        $sql = "INSERT INTO Receta (titulo, subtitulo, ingredientes, pasos_a_seguir, imagen_url) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $titulo, $subtitulo, $ingredientes, $pasos, $imagen_url);
        $stmt->execute();
    }
    header("Location: admin.php");
    exit();
}

// Si se está editando, obtenemos los datos de la receta
$id_receta = $_GET['id_receta'] ?? null;
$receta = null;
if ($id_receta) {
    $sql = "SELECT * FROM Receta WHERE id_receta = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_receta);
    $stmt->execute();
    $result = $stmt->get_result();
    $receta = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $id_receta ? 'Editar Receta' : 'Crear Receta'; ?></title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>

<header>
    <nav>
        <ul>
            <?php if (basename($_SERVER['PHP_SELF']) !== 'crear_editar_receta.php'): ?>
                <li><a href="index.php">Sobre mí</a></li>
                <li><a href="recetas.php">Recetas</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            <?php else: ?>
                <li><a href="admin.php" class="disabled-link">Panel de Administración</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<main class="admin-panel">
    <h1><?php echo $id_receta ? 'Editar Receta' : 'Crear Receta'; ?></h1>

    <form method="post" enctype="multipart/form-data" class="editar-crear-receta">
        <?php if ($id_receta): ?>
            <input type="hidden" name="id_receta" value="<?php echo $receta['id_receta']; ?>">
            <input type="hidden" name="imagen_actual" value="<?php echo htmlspecialchars($receta['imagen_url'] ?? ''); ?>">
        <?php endif; ?>

        <label for="titulo">Título:</label><br>
        <input type="text" name="titulo" id="titulo" value="<?php echo htmlspecialchars($receta['titulo'] ?? ''); ?>" required><br><br>

        <label for="subtitulo">Subtítulo:</label><br>
        <input type="text" name="subtitulo" id="subtitulo" value="<?php echo htmlspecialchars($receta['subtitulo'] ?? ''); ?>" required><br><br>

        <label for="ingredientes">Ingredientes:</label><br>
        <textarea name="ingredientes" id="ingredientes" rows="4" placeholder="Ingrese los ingredientes aquí separados por coma" required><?php echo htmlspecialchars($receta['ingredientes'] ?? ''); ?></textarea><br><br>

        <label for="pasos">Pasos:</label><br>
        <textarea name="pasos" id="pasos" rows="4" placeholder="Ingrese los pasos a seguir aquí separados por coma" required><?php echo htmlspecialchars($receta['pasos_a_seguir'] ?? ''); ?></textarea><br><br>

        <label for="imagen">Imagen de la receta:</label><br>
        <input type="file" name="imagen" id="imagen" accept="image/*"><br><br>
        
        <?php if ($id_receta && !empty($receta['imagen_url'])): ?>
            <p>Imagen actual:</p>
            <img src="<?php echo htmlspecialchars($receta['imagen_url']); ?>" alt="Imagen actual" width="100"><br><br>
        <?php endif; ?>

        <button type="submit"><?php echo $id_receta ? 'Actualizar Receta' : 'Crear Receta'; ?></button>

        <form action="admin.php" method="get">
            <button type="submit" class="btn-volver">Volver al Panel de Administración</button>
        </form>
    </form>
</main>

<script src="js/validarCamposRecetas.js"></script>

</body>
</html>
