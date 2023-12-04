<?php 
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>

<head>
    <link rel="stylesheet" href="estilos/estilosLogin.css">
</head>

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
                //echo "Nombre: " . $nombre . "<br>";
                //echo "Cuenta: " . $cuenta . "<br>";
                //echo "Correo electrónico: " . $correo . "<br>";
                //echo "Contraseña: " . $password . "<br>";
                //echo "Pregunta de Seguridad: " . $preguntaSeguridad . "<br>";
                //echo "Respuesta de Seguridad: " . $respuestaSeguridad . "<br>";
                $sql = "SELECT * FROM usuario WHERE Cuenta_U = '$cuenta';";
                $resultado = $conexion->query($sql);
                if($resultado->num_rows > 0){
                    echo "<div style='margin:0 5px; padding-left: 20px;'>";
                    echo " <p style='margin: 0;'>El nombre de la cuenta ya existe </p> ";
                    echo "</div>";
                }else{
                    $sql = "INSERT INTO usuario (ID_Usuario, Nombre_U, Cuenta_U, Correo_U, Contrasena_U, Pregunta_Seg_U, Contrasena_Seg_U, Rango_U, Esta_Bloqueada) VALUES
                    (DEFAULT, '$nombre', '$cuenta', '$correo', '$password', '$preguntaSeguridad', '$respuestaSeguridad', 0, 0);";

                    $resultado = $conexion->query($sql);
                    if($resultado){
                        echo "<div style='margin:0 5px; padding-left: 20px;'>";
                        echo " <p style='margin: 0;'>Usuario ingresado con exito, ahora puedes iniciar sesion</p> "; 
                        echo "</div>";
                    }
                }   
            }else if($_POST["formulario"] == "inicioSesion"){
                $cuenta = $_POST["cuenta"];
                $password = $_POST["password"];
                //echo "Cuenta: " . $cuenta . "<br>";
                //echo "Contraseña: " . $password . "<br>";
                $sql = "SELECT * FROM usuario WHERE Cuenta_U = '$cuenta'";
                $resultado = $conexion->query($sql);
                if ($resultado->num_rows > 0) {
                    // El usuario existe, obtener información del usuario
                    $usuario = $resultado->fetch_assoc();
                    // Verificar la contraseña
                    if (password_verify($password, $usuario['Contrasena_U'])) {
                        $rango = $usuario['Rango_U'];
                        if($usuario['Esta_Bloqueada'] < 3){
                            $_SESSION['nombre'] = $cuenta;
                            $_SESSION['rango'] = $rango;
                            if (isset($_POST['remember'])){
                                $cookie_nombre = "nombre_usuario";
                                $cookie_valor = $cuenta;
                                setcookie($cookie_nombre, $cookie_valor, time() + (86400 * 30), "/"); // Cookie válida por 30 días

                                $cookie_password = "password_usuario";
                                $cookie_password_v = $password;
                                setcookie($cookie_password, $cookie_password_v, time() + (86400 * 30), "/"); // Cookie válida por 30 días    
                            }
                            $sqlUpdate = "UPDATE usuario SET Esta_Bloqueada = 0 WHERE Cuenta_U = '$cuenta'";
                            $conexion->query($sqlUpdate);
                            echo '<div id="navegar">';
                            echo "<h1>CHEIN</h1>";
                            echo "<h4>Es estilo no tiene reglas, las creas tu</h4>";
                            echo "<p>¡Bienvenido, $cuenta!</p>";
                            echo "<p>Esperamos que tengas una gran experiencia en nuestro sitio.</p>";
                            echo "<button id='submit' onclick='reiniciarPagina()'>Ir a CHEIN</button>";
                            echo "</div>";
                        }else{
                            echo "Cuenta bloqueada, para recuperar tu contrasena da click en el siguiente enlace.<br>";
                            echo "<a href='recuperarPassword.php'>Recuperar contrasena</a>";
                        }
                    } else {
                        if($usuario['Esta_Bloqueada'] < 3){
                            // La contraseña no es válida
                            echo "<div style='margin:0 5px; padding-left: 20px;'>";
                            echo " <p style='margin: 0;'>Contraseña incorrecta</p> ";
                            echo "</div>";
                            $sqlUpdate = "UPDATE usuario SET Esta_Bloqueada = Esta_Bloqueada + 1 WHERE Cuenta_U = '$cuenta'";
                            $conexion->query($sqlUpdate);
                        }else{
                            echo "Tu cuenta ha sido bloqueada, para recuperar tu contrasena da click en el siguiente enlace.<br>";
                            echo "<a href='recuperarPassword.php'>Recuperar contrasena</a>";
                        }
                    }
                } else {
                    // El usuario no existe
                    echo "<div style='margin:0 5px; padding-left: 20px;'>";
                    echo " <p style='margin: 0;'>Usuario no encontrado</p> ";
                    echo "</div>";
                }
            }
       }
    }
?>

<script>
    function reiniciarPagina(){
        window.location.href = "otroheader.php";
    }
</script>