<?php
session_start();  // Iniciar la sesión
include 'conexion.php';  // Incluir el archivo de conexión

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Nosotros - Flocars</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="flocars.css">
    <link rel="icon" href="Diseño_Logos/Diseño Logo Flocars.png" type="image/x-icon">
</head>
<body>

<header class="header2">
    <div class="navegacion">
        <ul>
            <li><a href="flocars.php"><img class="foto" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars"></a></li>
            <li><a href="CompraCoche.php">Comprar Coche</a></li>
            <li><a href="ReservaCoche.php">Vehículos Reservados</a></li>
            <li><a href="Nosotros.php">Nosotros</a></li>
            <li><a href="Contacto.php">Contacto</a></li>
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
</header>

<main>
    <section class="nosotros">
        <h1>¿Quiénes somos?</h1>
        <p>En Flocars, nos dedicamos a ofrecerte los mejores coches de segunda mano, seleccionados con rigurosidad para garantizarte calidad y fiabilidad. Nuestro equipo está compuesto por expertos en el sector automotriz, con años de experiencia para ayudarte a elegir el coche perfecto para ti.</p>
        
        <h2>Nuestra misión</h2>
        <p>Brindar a nuestros clientes una experiencia única a la hora de comprar un coche, con total transparencia y confianza. Queremos que cada persona que pase por Flocars se sienta segura y satisfecha con su compra.</p>
        
        <h2>¿Por qué elegirnos?</h2>
        <ul>
            <li>Variedad de modelos y marcas</li>
            <li>Precios competitivos</li>
            <li>Asesoramiento personalizado</li>
            <li>Vehículos con garantía</li>
        </ul>
    </section>
</main>

<footer class="footer2">
    <img class="imgfooter" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars">
</footer>
 <script src="script.js"></script>
</body>
</html>