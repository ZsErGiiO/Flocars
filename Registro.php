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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Registro</title>
    <link rel="stylesheet" href="flocars.css">
    <link rel="stylesheet" href="flocars2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
</head>
<body>

<header class="header2">
    <!-- Menú de navegación para pantallas grandes -->
    <div class="navegacion">
  <ul>
    <li><a href="flocars.php"><img class="foto" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars"></a></li>
    <li><a href="CompraCoche.php">Comprar Coche</a></li>
    <li><a href="ReservaCoche.php">Vehículos Reservados</a></li>
    <li><a href="#">Nosotros</a></li>
    <li><a href="#">Contacto</a></li>

    

    <!-- Menú de registro / inicio sesión -->
    <li class="menu-login">
      <?php if (isset($_SESSION['nombre_usuario'])): ?>
        <!-- Si el usuario está logueado -->
        <li class="pos">¡Hola, <?php echo $_SESSION['nombre_usuario']; ?>!</li>
        <li class="pos"><a href="cerrar_sesion.php">Cerrar sesión</a></li>
      <?php else: ?>
        <div class="reg">
            <a  href="Registro.php">Registrarme</a>
            <a href="sesion.php">Iniciar sesión</a>
      </div>
      <?php endif; ?>
    </li>
  </ul>
</div>


    <!-- Menú de navegación para pantallas pequeñas -->
    <div class="navegacion-movil">
        <ul>
            <li><a href="flocars.php"><img class="foto2" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars"></a></li>
            <li class="menu-desplegable">
                <a class="simbolo-menu"href="#">
                <i class="fa fa-bars"></i> <!-- Ícono de usuario -->
                </a>
                <ul class="sub-menu">
                    <li><a href="CompraCoche.php">Comprar Coche</a></li>
                    <li><a href="ReservaCoche.php">Vehículos Reservados</a></li>
                    <li><a href="#">Nosotros</a></li>
                    <li><a href="#">Contacto</a></li>
                </ul>
            </li>
            <li class="menu-desplegable">
                <a class="simbolo-usuario" href="#">
                    <i class="fa fa-user"></i> <!-- Ícono de usuario -->
                </a>
                <ul class="sub-menu">
                    <li><a href="Registro.php">Registrarme</a></li>
                    <li><a href="sesion.php">Iniciar Sesión</a></li>
                </ul>
            </li>
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

