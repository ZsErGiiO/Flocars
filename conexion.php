<?php
$servername = "localhost";
$username = "root";  // Cambia esto por tu nombre de usuario
$password = "";  // Cambia esto por tu contraseña
$dbname = "proyecto";  // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>