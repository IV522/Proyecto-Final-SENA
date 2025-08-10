<?php
// Iniciar sesión para verificar si el usuario ya ha iniciado sesión
session_start();

// Si el usuario ya está autenticado, lo redirigimos a su portal
if (isset($_SESSION['usuario'])) {
    header("Location: bienvenida.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>IPS Servimed</title>

  <!-- Ícono de pestaña -->
  <link rel="icon" href="servimed.ico">

  <!-- Estilos -->
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="container">

    <!-- HEADER: Logo e identidad -->
    <header>
      <div class="logo">
        <img src="https://img.icons8.com/ios-filled/50/fa314a/heart-with-pulse--v1.png" alt="Corazón" />
        <h1>IPS ServiMed</h1>
      </div>
    </header>

    <!-- SECCIÓN PRINCIPAL: Bienvenida -->
    <section class="hero">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0kigo369AKCLUVSYPBs4K54t0WQbsfL9Lmw&s" alt="Doctor" />
      <p>
        Bienvenido(a) a IPS ServiMed, una institución de salud comprometida con el bienestar y la cercanía hacia nuestros usuarios.
      </p>
    </section>

    <!-- MENÚ PRINCIPAL: Navegación entre opciones -->
    <nav class="nav-options">

      <!-- Opción: Inicio de sesión -->
      <a href="/servimed/login.php" class="option" id="loginOption">
        <img src="https://img.icons8.com/ios-filled/50/000000/user.png" alt="Login" />
        <p>Inicio de sesión</p>
      </a>

      <!-- Opción: Registro -->
      <a href="/servimed/register.php" class="option" id="Register">
        <img src="https://img.icons8.com/ios-filled/50/000000/add-user-group-man-man.png" alt="Register" />
        <p>Registrarse</p>
      </a>

      <!-- Opción: Canales de atención -->
      <div class="option">
        <img src="https://img.icons8.com/ios-filled/50/000000/phone.png" alt="Canales" />
        <p>Canales de atención</p>
      </div>

      <!-- Opción: Quejas - PQRSD -->
      <div class="option">
        <img src="https://img.icons8.com/ios-filled/50/000000/headset.png" alt="PQRSD" />
        <p>Quejas - PQRSD</p>
      </div>

      <!-- Opción: Plan Premium -->
      <div class="option">
        <img src="https://img.icons8.com/ios-filled/50/000000/medal.png" alt="Plan" />
        <p>Plan Premium</p>
      </div>

      <!-- Opción: Recuperación de contraseña -->
      <a href="/servimed/forget.html" class="option" id="forgetOption">
        <img src="https://img.icons8.com/ios-filled/50/000000/forgot-password.png" alt="Olvidó contraseña" />
        <p>¿Olvidó su contraseña?</p>
      </a>

    </nav>
  </div>
</body>
</html>
