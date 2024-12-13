<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilocompra.css">
    <script defer src="../css/script.js"></script>
    <title>Compra de Entrada</title>
</head>

<body>
    <div class="entrada-info">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nombre = $_POST["nombre"];
            $artista = $_POST["artista"];
            $fechaEvento = $_POST["fecha"];
            $cantidad = $_POST["cantidad"];
            $localizacion = $_POST["localizacion"];
            $precio = $_POST["precio"];
            $img = $_POST["img"];



            $nombredecode = array_values(json_decode($nombre));
            $artistadecode = array_values(json_decode($artista));
            $fechaEventodecode = array_values(json_decode($fechaEvento));
            $cantidaddecode = array_values(json_decode($cantidad));
            $localizaciondecode = array_values(json_decode($localizacion));
            $preciodecode = array_values(json_decode($precio));
            $imgdecode = array_values(json_decode($img));


            echo "<div class='divMaestro'>";
            for ($i = 0; $i < count(json_decode($nombre)); $i++) {

                echo "<div class='divSupremo'>";
                echo "<div class='imgcerrarCompra'>
                        <button onclick='borrarEvento(event)'><img src='../img/x.svg' style='width: 15px; height: 15px;'></button>
                    </div>";
                echo "<div class='divimg'>";
                echo "<img class='imgCompra' src='" . $imgdecode[$i] . "' >";
                echo "</div>";
                echo "<div class='divCompra'>";
                echo "<h2 class='nombreCompra'>" . $nombredecode[$i] . "</h2>";
                echo "<p class='artistaCompra'>Artista: " . $artistadecode[$i] . "</p>";
                echo "<div class='location'>";
                echo "<img class='pingLocation' src='../img/location.svg'><p class='localizacion'>Localización: " .$localizaciondecode[$i] . " </p>";
                echo "</div>";
                echo "<div class='location'>";
                echo "<img class='pingLocation' src='../img/calendar.svg'><p class='fechaCompra'>Fecha de evento: " . $fechaEventodecode[$i] . "</p>";
                echo "</div>";
                echo "<div class='location'>";
                echo "<img class='pingLocation' src='../img/ticketcompra.svg'><p class='cantidadCompra'>Cantidad: " .$cantidaddecode[$i] . "</p>";
                echo "</div>";
                echo "<p class='precioCompra'>Precio total: " . $preciodecode[$i] . " </p>";
                echo "</div>";
                echo "</div>";

            }
            echo "</div>";


        }
        ?>
        <form action="../Vista/Soloentradas.php" method="POST" class="forma-pago">
           
            <input type="hidden" name="nombre" value="<?php echo htmlspecialchars(implode('/',$nombredecode )); ?>">
            <input type="hidden" name="artista" value="<?php echo htmlspecialchars(implode('/',$artistadecode)); ?>">
            <input type="hidden" name="fecha" value="<?php echo htmlspecialchars(implode('/',$fechaEventodecode)); ?>">
            <input type="hidden" name="cantidad" value="<?php echo htmlspecialchars(implode('/',$cantidaddecode)); ?>">
            <input type="hidden" name="localizacion"
                value="<?php echo htmlspecialchars(implode('/',$localizaciondecode)); ?>">
            <input type="hidden" name="precio" value="<?php echo htmlspecialchars(implode('/',$preciodecode)); ?>">
            <input type="hidden" name="img" value="<?php echo htmlspecialchars(implode(',',$imgdecode)); ?>">
            <?php
            ?>
            <input type="text" name="correo" class="campo-correo" placeholder="Introduce tu email" >
            <input type="submit" class="compra-btn" value="Compra">
        </form>
    </div>
</body>

</html>