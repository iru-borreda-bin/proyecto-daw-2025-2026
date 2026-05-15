<?php
// Datos de conexión a la base de datos
$host = "localhost";
$user = "root"; // Usuario por defecto de XAMPP
$pass = ""; // Contraseña vacía por defecto en XAMPP
$db = "camisedit_bd"; // Nombre de la base de datos

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>