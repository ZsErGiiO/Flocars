<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consulta SQL para obtener todos los coches
$sql = "SELECT * FROM coches";
$result = $conn->query($sql);

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    // Si hay resultados, mostrar los datos
    while($row = $result->fetch_assoc()) {
        $numero = $row["numero"];
        $marca = $row["marca"];
        $modelo = $row["modelo"];
        $km = $row["km"];
        $año = $row["año"];
        $matriculacion = $row["matriculacion"];
        $potencia = $row["potencia"];
        $sistema = $row["sistema"];
        $combustible = $row["combustible"];
        $cambio = $row["cambio"];
        $traccion = $row["traccion"];
        $distribucion = $row["distribucion"];
        $plazas = $row["plazas"];
        $etiqueta_medioambiental = $row["etiqueta_medioambiental"];
        $imagen = "Imagenes Coches/{$row['numero']}";  // Asumiendo que el nombre de la imagen sigue este formato
?>
        <!-- Aquí generas el contenido dinámico para cada coche -->
        <section class="contenedor2">

            <div class="CocheContainer2">
                <div class="CocheItem2">
                    <img class="CochePortada2" src="<?php echo $imagen; ?>" alt="<?php echo $marca . ' ' . $modelo; ?>">
                    <br><br>
                    <a href="#">Número: <?php echo $numero; ?></a><br>
                    <a href="#">Marca: <?php echo $marca; ?></a><br>
                    <a href="#">Modelo: <?php echo $modelo; ?></a><br>
                    <a href="#">Kilómetros: <?php echo $km; ?> km</a><br>
                    <a href="#">Año: <?php echo $año; ?></a><br>
                    <a href="#">Matriculación: <?php echo $matriculacion; ?></a><br>
                    <a href="#">Potencia: <?php echo $potencia; ?> CV</a><br>
                    <a href="#">Sistema: <?php echo $sistema; ?></a><br>
                    <a href="#">Combustible: <?php echo $combustible; ?></a><br>
                    <a href="#">Cambio: <?php echo $cambio; ?></a><br>
                    <a href="#">Tracción: <?php echo $traccion; ?></a><br>
                    <a href="#">Distribución: <?php echo $distribucion; ?></a><br>
                    <a href="#">Plazas: <?php echo $plazas; ?></a><br>
                    <a href="#">Etiqueta Medioambiental: <?php echo $etiqueta_medioambiental; ?></a>
                </div>
            </div>

        </section>
<?php
    }
} else {
    echo "No hay coches disponibles.";
}

// Cerrar la conexión
$conn->close();
?>