<?php
     if(session_status() === PHP_SESSION_NONE) {
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

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //Hay dos formas de pago, por eso hago esto, cada formulario te da distinta info
        if($_POST["metodo-seleccionado"] == "mastercard"){
            //Aqui para mastercard
        }else if($_POST["metodo-seleccionado"] == "paypal"){
            //Aqui para paypal
        }


        //Esto se saca sin importar que tipo de pago se hace, por eso lo puse afuera
        $sql = "SELECT 
                    p.Nombre_P, 
                    c.Cantidad, 
                    c.Cantidad * p.Precio_P * (1 - p.Descuento_P) AS Precio_Total 
                FROM 
                    carrito c JOIN producto p ON c.ID_Producto = p.ID_Producto
                WHERE 
                    c.ID_Usuario = '$id_usuario';";
                $resultado = $conn->query($sql);

        if($resultado->num_rows > 0){
            //Aqui ya tienes el nombre del producto, la cantidad por producto y el precio por producto (contando que son x Numero de elementos por cada prodcuto)
            //Ya solo pones la info de los prodcutos en el PDF, en la web y en el correo.
        }
    }
?>