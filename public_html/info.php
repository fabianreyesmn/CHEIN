<?php
    $servidor='localhost:3307';
    $cuenta='root';
    $password='';
    $bd='chein';
     
    $conexion = new mysqli($servidor,$cuenta,$password,$bd);

    if ($conexion->connect_errno){
        die('Error en la conexion');
    }else{
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener la información del formulario
            $nombre = $_POST["nombre"];
            $cuenta = $_POST["cuenta"];
            $correo = $_POST["correo"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            //$password2 = $_POST["password2"];
            $preguntaSeguridad = $_POST["preguntaSeguridad"];
            $respuestaSeguridad = $_POST["respuestaSeguridad"];
        
            // Imprimir la información recolectada
            echo "Nombre: " . $nombre . "<br>";
            echo "Cuenta: " . $cuenta . "<br>";
            echo "Correo electrónico: " . $correo . "<br>";
            echo "Contraseña: " . $password . "<br>";
            echo "Repetir Contraseña: " . $password2 . "<br>";
            echo "Pregunta de Seguridad: " . $preguntaSeguridad . "<br>";
            echo "Respuesta de Seguridad: " . $respuestaSeguridad . "<br>";


            $sql = "INSERT INTO usuario (ID_Usuario, Nombre_U, Cuenta_U, Correo_U, Contrasena_U, Pregunta_Seg_U, Contrasena_Seg_U, Rango_U, Esta_Bloqueada) VALUES
            (DEFAULT, '$nombre', '$cuenta', '$correo', '$password', '$preguntaSeguirdad', '$$respuestaSeguridad', 1, 0),";
        }
    }
?>
