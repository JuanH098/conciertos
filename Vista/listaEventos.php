<?php
session_start();
$_SESSION["evento"] = [];

include("../config.php");
require(ROOT_PATH . "/Controlador/cont_listaEventos.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/Cartstyles.css">
    <link rel="stylesheet" href="../css/reservabtn.css">
    <link rel="stylesheet" href="../css/img.css">
    <script defer src="../css/script.js"></script>
    <link rel="icon" type="image/x-icon" href="../img/logo.ico">
    <title>Ticketsell®</title>
</head>

<body class="container">
    <header class="header">
        <h1 class="title">Ticketsell®</h1>
        <div class="opciones">
            <div>
                <h4><a href="listaEventos.php">Musica</a></h4>
            </div>
            <div>
                <h4><a href="">Otros</a></h4>
            </div>
            <div>
                <h4><a href="">Ayuda</a></h4>
            </div>
        </div>
        <div class="carrito-container">
            <a href="#" id="carrito-btn"><img class="carrito" src="../img/cart.svg" alt="carrito"></a>
            <div class="desplegable" style="display:none;" id="desplegable">
                <div class="btnsDesplegable">
                    <button id="comprar-btn" onclick="pagCompra()">Comprar</button>
                    <button id="cerrar-btn" onclick="cerrarDesplegable()">Cerrar</button>

                    <div>
                    </div>
                </div>
    </header>
    <main>
        <table border="1">
            <?php
            if (isset($datosEventos)) {
                foreach ($datosEventos as $evento) {
                    echo "<div class='divevento'>";
                    echo "<img src='" . $evento['imgsource'] . "' alt='Cartel' style='width: 200px; height: 200px;'>";
                    echo "<div class='middlediv'>";
                    echo "<div class='divName'>";
                    echo "<h2 class='evento-text nombre'>" . $evento['nombre'];
                    echo "</h2>";
                    echo "</div>";
                    echo "<div class='divText'>";
                    echo "<div>";
                    echo "<h2 class='evento-text artista'>" . $evento['artista'];
                    echo "</h2>";
                    echo "<p class='evento-text localizacion'>" . $evento['localizacion'];
                    echo ".</p>";

                    echo "<div>";

                    echo "<p class='evento-text fechaEvento'>Fecha y Horario: " . $evento['fechaEvento'];
                    echo ".</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";

                    echo "<div class='btndiv'><p>desde " . $evento['precio'] . "€</p>
                    <div class='botondiv'>
                    <input class='inputnum' type='number' value='1' onFocus='this.value=\"\"'> 
                    <button class='botonrsv' onclick='agregarAlCarrito(event,\"" . $evento['nombre'] . "\", \"" . $evento['artista'] . "\", \"" . $evento['localizacion'] . "\", \"" . $evento['fechaEvento'] . "\", " . $evento['precio'] . ", \"" . $evento['imgsource'] . "\")'>Añadir al carrito.</button><img class='ticketimg' src='/img/ticket.svg'></div></div>";
                    echo "</div>";

                }
            }
            ?>
        </table>
        <footer>


            <div class="infofooter">

                <div class="fotosContact">
                    <p class="contact">Contáctanos</p>
                    <a href=""><img src="/img/email.svg"> Email</a>
                    <a href=""><img src="/img/twitter.svg">Twitter</a>
                    <a href=""><img src="/img/instagram.svg">Instagram</a>
                    <a href=""><img src="/img/facebook.svg">Facebook</a>
                </div>

                <div class="contactosconimg">
                    <p class="contact">Descarga nuestra app</p>

                    <div class="apps">
                        <a href="https://www.apple.com/es/app-store/"><img
                                src="https://uk.tmconst.com/production-10-8-0-6655708/images/logo/apple-store/es.svg"></a>
                        <a href="https://store.google.com/es/?hl=es&pli=1"><img
                                src="https://uk.tmconst.com/production-10-8-0-6655708/images/logo/google-store/es.svg"></a>
                    </div>
                </div>
            </div>

            <p class="copy">Copyright Ticketsell®</p>
        </footer>
    </main>
</body>

</html>