<?php
// ------------------------------------
// ARCHIVO DE CONEXIÓN A BASE DE DATOS
// ------------------------------------

// Parámetros de conexión
$host = "localhost";    // Servidor local (si usas XAMPP o similar)
$user = "root";         // Usuario por defecto de MySQL en XAMPP
$pass = "";             // Sin contraseña (en XAMPP por defecto)
$db   = "servimed";     // Nombre de tu base de datos

// Crear la conexión con MySQL
$conexion = new mysqli($host, $user, $pass, $db);

// Verificar si hubo error al conectar
if ($conexion->connect_error) {
    die("❌ Conexión fallida: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8 (soporte de tildes, ñ, etc.)
$conexion->set_charset("utf8");
?>
