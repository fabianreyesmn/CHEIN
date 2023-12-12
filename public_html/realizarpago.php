<?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
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

    if (isset($_SESSION['id']) && isset($_SESSION['nombre']) && isset($_SESSION['rango'])) {
        $id_usuario = $_SESSION['id'];
        $nombre_usuario = $_SESSION['nombre'];
        $rango_usuario = $_SESSION['rango'];
    }

    include 'otroheader.php';
?>

<head>
    <link rel="stylesheet" href="estilos/estilosLogin.css">
</head>

<div id="pago">
    <div id="div-1">
        <form action="info-forma-pago.php" method="post">
            <table id="tabla-div-1">
                <h2 id="titulopago">Metodos de pago</h2>
                <tbody>
                    <tr>
                        <td>
                            <label for="mastercard">Mastercard</label>
                        </td>
                        <td><img src="imagenes/mastercard.png" alt="Mastercard"></td>
                        <td>
                            <label for="mastercard">Tarjeta Bancaria</label>
                        </td>
                        <td>
                        <input type="radio" name="metodo-pago" id="mastercard" value="mastercard">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="oxxo">PayPal</label>
                        </td>
                        <td><img src="imagenes/paypal.png" alt="oxxo"></td>
                        <td>
                            <label for="oxxo">Pago en linea</label>
                        </td>
                        <td>
                        <input type="radio" name="metodo-pago" id="oxxo" value="oxxo">
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" id="forma-pago" value="continuar">
        </form>
    </div>
</div>
<?php
    include 'footer.php';
?>