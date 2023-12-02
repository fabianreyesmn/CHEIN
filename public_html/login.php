<?php
    session_start();
?>

<head>
<head>
    <link rel="stylesheet" type="text/css" href="estilos/estilosLogin.css">
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
        <div class="formulariosLoginRegistro" id="registroFormulario">
            <div class="formulariosLR">
                <?php include "registrarse.php"; ?>
            </div>
            <div id="infoPHP"> </div>
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

        function validarFormulario() {
            var password1 = document.getElementById('password').value;
            var password2 = document.getElementById('password2').value;
            var errorMensaje = document.getElementById('passwordMatchError');

            if (password1 !== password2) {
                errorMensaje.textContent = 'Las contraseñas no coinciden';
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
                        document.getElementById('infoPHP').innerHTML = response;
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>   
</body>
