<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Inicio de sesión</title>
  <link rel="icon" href="servimed.ico">
  <link rel="stylesheet" href="style.css" />
</head>
<body> 
  <div class="container">
    <h2>Inicio de sesión</h2>

    <a href="index.php" style="font-weight: bold; color: #6552cf;">🏠 Volver al inicio</a>

    <form method="POST" action="controlador.php">
      
      <!-- Tipo de documento -->
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

      <!-- Número de documento -->
      <label for="numero_documento">Número de Documento:</label>
      <input type="text" id="numero_documento" name="numero_documento" required
             value="<?= isset($_COOKIE['numero_documento']) ? htmlspecialchars($_COOKIE['numero_documento']) : '' ?>">

      <!-- Nombre completo -->
      <label for="nombre_completo">Nombre Completo:</label>
      <input type="text" id="nombre_completo" name="nombre_completo" required>

      <!-- Contraseña -->
      <label for="clave">Contraseña:</label>
      <input type="password" id="clave" name="clave" required>

      <!-- Botón para enviar -->
      <button type="submit" name="login">Continuar</button>

      <!-- Recordar datos -->
      <div>
        <input type="checkbox" id="recordar" name="recordar" <?= isset($_COOKIE['numero_documento']) ? 'checked' : '' ?>>
        <label for="recordar">Recordar mis datos</label>
      </div>

      <div>
        <a href="recuperar_contraseña.php">¿Olvidaste tu contraseña?</a>
      </div>
      <div>
        <a href="register.php">¿No tienes cuenta? Regístrate aquí</a>
      </div>

      <?php if (isset($_GET['error'])): ?>
        <div class="message error"><?= htmlspecialchars($_GET['error']) ?></div>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>
