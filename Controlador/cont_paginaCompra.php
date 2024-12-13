<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $nombre = $_POST["nombre"];
    $artista = $_POST["artista"];
    $fechaEvento = $_POST["fechaEvento"];
    $cantidad = $_POST["cantidad"];
    $precio = $_POST["precio"];


    echo "<h2>$nombre</h2>";
    echo "<p>Artista: $artista</p>";
    echo "<p>Fecha de evento: $fechaEvento</p>";
    echo "<p>Cantidad: $cantidad entradas</p>";
    echo "<p>Precio total: $precio €</p>";
 
    
} else {
   
    header("Location: ../Vista/error.php?message=Acceso%20no%20autorizado");
}
?>
