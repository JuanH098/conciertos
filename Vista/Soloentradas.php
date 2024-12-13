<?php
ob_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/SMTP.php';

include_once("../phpqrcode/qrlib.php");

$path = "../qrImg/";
$html = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = explode('/', $_POST["nombre"]);
    $artista = explode('/', $_POST["artista"]);
    $fechaEvento = explode('/', $_POST["fecha"]);
    $cantidad = explode('/', $_POST["cantidad"]);
    $localizacion = explode('/', $_POST["localizacion"]);
    $precio = explode('/', $_POST["precio"]);
    $img = explode(',', $_POST["img"]);
    $correo = $_POST["correo"];

    ob_start(); 
    echo "<div class='divMaestro'>";
    for ($i = 0; $i < sizeof($nombre); $i++) {
        echo "<div class='divSupremo'>";
        echo "<div class='divimg'>";
        echo "<img class='imgCompra' width='150px' height='150px' src=" . $img[$i] . " >";
        echo "</div>";
        echo "<div class='divCompra'>";
        echo "<h2 class='nombreCompra'>" . $nombre[$i] . "</h2>";
        echo "<p class='artistaCompra'>Artista: " . $artista[$i] . "</p>";
        echo "<div class='location'>";
        echo "<p class='localizacion'>Localización: " . $localizacion[$i] . " </p>";
        echo "</div>";
        echo "<div class='location'>";
        echo "Fecha de evento: " . $fechaEvento[$i] . "</p>";
        echo "</div>";
        echo "<div class='location'>";
        echo "Cantidad: " . $cantidad[$i] . "</p>";
        echo "</div>";
        echo "<p class='precioCompra'>Precio total: " . $precio[$i] . " </p>";
        echo "</div>";

        $qrcode = time() . '-' . ".jpeg";
        $qrtext = "E00$i" . "$nombre[$i]";

        QRcode::png($qrtext, $path . $qrcode, 'H', 4, 4);

        $nombreImagen = "../qrImg/" . $qrcode;
        $imagenBase64 = "data:image/jpeg;base64," . base64_encode(file_get_contents($nombreImagen));
        echo '<img src="' . $imagenBase64 . '" />';
        echo "</div>";
        
    }
    echo "</div>";
    $pdf = ob_get_clean(); // Capture PDF content after generating HTML
} else {
    echo "<p>No se encontraron entradas.</p>";
}

// Generate PDF before sending email
include_once("../dompdf/autoload.inc.php");
use Dompdf\Dompdf;

$dompdf = new Dompdf;

$opciones = $dompdf->getOptions();
$opciones->set('isRemoteEnabled', true);

$dompdf = new Dompdf($opciones);

$dompdf->loadhtml($pdf);
$dompdf->setPaper("A4");
$dompdf->render();
$pdfContent = $dompdf->output(); // Capture PDF content

// Now, after generating the PDF, you can send the email
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = 0; // Set to 2 for debugging information
    $mail->isSMTP();
    $mail->Host = 'smtp-mail.outlook.com'; // SMTP2GO SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'herreraharojuan@gmail.com'; // SMTP2GO username
    $mail->Password = 'artemi098'; // SMTP2GO password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, 'ssl' also accepted
    $mail->Port = 587;

    $mail->setFrom('herreraharojuan@gmail.com', 'Juan Herrera');
    $mail->addAddress($correo);

    // Attach PDF content to email
    $mail->addStringAttachment($pdfContent, 'entradas.pdf', 'base64', 'application/pdf');

    $mail->isHTML(true);
    $mail->Subject = 'Entradas ticketsell.';
    $mail->Body = 'Gracias por su compra.';

    $mail->send();
    echo 'Visita tu bandeja de GMAIL para visualizar las entradas y poder descargarlas.\n
        Recuerda revisar bien la bandeja de spam.';

} catch (Exception $e) {
    echo $mail->ErrorInfo;
}
?>
