<?php
session_start();

include 'php/conexion.php'; // Incluye tu archivo de conexión a la base de datos

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos ingresados
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para obtener el usuario
    $query = "SELECT * FROM Usuario WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verificar si el usuario existe y la contraseña es correcta
    if ($user && password_verify($password, $user['password'])) {
        // Autenticar al usuario
        $_SESSION['auth'] = true;
        header("Location: admin.php"); // Redirige al panel de administración
        exit();
    } else {
        $error = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panel de Administración</title>
    <link rel="stylesheet" href="styles/styles.css"> <!-- Enlazando el archivo CSS externo -->
</head>

<body class="fondo-login">

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
    <div class="login-container">
        <h2>Iniciar Sesión</h2>
        <!-- Mostrar mensaje de error si las credenciales son incorrectas -->
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <label for="username">Usuario:</label>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>
            <br>
            <button type="submit">Ingresar</button>
        </form>
    </div>
        </main>
</body>
</html>
