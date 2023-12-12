<?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chein";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $agregados = 0;
    $exis = 0;
    $respuesta = array(0, 0.0, 0.0, 0);
    $precio_p = 0;

    if (isset($_SESSION['id']) && isset($_POST['sumarCarrito'])) {
        $id_usuario = $_SESSION['id'];
        $id_producto = $_POST['ID_Producto'];

        $sql = "SELECT Existencias_P FROM producto WHERE ID_Producto = $id_producto;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $exis = $row['Existencias_P'];
        }

        $sql = "SELECT SUM(Cantidad) AS suma FROM carrito WHERE ID_Usuario = $id_usuario AND ID_Producto = $id_producto;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $agregados = $row['suma'];
        }

        if ($exis-$agregados > 0){
            if ($agregados != null){
                $sql = "UPDATE carrito SET Cantidad = $agregados+1 WHERE ID_Usuario = $id_usuario AND ID_Producto = $id_producto;";
                if ($conn->query($sql) === TRUE) {
                    if ($conn->affected_rows > 0) {
                        //echo '<script>console.log("Producto agregado al carrito");</script>';
                    } else {
                        //echo '<script>console.log("Producto NO agregado al carrito");</script>';
                    }
                } else {
                    //echo '<script>console.log("Error al insertar registro al carrito");</script>';
                }
            } else{
                $sql = "INSERT INTO carrito(ID_Usuario, ID_Producto, Cantidad) VALUES ($id_usuario, $id_producto, 1)";
                if ($conn->query($sql) === TRUE) {
                    if ($conn->affected_rows > 0) {
                        //echo '<script>console.log("Producto agregado al carrito");</script>';
                    } else {
                        //echo '<script>console.log("Producto NO agregado al carrito");</script>';
                    }
                } else {
                    //echo '<script>console.log("Error al insertar registro al carrito");</script>';
                }
            }
        }

        // Artículos de cada producto en el carrito
        $sql = "SELECT SUM(Cantidad) AS suma FROM carrito WHERE ID_Usuario = $id_usuario AND ID_Producto = $id_producto;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $agregados = $row['suma'];
            $respuesta[0] = $agregados;
        }

        // Subtotal de cada producto en el carrito
        $sql = "SELECT Precio_P, Descuento_P FROM producto WHERE ID_Producto = $id_producto;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $precio_p = $row['Precio_P'];
            $descuento_p = $row['Descuento_P'];
            $respuesta[1] = round((($precio_p - $descuento_p) * $agregados), 2);
            $respuesta[1] = round($respuesta[1], 2);
            round($respuesta[1], 2);
        }

        // Total a pagar, TOTAL
        $sql = "SELECT * FROM carrito WHERE ID_Usuario = $id_usuario;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                $elemento = $row['ID_Producto'];
                $articulos = $row['Cantidad'];
                $sqlp = "SELECT Precio_P, Descuento_P FROM producto WHERE ID_Producto = $elemento;";
                $resultp = $conn->query($sqlp);
                if ($resultp->num_rows > 0){
                    $rowp = $resultp->fetch_assoc();
                    $precio_prod = $rowp['Precio_P'];
                    $descuento_prod = $rowp['Descuento_P'];
                    $respuesta[2] += round((($precio_prod - $descuento_prod) * $articulos), 2);
                }
            }
            $respuesta[2] = number_format($respuesta[2], 2, '.', '');
            number_format($respuesta[2], 2, '.', '');
        }

        // Artículos totales en el carrito (Piezas individuales)
        // Es el número que aparece en el icono de de la bolsa en el header
        $sql = "SELECT SUM(Cantidad) AS sumaTotal FROM carrito WHERE ID_Usuario = $id_usuario;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $nuevoTotalCarrito = $row['sumaTotal'];
            $respuesta[3] = $nuevoTotalCarrito;
        }

        $respuesta_json = json_encode($respuesta);
        header('Content-Type: application/json');

        echo $respuesta_json;
    }
    $conn->close();
?>