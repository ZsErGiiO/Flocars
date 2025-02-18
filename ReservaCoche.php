<?php
session_start();  // Esto es lo primero que debes hacer para acceder a la sesión
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Realizar la consulta a la base de datos para obtener los coches reservados
$sql = "SELECT * FROM coches WHERE estado = 'reservado'";  // Filtrar coches con estado reservado
$result = $conn->query($sql);

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    // Si hay resultados, los mostramos
    $coches = [];
    while($row = $result->fetch_assoc()) {
        $row['matriculacion'] = date('d-m-Y', strtotime($row['matriculacion']));
        $coches[] = $row;  // Guardamos cada coche en el array $coches
    }
} else {
    $coches = []; // Si no hay resultados, inicializamos un array vacío
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>Flocars</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="flocars.css">
    <link rel="stylesheet" href="flocars2.css">
    <link rel="icon" href="Diseño_Logos/Diseño Logo Flocars.png" type="image/x-icon">
    <script src="https://unpkg.com/scrollreveal"></script>
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


    

<section class="contenedor4">
    <?php if (!empty($coches)): ?>
        <!-- Mostrar los coches reservados en contenedores -->
        <div class="CocheContainer2">
            <?php foreach ($coches as $coche): ?>
                <div class="CocheItem2">
                    <!-- Enlace a la página de detalles, pasando el id del coche -->
                    <a href="detalleCoche.php?id=<?php echo $coche['id']; ?>">
                        <!-- Imagen del coche -->
                        <img class="CochePortada2" src="Imagenes Coches/<?php echo $coche['numero']; ?> img 01.png" alt="<?php echo $coche['marca'] . ' ' . $coche['modelo']; ?>">
                    </a>

                    <!-- Detalles del coche -->
                    <div class="coche-detalles">
                        <p><strong><?php echo $coche['marca'] . ' ' . $coche['modelo']; ?></strong><span class="precio"><?php echo $coche['precio']; ?> €</span></p>
                        <p><?php echo $coche['año'] . ' | ' . $coche['km'] . ' km | ' . $coche['cambio']; ?></p>
                        
                        <!-- Etiqueta medioambiental y combustible -->
                        <div class="etiqueta-combustible">
                            <?php
                            // Obtener la etiqueta medioambiental y construir la ruta de la imagen
                            $etiqueta = $coche['etiqueta_medioambiental'];

                            // Condicional para mostrar la imagen correspondiente
                            if ($etiqueta == 'B') {
                                echo '<img src="Etiquetas/B.png" alt="Etiqueta B" class="etiqueta-img"> ';
                            } elseif ($etiqueta == 'C') {
                                echo '<img src="Etiquetas/C.png" alt="Etiqueta C" class="etiqueta-img"> ';
                            } elseif ($etiqueta == 'ECO') {
                                echo '<img src="Etiquetas/ECO.png" alt="Etiqueta ECO" class="etiqueta-img"> ';
                            } elseif ($etiqueta == '0') {
                                echo '<img src="Etiquetas/0.png" alt="Etiqueta 0" class="etiqueta-img"> ';
                            } else {
                                echo 'Etiqueta no disponible'; // Si no hay etiqueta o no está definida
                            }
                            // Mostrar el combustible al lado de la etiqueta
                            echo ' <span class="combustible">' . $coche['combustible'] . '</span>';
                            ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No hay coches reservados en este momento.</p>
    <?php endif; ?>
</section>

<footer class="footer4">
    <img class="imgfooter" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars">
</footer>

</body>
</html>