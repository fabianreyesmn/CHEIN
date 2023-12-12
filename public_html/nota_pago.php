<head>
    <link rel="stylesheet" href="estilos/estilosLogin.css">
</head>
<?php
include 'otroheader.php';

require('../fpdf/fpdf.php');
require('../PHPMailer/PHPMailer.php');
require('../PHPMailer/SMTP.php');
require('../PHPMailer/Exception.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id']) && isset($_SESSION['nombre']) && isset($_SESSION['rango'])) {
    $id_usuario = $_SESSION['id'];
    $nombre_usuario = $_SESSION['nombre'];
    $rango_usuario = $_SESSION['rango'];
}

/*$servername = "localhost";
    $username = "cheinspa_admin";
    $password = "passWord#24";
    $dbname = "cheinspa_Chein";*/

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "chein";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexionn fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["metodo-seleccionado"] == "mastercard") {
        $metodoPago = "Mastercard";
        $nombre = $_POST["nombre"];
        $numero = $_POST["numero"];
        $expiracion = $_POST["expiracion"];
        $cvv = $_POST["cvv"];
    } else if ($_POST["metodo-seleccionado"] == "paypal") {
        $metodoPago = "PayPal";
        $monto = $_POST["monto"];
    }

    $correo = $_POST["correo"];
    $cupon = $_POST["cupon"];
    $nombre_completo = $_POST["nombre_completo"];
    $direccion = $_POST["direccion"];
    $ciudad = $_POST["ciudad"];
    $pais = $_POST["pais"];
    $codigo_postal = $_POST["codigo_postal"];
    $telefono = $_POST["telefono"];
    $pais = $_POST["pais"];
    $impuestos = 0;

    switch ($pais) {
        case 'espana':
            $impuestos = 21; // 21% de impuestos para España
            $envio = 10; // 10 unidades de moneda para envío a España
            break;
        case 'mexico':
            $impuestos = 16; // 16% de impuestos para México
            $envio = 15; // 15 unidades de moneda para envío a México
            break;
    }


    //Esto se saca sin importar que tipo de pago se hace, por eso lo puse afuera
    $sql = "SELECT p.Nombre_P, c.Cantidad, c.Cantidad * p.Precio_P * (1 - p.Descuento_P) AS Precio_Total FROM carrito c JOIN producto p ON c.ID_Producto = p.ID_Producto WHERE c.ID_Usuario = '$id_usuario';";
    $resultado = $conn->query($sql);
?>
    <div id="pagar-ult">
        <?php
        echo "<style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>";
        $montoTotal = 0;
        if ($resultado->num_rows > 0) {

            echo "<p>Nota de pago de " . $nombre . "</p>";
            echo "<table>";
            echo "<tr><th>Nombre del Producto</th><th>Cantidad</th><th>Precio Total</th></tr>";

            while ($row = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["Nombre_P"] . "</td>";
                echo "<td>" . $row["Cantidad"] . "</td>";
                echo "<td>" . $row["Precio_Total"] . "</td>";
                echo "</tr>";

                $montoTotal += $row["Precio_Total"];
                $productos[] = $row;
            }

            echo "</table>";
            echo "<p><strong>Subtotal:</strong> " . $montoTotal . "</p>";

            $montoTotal += $montoTotal * ($impuestos / 100); // Agregar impuestos
            $montoTotal += $envio; // Agregar costo de envío

            echo "<p><strong>Cobro de envio:</strong> " . $envio . "</p>";
            echo "<p><strong>Impuestos:</strong> " . $impuestos . "%</p>";
            echo "<p><strong>Modo de pago:</strong> " . $metodoPago . "</p>";
            echo "<p><strong>Direccion de envio:</strong> . $direccion . $ciudad . $codigo_postal </p>";

            if (isset($cupon) && !empty($cupon)) {
                echo "<p><strong>Cupón:</strong> " . $cupon . "</p>";
            }
            echo "<p><strong>Monto total por pagar:</strong> " . $montoTotal . "</p>";
        ?>
    </div>
<?php
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 16);
            $width = $pdf->GetPageWidth();
            $detailWidth = $width * 0.8; // 80% del ancho de la página
            $marginLeft = ($width - $detailWidth) / 2; // Margen izquierdo para centrar el contenido

            // Encabezado
            $pdf->SetX($marginLeft);
            $pdf->Cell($detailWidth, 7, iconv('UTF-8', 'ISO-8859-1', 'CHEIN'), 0, 1, 'C');
            $pdf->SetFont('Arial', '', 8);

            $pdf->SetX($marginLeft);
            $pdf->Cell($detailWidth, 7, iconv('UTF-8', 'ISO-8859-1', '123 Calle Principal, Ciudad, Estado, Código Postal'), 0, 1, 'C');

            $pdf->SetX($marginLeft);
            $pdf->Cell($detailWidth, 7, iconv('UTF-8', 'ISO-8859-1', 'Teléfono: (123) 456-7890'), 0, 1, 'C');

            $pdf->SetX($marginLeft);
            $pdf->Cell($detailWidth, 7, iconv('UTF-8', 'ISO-8859-1', 'Correo electrónico: info@chein.com'), 0, 1, 'C');

            $pdf->SetX($marginLeft);
            $pdf->MultiCell($detailWidth, 7, iconv('UTF-8', 'ISO-8859-1', 'CHEIN es una empresa líder en la venta de ropa y accesorios para mujer. Ofrecemos una amplia variedad de estilos para satisfacer todas tus necesidades de moda.'), 0, 'C');

            $pdf->SetX($marginLeft);
            $pdf->Cell($detailWidth, 7, iconv('UTF-8', 'ISO-8859-1', str_repeat('-', 80)), 0, 1, 'C'); // Línea de separación

            // Lista de productos
            $pdf->SetFont('Arial', '', 10); // Cambiar el tamaño de la fuente a 10
            foreach ($productos as $producto) {
                $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', $producto["Nombre_P"] . " - " . $producto["Cantidad"] . " - $" . $producto["Precio_Total"]), 0, 1, 'R'); // Alineado a la derecha
            }

            // Totales
            $pdf->SetFont('Arial', 'B', 10); // Cambiar el tamaño de la fuente a 10 y poner en negrita
            $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'Cobro de envío: $' . $envio), 0, 1, 'R'); // Alineado a la derecha
            $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'Impuestos: $' . $impuestos), 0, 1, 'R'); // Alineado a la derecha
            if (isset($cupon) && !empty($cupon)) {
                $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', "Cupón: " . $cupon), 0, 1, 'R');
            }
            $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'Monto total por pagar: $' . $montoTotal), 0, 1, 'R'); // Alineado a la derecha

            // Antes del método de pago
            $pdf->SetFont('Arial', '', 8);
            $pdf->SetX($marginLeft);
            $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', str_repeat('-', 80)), 0, 1, 'C'); // Línea de separación

            $pdf->SetFont('Arial', 'B', 14); // Cambiar el tamaño de la fuente a 14 y poner en negrita
            $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'Modo de pago: ' . $metodoPago), 0, 1, 'R');

            $pdf->SetFont('Arial', '', 10); // Cambiar el tamaño de la fuente a 10
            if ($metodoPago == "Mastercard") {
                $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'Nombre: ' . $nombre), 0, 1, 'R');
                $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'Número de tarjeta: ' . $numero), 0, 1, 'R');
                $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'Fecha de expiración: ' . $expiracion), 0, 1, 'R');
                $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'CVV: ' . $cvv), 0, 1, 'R');
            } else if ($metodoPago == "PayPal") {
                $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'Monto: ' . $monto), 0, 1, 'R');
            }

            $pdf->SetFont('Arial', 'B', 10); // Cambiar el tamaño de la fuente a 12 y poner en negrita
            $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'Dirección de envío: ' . "" . $direccion . " " . $ciudad . " / " . $codigo_postal), 0, 1, 'R');

            $pdf->SetFont('Arial', '', 8);
            $pdf->SetX($marginLeft);
            $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', str_repeat('-', 80)), 0, 1, 'C'); // Línea de separación

            $pdf->SetFont('Arial', 'B', 10); // Cambiar el tamaño de la fuente a 12 y poner en negrita
            $pdf->SetX($marginLeft);
            $pdf->Cell($detailWidth, 10, iconv('UTF-8', 'ISO-8859-1', 'Gracias por su compra :)'), 0, 1, 'C');

            $pdf->Output('F', 'nota_pago.pdf');

            echo "<script type='text/javascript'>
        window.open('nota_pago.pdf');
      </script>";


            $emailContent = "
