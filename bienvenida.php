<?php
session_start();

// Verificar sesión activa
if (!isset($_SESSION['usuario'])) {
    echo "<script>
        alert('Debes iniciar sesión para acceder al portal.');
        window.location.href = 'login.php';
    </script>";
    exit();
}

// Obtener nombre seguro para mostrar
$nombreUsuario = htmlspecialchars($_SESSION['usuario']['nombre_completo'] ?? 'Usuario');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Bienvenido - IPS ServiMed</title>
  <link rel="icon" href="servimed.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    /* Reset y estilos generales */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #e0f2f1;
    }
    .container {
      max-width: 1100px;
      margin: 0 auto;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    header {
      background-color: #6552cf;
      color: white;
      padding: 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }
    header .logo {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    header h1 {
      font-size: 22px;
      margin: 0;
    }
    .dropdown {
      position: relative;
    }
    .dropdown-btn {
      font-size: 20px;
      cursor: pointer;
      background: none;
      border: none;
      color: white;
    }
    .dropdown-content {
      display: none;
      position: absolute;
      right: 0;
      background: #fff;
      min-width: 150px;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
      z-index: 1001;
      border-radius: 4px;
    }
    .dropdown-content a {
      color: black;
      padding: 10px 15px;
      text-decoration: none;
      display: block;
      font-weight: 600;
      border-bottom: 1px solid #eee;
    }
    .dropdown-content a:last-child {
      border-bottom: none;
    }
    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }
    /* Mostrar menú al hacer click */
    .dropdown.show .dropdown-content {
      display: block;
    }
    .top-bar {
      background-color: #68e3d9;
      color: #081c19;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }
    .bienvenida-info h3 {
      margin: 0;
      font-size: 18px;
    }
    .barra-derecha {
      display: flex;
      align-items: center;
      gap: 20px;
    }
    #horaActual {
      font-size: 14px;
      font-weight: bold;
    }
    .notif-container {
      position: relative;
    }
    #notificaciones {
      display: none;
      position: absolute;
      top: 30px;
      right: 0;
      background: white;
      border: 1px solid #ccc;
      padding: 10px;
      width: 250px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      z-index: 1000;
      border-radius: 6px;
    }
    .hero {
      text-align: center;
      padding: 20px;
    }
    .hero img {
      max-width: 100%;
      height: auto;
    }
    .mensaje {
      text-align: center;
      margin-top: 15px;
    }
    .mensaje h2 {
      margin: 0;
      font-weight: bold;
      color: #081c19;
    }
    .menu {
      display: flex;
      flex-wrap: wrap;
      gap: 15px;
      justify-content: center;
      padding: 20px;
    }
    .card {
      background-color: #18a3de;
      color: #fff;
      padding: 15px 25px;
      border-radius: 15px;
      text-align: center;
      text-decoration: none;
      font-size: 18px;
      font-weight: bold;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
      min-width: 180px;
      transition: all 0.3s ease;
    }
    .card:hover {
      background-color: #004d40;
      transform: scale(1.05);
    }
    .volver {
      text-align: center;
      margin: 20px 0;
    }
    .volver a {
      color: #6552cf;
      font-weight: bold;
      text-decoration: none;
    }
    .volver a:hover {
      text-decoration: underline;
    }
    @media (max-width: 600px) {
      .top-bar {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }
      .barra-derecha {
        align-self: flex-end;
        gap: 10px;
      }
      .menu {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <div class="container">

    <!-- ENCABEZADO -->
    <header>
      <div class="logo">
        <img src="https://img.icons8.com/ios-filled/50/fa314a/heart-with-pulse--v1.png" height="40" alt="Logo IPS ServiMed" />
        <h1>IPS ServiMed</h1>
      </div>

      <!-- Menú desplegable con opciones de usuario -->
      <div class="dropdown" id="dropdownMenu">
        <button class="dropdown-btn" aria-label="Menú usuario">☰</button>
        <div class="dropdown-content" role="menu" aria-hidden="true">
          <a href="datos_usuario.php" role="menuitem">👤 Mis Datos</a>
          <a href="logout.php" role="menuitem">🚪 Cerrar sesión</a>
        </div>
      </div>
    </header>

    <!-- BARRA DE BIENVENIDA -->
    <div class="top-bar">
      <div class="bienvenida-info">
        <h3>Bienvenido(a), <?= $nombreUsuario ?></h3>
      </div>

      <div class="barra-derecha">
        <div id="horaActual" aria-live="polite" aria-atomic="true"></div>

        <div class="notif-container">
          <img
            src="https://img.icons8.com/ios-glyphs/30/bell.png"
            alt="Notificaciones"
            title="Ver notificaciones"
            style="cursor: pointer;"
            onclick="toggleNotificaciones()"
            role="button"
            aria-expanded="false"
            aria-controls="notificaciones"
          />
          <div id="notificaciones" aria-live="polite" aria-atomic="true">
            <strong>Notificaciones:</strong>
            <ul>
              <li>No hay notificaciones nuevas</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- IMAGEN PRINCIPAL -->
    <section class="hero">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR0kigo369AKCLUVSYPBs4K54t0WQbsfL9Lmw&s" alt="Doctor" height="150" />
    </section>

    <!-- MENSAJE PRINCIPAL -->
    <div class="mensaje">
      <h2>SELECCIONE LA OPCIÓN DESEADA</h2>
    </div>

    <!-- MENÚ DE OPCIONES PRINCIPAL -->
    <section class="menu" role="navigation" aria-label="Opciones principales">
      <a class="card" href="nueva_cita.php">🩺 Nueva Cita</a>
      <a class="card" href="citas_actuales.php">🔍 Citas Actuales</a>
      <a class="card" href="reasignar_citas.php">🔁 Reasignar Citas</a>
      <a class="card" href="historial_citas.php">📅 Historial</a>
      <a class="card" href="actualizacion_de_datos">⚙️ Actualizacion de Datos</a>
      <a class="card" href="contacto.php">📨 Soporte / PQRS</a>
    </section>

    <!-- ENLACE VOLVER AL INICIO -->
    <div class="volver">
      <a href="index.html">🏠 Volver al inicio</a>
    </div>
  </div>

  <!-- SCRIPTS -->
  <script>
    // Mostrar/ocultar panel de notificaciones
    function toggleNotificaciones() {
      const panel = document.getElementById('notificaciones');
      const expanded = panel.style.display === 'block';
      panel.style.display = expanded ? 'none' : 'block';

      // Actualizar atributo aria-expanded para accesibilidad
      const btn = document.querySelector('.notif-container img');
      btn.setAttribute('aria-expanded', !expanded);
    }

    // Actualizar la hora cada segundo
    function actualizarHora() {
      const ahora = new Date();
      const opciones = {
        weekday: 'short',
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
      };
      document.getElementById('horaActual').textContent = ahora.toLocaleString('es-CO', opciones);
    }

    setInterval(actualizarHora, 1000);
    actualizarHora();

    // Menú desplegable usuario
    const dropdown = document.getElementById('dropdownMenu');
    const btn = dropdown.querySelector('.dropdown-btn');
    const content = dropdown.querySelector('.dropdown-content');

    btn.addEventListener('click', () => {
      dropdown.classList.toggle('show');
      const isShown = dropdown.classList.contains('show');
      content.setAttribute('aria-hidden', !isShown);
      btn.setAttribute('aria-expanded', isShown);
    });

    // Cerrar menú si se clickea fuera
    window.addEventListener('click', e => {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('show');
        content.setAttribute('aria-hidden', 'true');
        btn.setAttribute('aria-expanded', 'false');
      }
    });
  </script>
</body>
</html>
