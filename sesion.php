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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
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
                <?php if (isset($_SESSION['nombre_usuario'])): ?>
                    <!-- Si el usuario está logueado, mostrar el saludo y el enlace para cerrar sesión -->
                    <li>¡Hola, <?php echo $_SESSION['nombre']; ?>!</li>
                    <li class="pos-sesion"><a href="cerrar_sesion.php">Cerrar sesión</a></li>
                <?php else: ?>
                    <!-- Si el usuario no está logueado, mostrar los botones de registro y login -->
                    <li><a href="Registro.php">Registrarme</a></li>
                    <li><a class="pos"href="sesion.php">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
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