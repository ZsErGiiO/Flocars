<?php
session_start(); 
include 'conexion.php'; 

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Contacto - Flocars</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="flocars.css">
    <link rel="icon" href="Diseño_Logos/Diseño Logo Flocars.png" type="image/x-icon">
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
        <li class="pos">¡Hola, <?php echo $_SESSION['nombre_usuario']; ?>!</li>
        <li class="pos"><a href="cerrar_sesion.php">Cerrar sesión</a></li>
      <?php else: ?>
        <div class="reg">
            <a href="Registro.php">Registrarme</a>
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
                <i class="fa fa-bars"></i> 
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
                    <i class="fa fa-user"></i> 
                </a>
                <ul class="sub-menu">
                    <li><a href="Registro.php">Registrarme</a></li>
                    <li><a href="sesion.php">Iniciar Sesión</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>

<main>
    <section class="nosotros">
        <h1>Contáctanos</h1>
        <p>Si tienes alguna pregunta o inquietud, no dudes en ponerte en contacto con nosotros. Nuestro equipo está dispuesto a ayudarte.</p>
        
        <h2>Información de contacto:</h2>
        <p><strong>Teléfono:</strong> +34 123 456 789</p>
        <p><strong>Email:</strong> contacto@flocars.com</p>
        <p><strong>Dirección:</strong> Calle Ejemplo 123, Madrid, España</p>

        <h2>Formulario de contacto</h2>
        <form action="enviar_contacto.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="mensaje" rows="4" required></textarea>

            <button type="submit">Enviar</button>
        </form>
    </section>
</main>

<footer class="footer4">
    <img class="imgfooter" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars">
</footer>

</body>
</html>