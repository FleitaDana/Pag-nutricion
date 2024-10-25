<?php
$servername = "localhost";  // O la IP de tu servidor si es un VPS
$username = "root";         // Nombre de usuario de MySQL
$password = "root";         // Contraseña de MySQL
$dbname = "proyectominutri";  // Nombre de tu base de datos
$port = 3306;               // Puerto de MySQL

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Establecer el conjunto de caracteres (para manejar bien acentos y caracteres especiales)
$conn->set_charset("utf8");
?>
