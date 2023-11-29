<?php
    session_start();
?>

<head>
    <link rel="stylesheet" href="estilos/estilosLogin.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="scripts/scripts.js"></script>
</head>

<body>
    <div id="contenedor">
        <div id="menuCierre" class="cerrar-menu">&times;</div>
        <div class="carruselLogin">
            <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="imagenes/carrusel-1.png" style="width:100%;  height: 100%; border-start-start-radius: 9px; border-end-start-radius: 9px;">
            </div>
            <div class="mySlides fade">
                <img src="imagenes/carrusel-2.png" style="width:100%;  height: 100%; border-start-start-radius: 9px; border-end-start-radius: 9px;">
            </div>
            <div class="mySlides fade">
                <img src="imagenes/carrusel-3.png" style="width:100%;  height: 100%; border-start-start-radius: 9px; border-end-start-radius: 9px;">
            </div>
            </div>
            <div style="text-align:center">
                <span class="dot"></span> 
                <span class="dot"></span> 
                <span class="dot"></span> 
            </div>
            <script>
                let slideIndex = 0;
                showSlides();

                function showSlides() {
                    let i;
                    let slides = document.getElementsByClassName("mySlides");
                    let dots = document.getElementsByClassName("dot");
                    for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";  
                    }
                    slideIndex++;
                    if (slideIndex > slides.length) {slideIndex = 1}    
                    for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                    }
                    slides[slideIndex-1].style.display = "block";  
                    dots[slideIndex-1].className += " active";
                    setTimeout(showSlides, 4000);
                }
            </script>
        </div>
        <div class="formulariosLoginRegistro">
            <nav id="menu">
                <button id="iniciarSesion" style="border:none;">Iniciar Sesion</button>
                <button id="registrar" style="border: 2px solid white;">Registrarse</button>
            </nav>
            <form action="info.php" method="post" id="formLogin" onsubmit="return validarFormulario()">
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
                <small id="passwordMatchError" style="color: red;"></small><br><br>

                <label for="respuestaSeguridad">Pregunta de Seguridad:</label><br>
                <select name="preguntaSeguridad" required>
                    <option value="" disabled selected hidden>Selecciona una pregunta</option>
                    <option value="PreguntaSeguridad">¿Cuál es el nombre de tu primera mascota?</option>
                    <option value="PreguntaSeguridad">¿Cuál es tu deporte favorito?</option>
                    <option value="PreguntaSeguridad">¿En qué ciudad naciste?</option>
                </select><br>

                <input type="password" name="respuestaSeguridad" placeholder="Ingresa tu respuesta" required autocomplete="off"><br>

                <button id="submit" type="submit">Registrarse</button>
            </form>

            <script>
                function validarFormulario() {
                    var password1 = document.getElementById('password').value;
                    var password2 = document.getElementById('password2').value;
                    var errorMensaje = document.getElementById('passwordMatchError');

                    if (password1 !== password2) {
                        errorMensaje.textContent = 'Las contraseñas no coinciden';
                        password2.value = ' ';
                        return false;
                    } else {
                        errorMensaje.textContent = '';
                        return true;
                    }
                }
            </script>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var btnMostrarMenu = document.getElementById('btnMostrarMenu');
            var menuFlotante = document.getElementById('contenedor');

            btnMostrarMenu.addEventListener('click', function() {
                var estiloDisplay = window.getComputedStyle(menuFlotante).display;
                
                if (estiloDisplay === 'grid') {
                    menuFlotante.style.display = 'none';
                } else {
                    menuFlotante.style.display = 'grid';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var btnMostrarMenu = document.getElementById('iniciarSesion');
            var menuFlotante = document.getElementById('contenedor');
            var btnCerrarMenu = document.getElementById('menuCierre');

            btnMostrarMenu.addEventListener('click', function() {
                menuFlotante.style.display = 'grid';
            });

            btnCerrarMenu.addEventListener('click', function() {
                menuFlotante.style.display = 'none';
            });
        });
    </script>
    
</body>
