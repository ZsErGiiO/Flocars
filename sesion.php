<?php
session_start();  // Iniciamos la sesión

// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

$error = '';  // Variable para errores
$exito = '';  // Variable para éxito

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    // Validar los campos
    if (empty($nombre_usuario) || empty($contraseña)) {
        $error = 'Por favor, complete todos los campos.';
    } else {
        // Verificar si el nombre de usuario existe en la base de datos
        $stmt = $conn->prepare("SELECT id, nombre, contraseña FROM usuarios WHERE nombre_usuario = ?");
        
        // Verificar si la preparación de la sentencia fue exitosa
        if ($stmt === false) {
            $error = 'Error al preparar la sentencia: ' . $conn->error;
        } else {
            // Vincular el parámetro a la sentencia preparada
            $stmt->bind_param("s", $nombre_usuario);
            
            // Ejecutar la sentencia
            $stmt->execute();
            $stmt->store_result();
            
            // Verificar si el nombre de usuario existe
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $nombre, $contraseña_almacenada);
                $stmt->fetch();

                // Verificar si la contraseña es correcta
                if (password_verify($contraseña, $contraseña_almacenada)) {
                    // Almacenar el nombre del usuario en la sesión
                    $_SESSION['nombre_usuario'] = $nombre_usuario;
                    $_SESSION['nombre'] = $nombre;

                    // Redirigir o mostrar mensaje de éxito
                    $exito = 'Inicio de sesión exitoso. Bienvenido, ' . $nombre . '.';
                    header('Location: flocars.php');  // Redirigimos a la página principal o a donde quieras
                    exit();
                } else {
                    $error = 'Contraseña incorrecta.';
                }
            } else {
                $error = 'El nombre de usuario no existe.';
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
    <title>Iniciar Sesión</title>
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
    <li><a href="Nosotros.php">Nosotros</a></li>
    <li><a href="Contacto.php">Contacto</a></li>

    

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
                    <li><a href="Nosotros.php">Nosotros</a></li>
                    <li><a href="Contacto.php">Contacto</a></li>
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
    <h2>Iniciar Sesión</h2>
    <form method="POST" action="">
        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if ($exito): ?>
            <div class="success"><?php echo $exito; ?></div>
        <?php endif; ?>
        
        <label for="nombre_usuario">
            <img src="Iconos/usuario.svg" alt="Nombre de usuario" class="icono"> Nombre de usuario
        </label>
        <input type="text" id="nombre_usuario" name="nombre_usuario" required>
        
        <label for="contraseña">
            <img src="Iconos/candado.svg" alt="Contraseña" class="icono"> Contraseña
        </label>
        <input type="password" id="contraseña" name="contraseña" required>
        
        <button type="submit">Iniciar sesión</button>
    </form>
</main>

<footer class="footer3">
    <img class="imgfooter" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars">
</footer>

<script src="carrusel.js"></script>

</body>
</html>

<?php
// cerrar_sesion.php
if (isset($_GET['logout'])) {
    session_start();
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    header("Location: flocars.html"); // Redirige a la página de inicio de sesión
    exit();
}
?>