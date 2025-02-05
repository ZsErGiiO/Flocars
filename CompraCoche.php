<?php
session_start();  // Esto es lo primero que debes hacer para acceder a la sesión
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Inicializar variables de filtrado
$marca = isset($_GET['marca']) ? $_GET['marca'] : '';
$modelo = isset($_GET['modelo']) ? $_GET['modelo'] : '';
$combustible = isset($_GET['combustible']) ? $_GET['combustible'] : '';
$km_min = isset($_GET['km_min']) ? $_GET['km_min'] : 0;
$km_max = isset($_GET['km_max']) ? $_GET['km_max'] : 500000;
$anio_min = isset($_GET['anio_min']) ? $_GET['anio_min'] : 2000;
$anio_max = isset($_GET['anio_max']) ? $_GET['anio_max'] : date('Y');

// Obtener las marcas disponibles de la base de datos
$sql_marca = "SELECT DISTINCT marca FROM coches";
$result_marca = $conn->query($sql_marca);
$marcas = [];
if ($result_marca->num_rows > 0) {
    while($row = $result_marca->fetch_assoc()) {
        $marcas[] = $row['marca'];
    }
}

// Obtener los modelos disponibles de la base de datos
$sql_modelo = "SELECT DISTINCT modelo FROM coches";
$result_modelo = $conn->query($sql_modelo);
$modelos = [];
if ($result_modelo->num_rows > 0) {
    while ($row = $result_modelo->fetch_assoc()) {
        $modelos[] = $row['modelo'];
    }
}

// Obtener los combustibles disponibles de la base de datos
$sql_combustible = "SELECT DISTINCT combustible FROM coches";
$result_combustible = $conn->query($sql_combustible);
$combustibles = [];
if ($result_combustible->num_rows > 0) {
    while ($row = $result_combustible->fetch_assoc()) {
        $combustibles[] = $row['combustible'];
    }
}

// Construir la consulta SQL con los filtros
$sql = "SELECT * FROM coches WHERE 1=1";
if ($marca) {
    $sql .= " AND marca = '$marca'";
}
if ($modelo) {
    $sql .= " AND modelo = '$modelo'";
}
if ($combustible) {
    $sql .= " AND combustible = '$combustible'";
}
$sql .= " AND km BETWEEN $km_min AND $km_max";
$sql .= " AND año BETWEEN $anio_min AND $anio_max";

