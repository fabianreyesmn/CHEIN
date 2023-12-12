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

    if (isset($_SESSION['id']) && isset($_POST['quitarCarrito'])) {
        $id_usuario = $_SESSION['id'];
        $id_producto = $_POST['ID_Producto'];

        $sql = "DELETE FROM carrito WHERE ID_Usuario = $id_usuario AND ID_Producto = $id_producto;";
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
    $conn->close();
?>