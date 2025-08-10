<?php
session_start();

// Limpia todas las variables de sesión
$_SESSION = [];

// Elimina la cookie de sesión si existe (para mayor limpieza)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente destruye la sesión
session_destroy();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Cerrando sesión</title>
  <style>
    body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #6552cf;
      color: white;
      font-family: Arial, sans-serif;
    }
    h2 {
      font-size: 24px;
    }
    .loader {
      margin-top: 20px;
      border: 6px solid rgba(255,255,255,0.3);
      border-top: 6px solid white;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
  </style>
  <script>
    // Alerta al usuario
    alert("Has cerrado sesión correctamente.");
    // Redirecciona al login después de 3 segundos para mostrar la animación
    setTimeout(() => {
      window.location.href = "login.php"; // Cambia si tu login tiene otro nombre o extensión
    }, 3000);
  </script>
  <noscript>
    <meta http-equiv="refresh" content="3;url=login.php" />
    <p>Redirigiendo al login...</p>
  </noscript>
</head>
<body>
  <h2>Cerrando sesión...</h2>
  <div class="loader" aria-label="Cargando animación de cierre de sesión"></div>
</body>
</html>
