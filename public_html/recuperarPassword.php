<head>
    <link rel="stylesheet" href="estilos/estilosLogin.css">
    <link rel="icon" href="imagenes/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon">
</head>

<body>
    <?php include "otroheader.php"; ?>
    <div id="div-form">
        <div id="formulario_recuperar">
            <div id="titulo"> <h1>Recuperar contraseña</h1> </div>
            <div id="recuperarContenedor">
                <?php
                $servidor = 'localhost';
                $cuenta = 'cheinspa_admin';
                $password = 'passWord#24';
                $bd = 'cheinspa_Chein';

                $conexion = new mysqli($servidor, $cuenta, $password, $bd);

                if ($conexion->connect_errno) {
                    die('Error en la conexion');
                } else {
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if ($_POST["form_R"] == "identificar_U") {
                            $cuenta = $_POST['nombre_U'];

                            $sql = "SELECT * FROM usuario WHERE Cuenta_U = '$cuenta'";
                            $resultado = $conexion->query($sql);

                            if ($resultado->num_rows > 0) {
                                $usuario = $resultado->fetch_assoc();
                                $contra_S = $usuario['Pregunta_Seg_U'];
                                switch ($contra_S) {
                                    case "Deporte":
                                        $pregunta_S = "¿Cuál es tu deporte favorito?";
                                        break;
                                    case "Mascota":
                                        $pregunta_S = "¿Cuál es el nombre de tu primera mascota?";
                                        break;
                                    case "Ciudad":
                                        $pregunta_S = "¿En qué ciudad naciste?";
                                        break;
                                    default:
                                        echo "Opción no reconocida";
                                }

                                // Formulario para la pregunta de seguridad
                                ?>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                    <label class="frecuperar" for="">Pregunta de seguridad</label><br><br>
                                    <label class="frecuperar" for=""><?php echo $pregunta_S ?></label>
                                    <input class="frecuperar" type="hidden" value="Pregunta_Seguridad_U" name="form_R">
                                    <input class="frecuperar" type="hidden" value="<?php echo $cuenta; ?>" name="nombre_U">
                                    <input class="frecuperar" type="password" name="respuesta_U" required><br><br>
                                    <input class="frecuperar" type="submit">
                                </form>
                                <?php
                            }
                        } elseif ($_POST["form_R"] == "Pregunta_Seguridad_U") {
                            // Verificar la respuesta a la pregunta de seguridad
                            $cuenta = $_POST['nombre_U'];
                            $respuesta_U = $_POST['respuesta_U'];

                            $sql = "SELECT * FROM usuario WHERE Cuenta_U = '$cuenta'";
                            $resultado = $conexion->query($sql);

                            if ($resultado->num_rows > 0) {
                                $usuario = $resultado->fetch_assoc();
                                $contra_S = $usuario['Pregunta_Seg_U'];
                                if (password_verify($respuesta_U, $usuario['Contrasena_Seg_U'])){
                                    // Mostrar formulario para cambiar la contraseña
                                    ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return validarFormulario2()">
                                        <label class="frecuperar" for="">Nueva Contraseña</label><br>
                                        <input class="frecuperar" type="password" id="password_U" name="password_U" required><br><br>
                                        <label class="frecuperar" for="">Repetir nueva contraseña</label><br>
                                        <input class="frecuperar" type="password" id="password_U2" name="confirm_password_U" required><br>
                                        <small class="frecuperar" id="passwordMatchError2" style="color: red;"> </small>
                                        <br><br><input class="frecuperar" type="hidden" value="Cambiar_Contrasena_U" name="form_R">
                                        <input class="frecuperar" type="hidden" value="<?php echo $cuenta; ?>" name="nombre_U">
                                        <input class="frecuperar" type="submit"><br>
                                    </form>
                                    <?php
                                } else { 
                                    switch ($contra_S) {
                                        case "Deporte":
                                            $pregunta_S = "¿Cuál es tu deporte favorito?";
                                            break;
                                        case "Mascota":
                                            $pregunta_S = "¿Cuál es el nombre de tu primera mascota?";
                                            break;
                                        case "Ciudad":
                                            $pregunta_S = "¿En qué ciudad naciste?";
                                            break;
                                        default:
                                            echo "Opción no reconocida";
                                    }
        
                                    // Formulario para la pregunta de seguridad
                                    ?>
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                                        <label class="frecuperar" for="">Pregunta de seguridad</label><br>
                                        <label class="frecuperar"><?php echo $pregunta_S ?></label>
                                        <input class="frecuperar" type="hidden" value="Pregunta_Seguridad_U" name="form_R">
                                        <input class="frecuperar" type="hidden" value="<?php echo $cuenta; ?>" name="nombre_U">
                                        <input class="frecuperar" type="password" name="respuesta_U" required><br><br>
                                        <input class="frecuperar" type="submit">
                                    </form>
                                    <?php
                                    echo "Respuesta incorrecta. Intenta de nuevo.";
                                }
                            }
                        } elseif ($_POST["form_R"] == "Cambiar_Contrasena_U") {
                            // Cambiar la contraseña
                            $cuenta = $_POST['nombre_U'];
                            $password_U = $_POST['password_U'];
                            $confirm_password_U = $_POST['confirm_password_U'];

                            if ($password_U == $confirm_password_U) {
                                // Actualizar la contraseña en la base de datos
                                $hashed_password = password_hash($password_U, PASSWORD_DEFAULT);
                                $sql = "UPDATE usuario SET Contrasena_U = '$hashed_password' WHERE Cuenta_U = '$cuenta'";
                                $resultado = $conexion->query($sql);

                                if ($resultado) {
                                    echo "Contraseña cambiada exitosamente.<br><br>";
                                    $sqlUpdate = "UPDATE usuario SET Esta_Bloqueada = 0 WHERE Cuenta_U = '$cuenta'";
                                    $conexion->query($sqlUpdate);
                                    ?>
                                        <input class="frecuperar" type="button" onclick="window.location.href='index.php'" value="Ir a CHEIN">
                                    <?php
                                } else {
                                    echo "Error al cambiar la contraseña.";
                                }
                            }
                        }
                    } else {
                        // Formulario inicial para ingresar la cuenta
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                            <label class="frecuperar" for="">Cuenta:</label>
                            <input class="frecuperar"  type="text" name="nombre_U" required >
                            <input class="frecuperar" type="hidden" value="identificar_U" name="form_R"><br><br>
                            <input class="frecuperar" type="submit">
                        </form>
                        <?php
                    }
                }
                ?>
            </div>
            <script>
                function validarFormulario2() {
                var password1 = document.getElementById('password_U').value;
                var password2 = document.getElementById('password_U2').value;
                var errorMensaje = document.getElementById('passwordMatchError2');

                if (password1 !== password2) {
                    errorMensaje.textContent = 'Las contraseñas no coinciden';
                    return false;
                } else {
                    errorMensaje.textContent = '';
                    return true;
                }
            }
            </script>
        </div>
    </div>
</body>
<?php include "footer.php"; ?>