$result = $conn->query($sql);

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    $coches = [];
    while($row = $result->fetch_assoc()) {
        $row['matriculacion'] = date('d-m-Y', strtotime($row['matriculacion']));
        $row['reservado'] = ($row['estado'] == 'reservado') ? 'reservado' : '';
        $coches[] = $row;
    }
} else {
    $coches = [];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flocars</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="flocars.css">
    <link rel="icon" href="Diseño_Logos/Diseño Logo Flocars.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.6.1/dist/nouislider.min.css">
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



<section class="contenedor2">
    <!-- Formulario de filtrado -->
    <div class="fondo_filtro">
    <form method="GET" action="">
        
        <label class="filtro" for="marca">Marca:</label>
        <select id="marca" name="marca">
            <option value="">Todas</option>
            <?php foreach ($marcas as $opcion): ?>
                <option value="<?php echo $opcion; ?>" <?php echo ($marca == $opcion) ? 'selected' : ''; ?>>
                    <?php echo $opcion; ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <label class="filtro" for="modelo">Modelo:</label>
        <select id="modelo" name="modelo">
            <option value="">Todos</option>
            <?php foreach ($modelos as $opcion): ?>
                <option value="<?php echo $opcion; ?>" <?php echo ($modelo == $opcion) ? 'selected' : ''; ?>>
                    <?php echo $opcion; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label class="filtro" for="combustible">Combustible:</label>
        <select id="combustible" name="combustible">
            <option value="">Todos</option>
            <?php foreach ($combustibles as $opcion): ?>
                <option value="<?php echo $opcion; ?>" <?php echo ($combustible == $opcion) ? 'selected' : ''; ?>>
                    <?php echo $opcion; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label class="filtro" for="km_range">Kilómetros:</label>
        <div id="km_range"></div> <!-- Solo el slider de kilómetros -->
        <input type="hidden" id="km_min" name="km_min" value="<?php echo $km_min; ?>">
        <input type="hidden" id="km_max" name="km_max" value="<?php echo $km_max; ?>">

        <label class="filtro" for="anio_range">Año:</label>
        <div id="anio_range"></div> <!-- Solo el slider de años -->
        <input type="hidden" id="anio_min" name="anio_min" value="<?php echo $anio_min; ?>">
        <input type="hidden" id="anio_max" name="anio_max" value="<?php echo $anio_max; ?>">

        <button type="submit">Filtrar</button>
    </form>
    </div>
    </section>
    
    <section class="contenedor3">
    <?php if (!empty($coches)): ?>
        <div class="CocheContainer2">
            <?php foreach ($coches as $coche): ?>
                <div class="CocheItem2 <?php echo $coche['reservado']; ?>">
                    <a href="detalleCoche.php?id=<?php echo $coche['id']; ?>">
                        <img class="CochePortada2" src="Imagenes Coches/<?php echo $coche['numero']; ?> img 01.png" alt="<?php echo $coche['marca'] . ' ' . $coche['modelo']; ?>">
                    </a>
                    <div class="coche-detalles">
                        <p><strong><?php echo $coche['marca'] . ' ' . $coche['modelo']; ?></strong><span class="precio"><?php echo $coche['precio']; ?> €</span></p>
                        <p><?php echo $coche['año'] . ' | ' . $coche['km'] . ' km | ' . $coche['cambio']; ?></p>
                        <div class="etiqueta-combustible">
                            <?php
                            $etiqueta = $coche['etiqueta_medioambiental'];
                            if ($etiqueta == 'B') {
                                echo '<img src="Etiquetas/B.png" alt="Etiqueta B" class="etiqueta-img"> ';
                            } elseif ($etiqueta == 'C') {
                                echo '<img src="Etiquetas/C.png" alt="Etiqueta C" class="etiqueta-img"> ';
                            } elseif ($etiqueta == 'ECO') {
                                echo '<img src="Etiquetas/ECO.png" alt="Etiqueta ECO" class="etiqueta-img"> ';
                            } elseif ($etiqueta == '0') {
                                echo '<img src="Etiquetas/0.png" alt="Etiqueta 0" class="etiqueta-img"> ';
                            } else {
                                echo 'Etiqueta no disponible';
                            }
                            echo ' <span class="combustible">' . $coche['combustible'] . '</span>';
                            ?>
                        </div>
                    </div>
                    <?php if ($coche['reservado']): ?>
                        <div class="etiqueta-reservado">Reservado</div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No hay coches disponibles en este momento.</p>
    <?php endif; ?>
</section>

<footer class="footer2">
    <img class="imgfooter" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars">
</footer>

<script>
    // Slider para kilómetros
    const kmSlider = document.getElementById('km_range');
    noUiSlider.create(kmSlider, {
        start: [<?php echo $km_min; ?>, <?php echo $km_max; ?>],
        connect: true,
        range: {
            min: 0,
            max: 500000
        },
        step: 1000,
        tooltips: true,
        format: {
            to: (value) => {
                // Formatear el valor con un punto como separador de miles
                return value.toLocaleString('es-ES');  // Esto agrega el separador de miles
            },
            from: (value) => {
                // Eliminar los puntos del valor para enviarlo correctamente
                return Number(value.replace(/\./g, ''));  // Remueve puntos y convierte a número
            }
        }
    });

    // Slider para años
    const anioSlider = document.getElementById('anio_range');
    noUiSlider.create(anioSlider, {
        start: [<?php echo $anio_min; ?>, <?php echo $anio_max; ?>],
        connect: true,
        range: {
            min: 2000,
            max: new Date().getFullYear()
        },
        step: 1,
        tooltips: true,
        format: {
            to: (value) => Math.round(value),
            from: (value) => Number(value)
        }
    });

    // Asegurarse de que los valores del slider se copien en los campos hidden antes de enviar el formulario
    document.querySelector("form").addEventListener("submit", function(e) {
        // Prevenir el envío del formulario si los valores no están correctamente actualizados
        e.preventDefault(); 

        // Obtener los valores actuales de los sliders
        const kmValues = kmSlider.noUiSlider.get();
        const anioValues = anioSlider.noUiSlider.get();

        // Asignar esos valores a los campos hidden
        document.getElementById("km_min").value = kmValues[0].replace(/\./g, '');  // Eliminar puntos
        document.getElementById("km_max").value = kmValues[1].replace(/\./g, '');  // Eliminar puntos

        document.getElementById("anio_min").value = anioValues[0];
        document.getElementById("anio_max").value = anioValues[1];

        // Ahora enviar el formulario
        this.submit();
    });
</script>

</body>
</html>