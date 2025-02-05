<?php

session_start();  
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Variables para almacenar los mensajes de error y éxito
$error = '';
$exito = '';

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    // Validar los campos
    if (empty($nombre) || empty($nombre_usuario) || empty($contraseña)) {
        $error = 'Por favor, complete todos los campos.';
    } else {
        // Encriptar la contraseña antes de almacenarla
        $contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

        // Crear una sentencia preparada
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, nombre_usuario, contraseña) VALUES (?, ?, ?)");
        
        // Verificar si la preparación de la sentencia fue exitosa
        if ($stmt === false) {
            $error = 'Error al preparar la sentencia: ' . $conn->error;
        } else {
            // Vincular los parámetros a la sentencia preparada
            $stmt->bind_param("sss", $nombre, $nombre_usuario, $contraseña_encriptada);
            
            // Ejecutar la sentencia
            if ($stmt->execute()) {
                $exito = 'Registro exitoso. Ahora puedes iniciar sesión.';
            } else {
                $error = 'Error al registrar al usuario: ' . $stmt->error;
            }

            // Cerrar la sentencia
            $stmt->close();
        }
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="flocars.css">
    <link rel="stylesheet" href="flocars2.css">
</head>
<body>

<header class="header2">
    <div class="navegacion">
        <ul>
            <li><a href="flocars.php"><img class="foto" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars"></a></li>
            <li><a href="CompraCoche.php">Comprar Coche</a></li>
            <li><a href="ReservaCoche.php">Vehiculos Reservados</a></li>
            <li><a href="#">Nosotros</a></li>
            <li><a href="#">Contacto</a></li>
            <ul class="reg">
                <li><a href="Registro.php">Registrarme</a></li>
                <li><a class="pos"href="sesion.php">Iniciar Sesión</a></li>
            </ul>
        </ul>
    </div>
</header>

<main class="main-registro">
    <h2>Formulario de Registro</h2>
    <form method="POST" action="">
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($exito): ?>
            <div class="success"><?php echo $exito; ?></div>
        <?php endif; ?>
        
        <label  for="nombre">
            <img src="Iconos/usuario.svg" alt="Nombre completo" class="icono"> Nombre completo
        </label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label  for="nombre_usuario">
            <img src="Iconos/usuario.svg" alt="Nombre de usuario" class="icono"> Nombre de usuario
        </label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required>
        
        <label for="contraseña">
            <img src="Iconos/candado.svg" alt="Contraseña" class="icono"> Contraseña
        </label>
        <input type="password" id="contraseña" name="contraseña" required>
        
        <button type="submit">Registrar</button>
    </form>
</main>

<footer class="footer2">
    <img class="imgfooter" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars">
</footer>

<script src="carrusel.js"></script>

</body>

</html>

