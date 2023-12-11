<?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
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

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["metodo-pago"])) {
        $metodoPago = $_POST["metodo-pago"];
        if ($metodoPago === "oxxo") {
            ?>
                <div id="pagar-ult">
                    <form id="informacion-pago" action="nota_pago.php" method="post">
                        <!-- el action este es el que tienes que modificar para abrir tu pagina mas abajo hay otro-->
                        <h2>Información de Pago</h2>

                        <label for="correo">Correo Electrónico de PayPal:</label><br>
                        <input type="email" id="correo" name="correo" required><br>

                        <label for="monto">Monto a Pagar:</label><br>
                        <input type="number" id="monto" name="monto" min="0.01" step="0.01" required><br>

                        <label for="">Cupon de descuento</label><br>
                        <input type="text"><br>

                        <hr>

                        <h3>Donde quieres recibir tu pedido?</h3>

                        <label for="">Nombre completo</label><br>
                        <input type="text"><br>
                        <label for="">Direccion</label><br>
                        <input type="text"><br>
                        <label for="">Ciudad</label><br>
                        <input type="text"><br>
                        <label for="">Pais</label><br>
                        <input type="text"><br>
                        <label for="">Codigo postal</label><br>
                        <input type="text"><br>
                        <label for="">Numero telefonico</label><br>
                        <input type="text"><br><br>
                        <input type="hidden" name="metodo-seleccionado" value="paypal">
                        <button id="btn-1" type="submit">Realizar Pago</button><br>
                    </form>
                </div>
            <?php
        } elseif ($metodoPago === "mastercard") {
            ?>
                <div id="pagar-ult">
                    <form id="informacion-pago" action="nota_pago.php"  method="post">
                        <!-- el action este es el que tienes que modificar para abrir tu pagina -->
                        <h2>Información de Pago</h2>

                        <label for="nombre">Nombre en la Tarjeta:</label><br>
                        <input type="text" id="nombre" name="nombre" required><br>

                        <label for="numero">Número de Tarjeta:</label><br>
                        <input type="text" id="numero" name="numero" pattern="\d{16}" placeholder="16 dígitos" required><br>

                        <label for="expiracion">Fecha de Expiración:</label><br>
                        <input type="text" id="expiracion" name="expiracion" pattern="\d{2}/\d{2}" placeholder="MM/AA" required><br>

                        <label for="cvv">CVV:</label><br>
                        <input style="width: 100px;" type="text" id="cvv" name="cvv" pattern="\d{3}" placeholder="3 dígitos" required><br>

                        <label for="">Cupon de descuento</label><br>
                        <input type="text"><br>

                        <hr>

                        <h3>Donde quieres recibir tu pedido?</h3>

                        <label for="">Nombre completo</label><br>
                        <input type="text"><br>
                        <label for="">Direccion</label><br>
                        <input type="text"><br>
                        <label for="">Ciudad</label><br>
                        <input type="text"><br>
                        <label for="pais">Selecciona tu país:</label><br>
                        <select id="pais" name="pais">
                            <option value="espana">España</option>
                            <option value="mexico">México</option>
                        </select>
                        <br><label for="">Codigo postal</label><br>
                        <input type="text"><br>
                        <label for="">Numero telefonico</label><br>
                        <input type="text"><br><br>
                        <input type="hidden" name="metodo-seleccionado" value="mastercard">
                        <button id="btn-1" type="submit">Realizar Pago</button><br>
                    </form>
                </div>
            <?php
        } else {
            echo "<p>Seleccione un método de pago válido.</p>";
        }
    } else {
        echo "<p>No se ha seleccionado un método de pago.</p>";
    }
}
?>

<?php
    include 'footer.php';
?>