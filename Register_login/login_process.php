<?php
// Conexión a la base de datos (ajusta los valores según tu configuración)
$mysqli = new mysqli("localhost", "usuario_db", "contrasena_db", "nombre_db");

// Verificar la conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

// Recuperar datos del formulario
$username = $_POST['username'];
$password = $_POST['password'];

// Consultar la base de datos para verificar las credenciales
$query = "SELECT * FROM usuarios WHERE username='$username'";
$result = $mysqli->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Verificar la contraseña
    if (password_verify($password, $row['password'])) {
        echo "Inicio de sesión exitoso. ¡Bienvenido, $username!";
    } else {
        echo "Contraseña incorrecta. Inténtalo de nuevo.";
    }
} else {
    echo "Usuario no encontrado. Regístrate si no tienes una cuenta.";
}

// Cerrar la conexión
$mysqli->close();
?>
