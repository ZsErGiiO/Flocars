<?php
session_start();  // Iniciamos la sesión
session_unset();  // Eliminamos todas las variables de sesión
session_destroy();  // Destruimos la sesión
header("Location: sesion.php");  // Redirigimos a la página de inicio de sesión
exit();  // Terminamos el script
?>