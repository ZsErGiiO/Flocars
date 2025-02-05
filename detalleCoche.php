<?php
session_start();  // Esto es lo primero que debes hacer para acceder a la sesión
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Obtener el id del coche desde la URL
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Realizar la consulta a la base de datos para obtener los detalles del coche
$sql = "SELECT * FROM coches WHERE id = $id";
$result = $conn->query($sql);

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    $coche = $result->fetch_assoc();
    $coche['matriculacion'] = date('d-m-Y', strtotime($coche['matriculacion']));
} else {
    $coche = null; // Si no se encuentra el coche
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Coche - <?php echo $coche ? $coche['marca'] . ' ' . $coche['modelo'] : 'No encontrado'; ?></title>
    <link rel="stylesheet" href="flocars.css">
    <link rel="stylesheet" href="flocars2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

<section class="detallesCoche">
    <?php if ($coche): ?>

        <!-- Mostrar mensaje de éxito si el coche ha sido reservado -->
        <?php if (isset($_GET['estado']) && $_GET['estado'] == 'reservado'): ?>
            <p class="exito">¡El coche ha sido reservado con éxito!</p>
        <?php endif; ?>

        <!-- Contenedor para la imagen y características -->
        <div class="detalles-contenido">
            <!-- Columna para la imagen -->
            <div class="detalles-imagen">
                <div class="carrusel">
                    <div class="carrusel-imagenes">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 01.png" alt="Imagen Principal" class="imagen-carrusel">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 02.png" alt="Imagen Secundaria" class="imagen-carrusel">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 03.png" alt="Imagen Secundaria" class="imagen-carrusel">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 04.png" alt="Imagen Principal" class="imagen-carrusel">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 05.png" alt="Imagen Secundaria" class="imagen-carrusel">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 06.png" alt="Imagen Secundaria" class="imagen-carrusel">
                    </div>
                    <div class="miniaturas">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 01.png" alt="Miniatura 1" class="miniatura" data-index="0">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 02.png" alt="Miniatura 2" class="miniatura" data-index="1">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 03.png" alt="Miniatura 3" class="miniatura" data-index="2">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 04.png" alt="Miniatura 1" class="miniatura" data-index="3">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 05.png" alt="Miniatura 2" class="miniatura" data-index="4">
                        <img src="Imagenes Coches/<?php echo $coche['numero']; ?> img 06.png" alt="Miniatura 3" class="miniatura" data-index="5">
                    </div>
                    <button class="prev-btn">&#10094;</button>
                    <button class="next-btn">&#10095;</button>
                </div>
            </div>

            <!-- Columna para las características -->
            <div class="detalles-caracteristicas">
                <div class="caracteristicas"> 
                    <p><?php echo $coche['marca']; ?></p> <!-- Nombre en negrita -->
                    <p><strong><?php echo $coche['modelo']; ?></strong></p> <!-- Modelo debajo -->
                    <p class="titulo-precio">Precio</p>
                    <p class="precio"><span class="precio"><?php echo $coche['precio']; ?> €</span></p> <!-- Precio debajo --> 
                </div>

                <div class="etiqueta-ambiental">
                    <h2>Etiqueta Medioambiental</h2>
                    <?php
                    $etiqueta = $coche['etiqueta_medioambiental'];
                    if ($etiqueta == 'B') {
                        echo '<img src="Etiquetas/B.png" alt="Etiqueta B" class="etiqueta-img">';
                    } elseif ($etiqueta == 'C') {
                        echo '<img src="Etiquetas/C.png" alt="Etiqueta C" class="etiqueta-img">';
                    } elseif ($etiqueta == 'ECO') {
                        echo '<img src="Etiquetas/ECO.png" alt="Etiqueta ECO" class="etiqueta-img">';
                    } elseif ($etiqueta == '0') {
                        echo '<img src="Etiquetas/0.png" alt="Etiqueta 0" class="etiqueta-img">';
                    } else {
                        echo 'Etiqueta no disponible';
                    }
                    ?>
                <div class="informacion-garantia">
                    <div class="garantia-contenido">
                        <img src="Iconos/sello_garantia.png" alt="Sello de garantía">
                        <div class="detalles-garantia">
                            <ul class="lista-garantias">
                                <li><img alt="check icon" class="check" src="Iconos/check.svg"> 15 días o 1.000km para probarlo</li>
                                <li><img alt="check icon" class="check" src="Iconos/check.svg"> Revisión de 320 puntos del coche</li>
                                <li><img alt="check icon" class="check" src="Iconos/check.svg"> Garantía de 1 año</li>
                                <li><img alt="check icon" class="check" src="Iconos/check.svg"> Entrega a domicilio el martes</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div>
                <p class="texto-recogida"><strong>Recógelo GRATIS en nuestros centros</strong> o servicio de entrega a domicilio por 99€ (en península).</p>
                </<div>
                </div>
                    <!-- Formulario para cambiar el estado del coche -->
                    <form action="reservar_coche.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres reservar este coche?');">
                        <input type="hidden" name="id" value="<?php echo $coche['id']; ?>">
                        <button type="submit" class="btn-reservar">Reservar</button>
                    </form>
                </div>
            </div>
        </div>

    <?php else: ?>
        <p>Coche no encontrado.</p>
    <?php endif; ?>
</section>

<div class="detalles-adicionales">
    <hr>
    <div class="columnas-adicionales">
        <div class="columna">
            Kilómetros <strong><?php echo $coche['km']; ?> KM </strong>
        </div>
        <div class="columna">
            Año <strong><?php echo $coche['año']; ?> </strong>
        </div>
        <div class="columna">
            Matriculación <strong><?php echo $coche['matriculacion']; ?> </strong>
        </div>
    </div>
    <div class="columnas-adicionales">
        <div class="columna">
            Potencia <strong><?php echo $coche['potencia']; ?> CV </strong>
        </div>
        <div class="columna">
            Combustible <strong><?php echo $coche['combustible']; ?></strong>
        </div>
        <div class="columna">
            Cambio <strong><?php echo $coche['cambio']; ?></strong>
        </div>
    </div>
    <div class="columnas-adicionales">
        <div class="columna">
            Tracción <strong><?php echo $coche['traccion']; ?></strong>
        </div>
        <div class="columna">
            Distribución <strong><?php echo $coche['distribucion']; ?></strong>
        </div>
        <div class="columna">
            Nº plazas <strong><?php echo $coche['plazas']; ?></strong>
        </div>
    </div>
</div>

<footer class="footer2">
    <img class="imgfooter" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars">
</footer>

<script src="carrusel.js"></script>

</body>
</html>