<head>
    <link rel="stylesheet" type="text/css" href="estilos/estilosLogin.css">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&family=Libre+Baskerville:wght@400;700&family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="icon" href="imagenes/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon">
</head>


<nav id="menu">
    <button id="iniciarSesion" style="border: none;">Iniciar Sesion</button>
    <button id="registrar" style="border: 2px solid white;">Registrarse</button>
</nav>
    <!-- onsubmit="return validarFormulario();"  -->
    <form id="formLogin" style="padding-bottom: 5px; margin-bottom: 2px;">
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" placeholder="Nombre" required autocomplete="off"><br>

        <label for="cuenta">Cuenta:</label><br>
        <input type="text" name="cuenta" placeholder="Usuario" required autocomplete="off"><br>

        <label for="correo">Correo electrónico:</label><br>
        <input type="email" name="correo" placeholder="Correo electrónico" required autocomplete="off"><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" name="password" id="password" placeholder="Ingresa tu contraseña" required autocomplete="off"><br>

        <label for="password2">Repetir Contraseña:</label><br>
        <input type="password" name="password2" id="password2" placeholder="Confirma tu contraseña" required autocomplete="off" style="margin-bottom: 5px;">
        <small id="passwordMatchError" style="color: red;"></small><br>

        <label for="respuestaSeguridad">Pregunta de Seguridad:</label><br>
        <select name="preguntaSeguridad" required>
            <option value="" disabled selected hidden>Selecciona una pregunta</option>
            <option value="Mascota">¿Cuál es el nombre de tu primera mascota?</option>
            <option value="Deporte">¿Cuál es tu deporte favorito?</option>
            <option value="Ciudad">¿En qué ciudad naciste?</option>
        </select><br>

        <input type="password" name="respuestaSeguridad" placeholder="Ingresa tu respuesta" required autocomplete="off"><br>
        <input type="hidden" name="formulario" value="registro">
        <button id="submit" type="submit" style="margin-bottom: 0;">Registrarse</button>
    </form>

<script>
       function validarFormulario() {
            var password1 = document.getElementById('password').value;
            var password2 = document.getElementById('password2').value;
            var errorMensaje = document.getElementById('passwordMatchError');

            if (password1 !== password2) {
                errorMensaje.textContent = 'Las contraseñas no coinciden';
                document.getElementById('infoPHP').innerHTML = '';
                return false;
            } else {
                errorMensaje.textContent = '';
                return true;
            }
        }

        document.getElementById('formLogin').addEventListener('submit', function (event) {
            event.preventDefault();
            if (validarFormulario()) {
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
                        document.getElementById('infoPHP').innerHTML = '';
                        document.getElementById('infoPHP').innerHTML = response;
                        document.getElementById('formLogin').reset();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
</script>