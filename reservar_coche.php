<?php
session_start();
include 'conexion.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    
    // Actualizar el estado del coche a "Reservado"
    $sql = "UPDATE coches SET estado = 'reservado' WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirigir a la página de detalles con un parámetro de éxito
        header("Location: detalleCoche.php?id=$id&estado=reservado");
    } else {
        echo "Error al actualizar el estado: " . $conn->error;
    }
} else {
    echo "No se ha recibido el id del coche.";
}

$conn->close();
?>