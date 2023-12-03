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
            if($_POST["formulario"] == "registro"){
                $nombre = $_POST["nombre"];
                $cuenta = $_POST["cuenta"];
                $correo = $_POST["correo"];
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $preguntaSeguridad = $_POST["preguntaSeguridad"];
                $respuestaSeguridad = password_hash($_POST["respuestaSeguridad"], PASSWORD_DEFAULT);
                // Imprimir la información recolectada
                echo "Nombre: " . $nombre . "<br>";
                echo "Cuenta: " . $cuenta . "<br>";
                echo "Correo electrónico: " . $correo . "<br>";
                echo "Contraseña: " . $password . "<br>";
                echo "Pregunta de Seguridad: " . $preguntaSeguridad . "<br>";
                echo "Respuesta de Seguridad: " . $respuestaSeguridad . "<br>";
                // $sql = "INSERT INTO usuario (ID_Usuario, Nombre_U, Cuenta_U, Correo_U, Contrasena_U, Pregunta_Seg_U, Contrasena_Seg_U, Rango_U, Esta_Bloqueada) VALUES
                // (DEFAULT, '$nombre', '$cuenta', '$correo', '$password', '$preguntaSeguridad', '$$respuestaSeguridad', 0, 0);";

                // $resultado = $conexion->query($sql);
                // if($resultado){
                    // echo "Usuario ingresado con exito";
                // }
            }else if($_POST["formulario"] == "inicioSesion"){
                $cuenta = $_POST["cuenta"];
                $password = $_POST["password"];
                echo "Cuenta: " . $cuenta . "<br>";
                echo "Contraseña: " . $password . "<br>";
                //$sql = "SELECT * FROM usuario WHERE Nombre_U = '$nombre'";
                //$resultado = $conexion->query($sql);
                //if($resultado){
                    // echo "Si esta el usuario bro";
                //}else{
                    // echo "Que haces bobo";
                //}

           }
       }
    }
?>
