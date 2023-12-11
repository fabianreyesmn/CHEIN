<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/estilos_carrito.css">
    <title>CHEIN</title>
</head>
<body>
    <?php
        include "otroheader.php";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        if (isset($_SESSION['id']) && $_SESSION['id'] !== null){
            ?>
            <div class="principal">
                <h2>Carrito <i class="fa-solid fa-cart-shopping"></i></h2>
            <?php
            $usuario = $_SESSION['id'];
            $total = 0;

            $sql = "SELECT * FROM carrito WHERE ID_Usuario=$usuario;";
            $result = $conn->query($sql);

            if ($result->num_rows > 0){
                echo '<div class="contenedor">';
                echo '<div class="lista">';
                while ($row = $result->fetch_assoc()) {
                    $producto = $row['ID_Producto'];
                    $cant = $row['Cantidad'];
                    $sqlprod = "SELECT * FROM producto WHERE ID_Producto=$producto;";
                    $resultprod = $conn->query($sqlprod);

                    while ($rowprod = $resultprod->fetch_assoc()){
                        if ($resultprod->num_rows > 0){
                            $descripcion = $rowprod['Descripcion_P'];
                            $precio = $rowprod['Precio_P'];
                            echo '<div class="registro">';
                            echo '<p><i class="fa-solid fa-fingerprint"></i> ' . $producto . '</p>';
                            echo '<p id="descripcion" class="centrar">' . $descripcion . '</p>';
                            echo '<button type="button" onclick="restarCarrito(' . $row['ID_Producto'] . ')" class="restar centrar menmas"><i class="fa-solid fa-minus"></i></button>';
                            echo '<p id="cantidad' . $row['ID_Producto'] . '" class="centrar">' . $cant . '</p>';
                            echo '<button type="button" onclick="sumarCarrito(' . $row['ID_Producto'] . ')" class="sumar centrar menmas"><i class="fa-solid fa-plus"></i></button>';
                            echo '<p><i class="fa-solid fa-dollar-sign"></i> ' . $cant * $precio . '</p>';
                            echo '<button type="button" class="trash"><i class="fa-solid fa-trash"></i></button>';
                            echo '</div>';
                            $total += $cant * $precio;
                        }
                    }
                }
                echo '</div>';
                echo '<div class="total">';
                echo '<h3>Total a pagar</h3>';
                echo '<h5><i class="fa-solid fa-dollar-sign"></i> ' . $total . '</h5>';
                echo '<button type="button" class="a-pagar"><a href="productos.php">Pagar</a></button>';
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';
        }else{
            echo '<div class="sin-log">';
                echo '<h3>Nada para mostrar, inicia sesión ó regístrate</h3>';
            echo '</div>';
        }
    ?>

    <?php
        include "footer.php";
    ?>
    <script src="scripts/scripts_productos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>