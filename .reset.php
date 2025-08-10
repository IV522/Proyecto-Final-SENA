<?php
include("conexion_bd.php");

// Si se envió el formulario con nueva contraseña
if (isset($_POST['actualizar_clave'])) {
    $token = $_POST['token'];
    $nueva_clave = $_POST['nueva_clave'];

    // Encriptar contraseña antes de guardar
    $clave_encriptada = password_hash($nueva_clave, PASSWORD_DEFAULT);

    // Actualizar en la base de datos y eliminar el token
    $stmt = $conexion->prepare("UPDATE usuarios SET clave = ?, token_recuperacion = NULL WHERE token_recuperacion = ?");
    $stmt->bind_param("ss", $clave_encriptada, $token);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo "✅ Contraseña actualizada. <a href='login.html'>Inicia sesión</a>";
    } else {
        echo "❌ Token inválido o expirado.";
    }

    $stmt->close();
}

// Si se recibe el token por GET, mostrar formulario
elseif (isset($_GET['token'])) {
    $token = $_GET['token'];

    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE token_recuperacion = ?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h2>Restablecer contraseña</h2>
    <form method="POST" action="reset.php">
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
      <label for="nueva_clave">Nueva contraseña:</label>
      <input type="password" name="nueva_clave" required>
      <button type="submit" name="actualizar_clave">Actualizar contraseña</button>
    </form>
  </div>
</body>
</html>
<?php
    } else {
        echo "❌ Token inválido o expirado.";
    }
    $stmt->close();
} else {
    echo "⚠️ No se proporcionó token.";
}
?>
