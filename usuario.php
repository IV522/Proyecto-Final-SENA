<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

// Obtener nombre del usuario desde la sesión
$nombre = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Bienvenido - Usuario</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>¡Bienvenido, <?php echo htmlspecialchars($nombre); ?>!</h2>
    <p>Has iniciado sesión correctamente.</p>
    <a href="logout.php" class="boton">Cerrar sesión</a>
  </div>
</body>
</html>
