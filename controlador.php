<?php
session_start();
include("conexion_bd.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener datos del formulario
    $tipo_documento = $_POST['tipo_documento'] ?? '';
    $numero_documento = $_POST['numero_documento'] ?? '';
    $nombre_completo = $_POST['nombre_completo'] ?? '';
    $clave = $_POST['clave'] ?? '';
    $recordar = isset($_POST['recordar']);

    // Validar campos obligatorios (evitar strings vacíos con trim)
    if (
        empty(trim($tipo_documento)) || empty(trim($numero_documento)) ||
        empty(trim($nombre_completo)) || empty(trim($clave))
    ) {
        echo "<script>
            alert('Todos los campos son obligatorios.');
            window.location.href = 'login.php';
        </script>";
        exit();
    }

    // Consultar la base de datos (usar prepared statements)
    $query = "SELECT * FROM usuarios WHERE numero_documento = ? AND tipo_documento = ?";
    $stmt = mysqli_prepare($conexion, $query);
    mysqli_stmt_bind_param($stmt, "ss", $numero_documento, $tipo_documento);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($resultado && mysqli_num_rows($resultado) === 1) {
        $fila = mysqli_fetch_assoc($resultado);

        // Validar nombre completo (case insensitive, trim) y contraseña
        if (
            strtolower(trim($nombre_completo)) === strtolower(trim($fila['usuario'])) &&
            password_verify($clave, $fila['clave'])
        ) {
            // Guardar sesión
            $_SESSION['usuario'] = [
                'id'              => $fila['id'],
                'tipo_documento'  => $fila['tipo_documento'],
                'numero'          => $fila['numero_documento'],
                'nombre_completo' => $fila['usuario'],
                'correo'          => $fila['correo']
            ];

            // Guardar hora de inicio
            date_default_timezone_set('America/Bogota');
            $_SESSION['hora_inicio'] = date("Y-m-d H:i:s");

            // Registrar notificación (usar mysqli y controlar error)
            $idUsuario = $fila['id'];
            $mensaje = 'Iniciaste sesión en el sistema.';

            $stmt_notif = $conexion->prepare("INSERT INTO notificaciones (usuario_id, mensaje, fecha) VALUES (?, ?, NOW())");
            if ($stmt_notif) {
                $stmt_notif->bind_param("is", $idUsuario, $mensaje);
                $stmt_notif->execute();
                $stmt_notif->close();
            } else {
                error_log("Error al preparar notificación: " . $conexion->error);
            }

            // Guardar cookies solo si marcó "recordar"
            if ($recordar) {
                setcookie("tipo_documento", $tipo_documento, time() + 2592000, "/"); // 30 días
                setcookie("numero_documento", $numero_documento, time() + 2592000, "/");
                setcookie("nombre_completo", $nombre_completo, time() + 2592000, "/");
            } else {
                // Si no quiere recordar, borrar cookies previas si existen
                setcookie("tipo_documento", "", time() - 3600, "/");
                setcookie("numero_documento", "", time() - 3600, "/");
                setcookie("nombre_completo", "", time() - 3600, "/");
            }

            // Redirigir a bienvenida
            header("Location: bienvenida.php");
            exit();

        } else {
            // Nombre o contraseña incorrectos
            echo "<script>
                alert('Nombre o contraseña incorrectos.');
                window.location.href = 'login.php';
            </script>";
            exit();
        }
    } else {
        // Usuario no encontrado
        echo "<script>
            alert('Usuario no encontrado.');
            window.location.href = 'login.php';
        </script>";
        exit();
    }
} else {
    // Acceso inválido
    echo "<script>
        alert('Acceso inválido.');
        window.location.href = 'login.php';
    </script>";
    exit();
}
?>
