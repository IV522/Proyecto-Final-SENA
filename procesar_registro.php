<?php
session_start();
include("conexion_bd.php"); // Asegúrate de que este archivo conecte correctamente

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Recoger y validar datos
    $tipo = trim($_POST['tipo_documento'] ?? '');
    $numero = trim($_POST['numero_documento'] ?? '');
    $usuario = trim($_POST['usuario'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $clave = trim($_POST['clave'] ?? '');

    if (empty($tipo) || empty($numero) || empty($usuario) || empty($correo) || empty($clave)) {
        echo "<script>
            alert('Todos los campos son obligatorios.');
            window.location.href = 'register.php';
        </script>";
        exit();
    }

    // 2. Verificar si el usuario ya existe
    $consulta = $conexion->prepare("SELECT id FROM usuarios WHERE numero_documento = ?");
    $consulta->bind_param("s", $numero);
    $consulta->execute();
    $consulta->store_result();

    if ($consulta->num_rows > 0) {
        echo "<script>
            alert('El número de documento ya está registrado.');
            window.location.href = 'register.php';
        </script>";
        exit();
    }

    // 3. Insertar nuevo usuario
    $claveHash = password_hash($clave, PASSWORD_DEFAULT); // Seguridad
    $insertar = $conexion->prepare("INSERT INTO usuarios (tipo_documento, numero_documento, usuario, correo, clave) VALUES (?, ?, ?, ?, ?)");
    $insertar->bind_param("sssss", $tipo, $numero, $usuario, $correo, $claveHash);

    if ($insertar->execute()) {
        echo "<script>
            alert('Usuario registrado correctamente. Ahora puedes iniciar sesión.');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo "<script>
            alert('Error al registrar el usuario.');
            window.location.href = 'register.php';
        </script>";
    }

    $insertar->close();
    $conexion->close();
} else {
    echo "<script>
        alert('Acceso no permitido.');
        window.location.href = 'register.php';
    </script>";
    exit();
}
?>
