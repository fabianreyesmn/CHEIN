<?php
    function generarClaveAleatoria() {
      $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#${}^&*()+=?';
      $longitud = 6;
      $clave = '';

      for ($i = 0; $i < $longitud; $i++) {
          $clave .= $caracteres[rand(0, strlen($caracteres) - 1)];
      }

      return $clave;
    }

    if(isset($_COOKIE['nombre_usuario']) && isset($_COOKIE['password_usuario'])) {
        // Obtener el valor de la cookie
        $valorUsuario = $_COOKIE['nombre_usuario'];
        $valorUsuario_P = $_COOKIE['password_usuario'];
    } else {
        // Valor por defecto si la cookie no está presente
        $valorUsuario_P = '';
        $valorUsuario = '';
    }
  ?>

<head>
    <link rel="stylesheet" href="estilos/estilosLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Libre+Baskerville:wght@400;700&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/6661c2c190.js" crossorigin="anonymous"></script>
</head>

<nav id="menu">
    <button id="iniciarSesion" style="border: 2px solid white; width: 120px;">Iniciar Sesion</button>
    <button id="registrar" style="border:none;">Registrarse</button>
</nav>
<!-- onsubmit="return validarCaptcha();" -->
<form id="formLogin" onsubmit="return validarCaptcha();" style="padding-bottom: 5px; margin-bottom: 2px;">
    <label for="cuenta">Cuenta: </label><br>
    <input type="text" name="cuenta" placeholder="Usuario" value="<?php echo htmlspecialchars($valorUsuario); ?>" required><br>
    <label for="password">Contrasena: </label><br>
    <input type="password" name="password" placeholder="Ingresa tu contraseña" value="<?php echo htmlspecialchars($valorUsuario_P); ?>" required><br>
    <label for="password">Escriba el texto de la imagen </label><br><br>
    
    <div class="Rcaptcha" style="width: 220px; height: 25px; text-align: center; display: flex; margin-bottom: 10px;">
        <div id="recargarCaptcha">
            <?php
                $input_text = generarClaveAleatoria();
                $width = 70;
                $height = 25;
            
                $textImage = imagecreatetruecolor($width, $height);
                $color = imagecolorallocate($textImage, 0, 0, 0);
                imagecolortransparent($textImage, $color);            
                $blue = imagecolorallocate($textImage, 216, 213, 216);            
                $background = imagecreatetruecolor($width, $height);
                $backgroundColor = imagecolorallocate($background, 65, 66, 64 ); // Color de fondo
                imagefilledrectangle($background, 0, 0, $width, $height, $backgroundColor);
                
                $font = 'fonts/Arial.otf';
                //imagefilter($textImage, IMG_FILTER_GAUSSIAN_BLUR);
                imagettftext($textImage, 12, 0, 7, 17, $blue, $font, $input_text);            
                for ($i = 0; $i < 10; $i++) {
                    $green = imagecolorallocatealpha($background, 38, 54, 122, rand(50, 100)); // Color verde
                    $circleSize = rand(5, 20);
                    $circleX = rand(0, $width);
                    $circleY = rand(0, $height);
                    imagefilledellipse($background, $circleX, $circleY, $circleSize, $circleSize, $green);            
                    $lineColor = imagecolorallocatealpha($background, 56, 11, 59 , rand(50, 100)); // Color rojo
                    $lineX1 = rand(0, $width);
                    $lineY1 = rand(0, $height);
                    $lineX2 = rand(0, $width);
                    $lineY2 = rand(0, $height);
                    imageline($background, $lineX1, $lineY1, $lineX2, $lineY2, $lineColor);
                }
                imagecopymerge($background, $textImage, 0, 0, 0, 0, $width, $height, 100);
                $output = imagecreatetruecolor($width, $height);            
                imagecopy($output, $background, 0, 0, 0, 0, $width, $height);            
                imagefilter($output, IMG_FILTER_GAUSSIAN_BLUR);
                ob_start();
                imagepng($output);
                printf('<img id="output" src="data:image/png;base64,%s" />', base64_encode(ob_get_clean()));            
            ?>
        </div>
        <div>
            <button type="button" id="btnRecargar" style="border: none; height: 25px; width: 25px; background-color: transparent; padding: 0;"><i class="fa-solid fa-rotate-right fa-lg" style="color: #ffffff;"></i></button>
        </div>
        
        <input type="hidden" value="<?php echo htmlspecialchars($input_text); ?>" id="captcha1">
        <!-- placeholder="<?php echo htmlspecialchars($input_text); ?>" -->
        <input id="captcha2" name="captcha2" style="width: 70px; margin:0 0 0 10px; height: 25px; text-align: center;" type="text" required><br>
    </div>

    
        <small id="captchaMatchError" style="color: red;"></small>
    <div style="display: flex; align-items: left; margin-bottom: 20px; margin-top: 5px;">
        <div>
            <input style="margin: 0; transform: scale(0.8);" type="checkbox" name="remember" >
        </div>
        <div style="margin-left: 10px;">
            <small style="font-size: 0.8em; height: 1px; margin: 0;">Recordar usuario y contraseña</small>
        </div>
    </div>
    <input type="hidden" name="formulario" value="inicioSesion">
    <button id="submit" type="submit">Entrar</button>
</form>

<script>
    function reiniciarPagina(){
        location.reload();
    }

    document.getElementById('formLogin').addEventListener('submit', function (event) {
        event.preventDefault();
        if (validarCaptcha()) {
            // Obtener la información del formulario
            var formData = new FormData(this);

            // Realizar la solicitud AJAX
            $.ajax({
                type: 'post',
                url: 'info.php',  // Cambia esto a la ruta correcta de tu archivo PHP
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Actualizar el contenido del div con la respuesta del servidor
                    document.getElementById('infoPHP').innerHTML = response;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    $(document).ready(function() {
        $(document).off("click", "#btnRecargar").on("click", "#btnRecargar", function(event) {
            event.preventDefault();
            // Recarga el captcha llamando a la función cargarCaptcha
            cargarCaptcha('captcha.php');
        });

        function cargarCaptcha(url) {
            $.ajax({
                type: "get",
                url: url,
                success: function(data) {
                    $("#recargarCaptcha").html(data);

                    // Actualiza el placeholder del input
                    $("#captcha2").attr("placeholder", captchaValue);
                    $("#captcha1").attr("value", captchaValue);
                },
                error: function() {
                    console.log("Error al cargar el captcha");
                }
            });
        }
    });

    function validarCaptcha() {
            var captcha1 = document.getElementById('captcha1').value;
            var captcha2 = document.getElementById('captcha2').value;
            var errorMensaje = document.getElementById('captchaMatchError');

            if (captcha1 !== captcha2) {
                errorMensaje.textContent = 'El texto ingresado no coincide con la imagen';
                return false;
            } else {
                errorMensaje.textContent = captcha2.value;
                return true;
            }
        }
</script>