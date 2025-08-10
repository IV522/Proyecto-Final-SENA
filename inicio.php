<?php
// Inicia la sesión para poder usar variables de sesión
session_start();

// Verifica si el usuario ha iniciado sesión correctamente
if (!isset($_SESSION['usuario_id'])) {
    // Si no hay sesión activa, muestra una alerta y redirige al login
    echo "<script>
        alert('Sesión no iniciada. Serás redirigido al login.');
        window.location.href = 'login.html';
    </script>";
    exit(); // Detiene el resto del código si no hay sesión
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio</title>

  <!-- Enlace al archivo de estilos -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">

    <!-- Título de bienvenida -->
    <h1>Bienvenido a IPS Servimed</h1>

    <!-- Mensaje de confirmación -->
    <p>Has iniciado sesión correctamente.</p>

    <!-- Enlace corregido para volver a la página principal -->
    <!-- El uso de "./index.html" asegura que se busque en la misma carpeta -->
    <a href="./index.html" style="color: #6552cf; font-weight: bold;">🏠 Volver a la página principal</a>

    <br><br>

    <!-- Enlace para cerrar sesión -->
    <a href="logout.php">Cerrar sesión</a>

  </div>
</body>
</html>
