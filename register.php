<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario - IPS Servimed</title>
  <link rel="icon" href="servimed.ico">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Registro de nuevo usuario</h2>

    <!-- Enlace para volver al inicio -->
    <a href="index.php" style="font-weight: bold; color: #6552cf;">🏠 Volver al inicio</a>

    <!-- Formulario de registro -->
    <form method="POST" action="procesar_registro.php">

      <!-- Tipo de Documento -->
      <label for="tipo_documento">Tipo de Documento:</label>
      <select id="tipo_documento" name="tipo_documento" required>
        <option value="">Seleccione...</option>
        <option value="cc">Cédula de Ciudadanía</option>
        <option value="ti">Tarjeta de Identidad</option>
        <option value="rc">Registro Civil</option>
        <option value="ce">Cédula de Extranjería</option>
        <option value="pa">Pasaporte</option>
        <option value="nuip">NUIP</option>
        <option value="ppt">Permiso de Protección Personal</option>
      </select>

      <!-- Número de Documento -->
      <label for="numero_documento">Número de Documento:</label>
      <input type="text" id="numero_documento" name="numero_documento" required>

      <!-- Nombre de Usuario -->
      <label for="usuario">Nombre Completo:</label>
      <input type="text" id="usuario" name="usuario" required>

      <!-- Correo Electrónico -->
      <label for="correo">Correo electrónico:</label>
      <input type="email" id="correo" name="correo" required>

      <!-- Contraseña -->
      <label for="clave">Contraseña:</label>
      <input type="password" id="clave" name="clave" required>

      <!-- Botón de envío -->
      <button type="submit" name="registrar">Registrarse</button>

      <!-- Enlace a inicio de sesión -->
      <div style="margin-top: 10px;">
        <a href="login.php">¿Ya tienes cuenta? Inicia sesión aquí</a>
      </div>
    </form>
  </div>
</body>
</html>