<table>
<tr><td><h1>CHEIN</h1></td></tr>
<tr><td align='center'>123 Calle Principal, Ciudad, Estado, Código Postal</td></tr>
<tr><td align='center'>Teléfono: (123) 456-7890</td></tr>
<tr><td align='center'>Correo electrónico: info@chein.com</td></tr>
<tr><td align='center'>CHEIN es una empresa líder en la venta de ropa y accesorios para mujer. Ofrecemos una amplia variedad de estilos para satisfacer todas tus necesidades de moda.</td></tr>
<tr><td><hr></td></tr> <!-- Línea de separación -->
";

            foreach ($productos as $producto) {
                $emailContent .= "<tr><td align='right'>{$producto["Nombre_P"]} - {$producto["Cantidad"]} - $ {$producto["Precio_Total"]}</td></tr>";
            }

            $emailContent .= "
<tr><td align='right'><strong>Cobro de envío: $ {$envio}</strong></td></tr>
<tr><td align='right'><strong>Impuestos: $ {$impuestos}</strong></td></tr>
<tr><td align='right'><strong>Monto total por pagar: $ {$montoTotal}</strong></td></tr>
<tr><td align='right'><hr></td></tr> <!-- Línea de separación -->
<tr><td align='right'><strong>Modo de pago: {$metodoPago}</strong></td></tr>
";

            if ($metodoPago == "Mastercard") {
                $emailContent .= "
    <tr><td align='right'>Nombre: {$nombre}</td></tr>
    <tr><td align='right'>Número de tarjeta: {$numero}</td></tr>
    <tr><td align='right'>Fecha de expiración: {$expiracion}</td></tr>
    <tr><td align='right'>CVV: {$cvv}</td></tr>
    ";
            } else if ($metodoPago == "PayPal") {
                $emailContent .= "<tr><td align='right'>Monto: {$monto}</td></tr>";
            }
            if (isset($cupon) && !empty($cupon)) {
                $emailContent .= "<tr><td align='right'><strong>Cupón: {$cupon}</strong></td></tr>";
            }
            $emailContent .= "
<tr><td align='right'><strong>Dirección de envío: {$direccion} {$ciudad} / {$codigo_postal}</strong></td></tr>
<tr><td align='center'><hr></td></tr> <!-- Línea de separación -->
<tr><td align='center'><strong>Gracias por su compra :)</strong></td></tr>
</table>
";

            // Configura PHPMailer
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'moraleschavezjuan@gmail.com';
                $mail->Password = 'zfsn vkrn bkoh flld';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                $mail->setFrom('moraleschavezjuan@gmail.com', 'Administrador');
                $mail->addAddress("$correo");

                $mail->isHTML(true);
                $mail->Subject = 'Nota de Pago';
                $mail->Body    = $emailContent;

                $mail->send();
                echo 'Mensaje enviado con éxito. Gracias por contactarnos.';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }
