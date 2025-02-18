<?php

session_start(); // Inicia la sesión

?>







<!DOCTYPE html>

<html lang="es">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />

    <title>Flocars</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"

        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="

        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="flocars.css">

    <link rel="icon" href="Diseño_Logos/Diseño Logo Flocars.png" type="image/x-icon">



    <!-- scrollreveal -->

    <script src="https://unpkg.com/scrollreveal"></script>

    <script>

        





    </script>

</head>



<body>



<header class="header">

    <section class="llogo">

        <div class="overlay">

            <img src="Diseño_Logos/Diseño Logo Flocars Fondo.png">

            <h1 class="subtitle">¡Hola!</h1>

            <h1 class="title">Esta página es solo una demostración de mis habilidades. Sin ánimo de lucro.</h1>

        </div>

    </section>



    <!-- Menú de navegación para pantallas grandes -->

    <div class="navegacion">

        <li><a href="flocars.php"><img class="foto" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars"></a></li>

    <ul>

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

    <div class="forma">

        <svg viewBox="0 0 1500 200">

            <path fill="#fff" d="m 0,240 h 1500.4828 v -71.92164 c 0,0 -286.2763,-81.79324 -743.19024,-81.79324 C 300.37862,86.28512 0,168.07836 0,168.07836 Z" />

        </svg>

    </div>

</header>



    







    <section class="contenedor">

        <div class="CocheContainer">

            <div class="CocheItem">

                <img class="CochePortada" src="Imagenes Coches/1001 img 01.png" alt="Coche 1">

                <br><br>

                <a href="CompraCoche.php"><button class="boton">COMPRAR COCHE</button></a>

            </div>

            <div class="CocheItem">

                <img class="CochePortada" src="Imagenes Coches/1007 img 01.png" alt="Coche 2">

                <br><br>

                <a href="ReservaCoche.php"><button class="boton">VEHICULOS RESERVADOS</button></a>

            </div>

            <div class="CocheItem">

                <img class="CochePortada" src="Imagenes Coches/1009 img 01.png" alt="Coche 1">

                <br><br>

                <a href="CompraCoche.php"><button class="boton">COMPRAR COCHE</button></a>

            </div>

    

        </div>



    </section>



    <footer class="footer2">

        

        <img class="imgfooter" src="Diseño_Logos/Diseño Logo Flocars Fondo.png" alt="Logo Flocars">



    </footer>



    <script src="script.js"></script>

</body>





</html>