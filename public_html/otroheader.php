<?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['nombre']) && isset($_SESSION['rango'])) {
        $nombre_usuario = $_SESSION['nombre'];
        $rango_usuario = $_SESSION['rango'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/48174618d9.js" crossorigin="anonymous"></script>
    <script src="scripts/scripts.js"></script>
    <title>Document</title>
    <style>
        .cute{
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
            background-color: whitesmoke;
            font-family: 'GFS Didot', serif;
            padding: 20px;
            width: 100%;
        }
        .cute1{
            display: flex;
            flex: 1;
            justify-content: flex-start;
        }
        .cute1 p{
            margin: 0 20px;
        }
        .cute2{
            display: flex;
            flex: 1;
            justify-content: center;
        }
        .cute3{
            display: flex;
            flex: 1;
            justify-content: flex-end;
        }
        .cute3 p{
            margin: 0 20px;
        }
        .titulo{
            text-align: center;
            font-weight: bolder;
            font-size: 40px;
        }
        .links{
            color: black; 
            text-decoration: none;
        }
        .links:hover{
            text-decoration: none;
            color: black; 
        }
    </style>
    <link rel="stylesheet" type="text/css" href="estilos/estilosLogin.css">
</head>
<body>
    <div class="cute">
        <div class="cute1">
            <p><a class="links" href="productos.php">TIENDA</a></p>
            <p><a class="links" href="">Q&A</a></p>
            <p><a class="links" href="">CONTACTANOS</a></p>
            <p><a class="links" href="">ABOUT</a></p>
        </div>
        <div class="cute2">
            <p class="titulo"><a class="links" href="paginicio.html">CHEIN</a></p>
        </div>
        <div class="cute3">
            <?php
                if (isset($nombre_usuario) && $nombre_usuario !== null){
                    if(isset($rango_usuario) && $rango_usuario !== null){
                        if($rango_usuario == 1){
                            echo "<p><a class='links'>Altas, Bajas y Cambios</a></p>";
                        }
                    }
                    echo "<p><a class='links'>Hola, $nombre_usuario</a></p>";
                    echo '<p><a class="links" id="btnMostrarMenu" href="logout.php?logout"><i class="fa-solid fa-right-from-bracket">&nbsp;</i>Cerrar Sesion</a></p>';
                }else{
                    echo '<p><a class="links" id="btnMostrarMenu"><i class="fa-regular fa-user" style="color: #050505;">&nbsp;</i>Iniciar Sesion</a></p>';
                }
            ?>
            <p><a class="links" href=""><i class="fa-solid fa-bag-shopping" style="color: #000000;"></i></a></p>
        </div>
    </div>
    <div id="contenedor">
        <div id="menuCierre" class="cerrar-menu">&times;</div>
        <div class="carruselLogin">
            <div class="mySlides fade" style="width:100%;  height: 100%;">
                <img src="imagenes/carrusel-1.png" style="width:100%;  height: 100%; border-start-start-radius: 9px; border-end-start-radius: 9px;">
            </div>
            <div class="mySlides fade" style="width:100%;  height: 100%;">
                <img src="imagenes/carrusel-2.png" style="width:100%;  height: 100%; border-start-start-radius: 9px; border-end-start-radius: 9px;">
            </div>
            <div class="mySlides fade" style="width:100%;  height: 100%;">
                <img src="imagenes/carrusel-3.png" style="width:100%;  height: 100%; border-start-start-radius: 9px; border-end-start-radius: 9px;">
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
            <div class="formulariosLR" style="padding-bottom: 0;">
                <?php include "registrarse.php"; ?>
            </div>
            <div id="infoPHP"> </div>
            <!-- FIN DE INFO.PHP -->
        </div>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            btnOcultarMenu = document.getElementById('menuCierre');
            var btnMostrarMenu = document.getElementById('btnMostrarMenu');
            var menuFlotante = document.getElementById('contenedor');

            btnOcultarMenu.addEventListener('click', function() {
                var estiloDisplay = window.getComputedStyle(menuFlotante).display;
                
                if (estiloDisplay == 'grid') {
                    menuFlotante.style.display = 'none';
                }
            });

            btnMostrarMenu.addEventListener('click', function() {
                var estiloDisplay = window.getComputedStyle(menuFlotante).display;
                
                if (estiloDisplay === 'none') {
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
    </script>   
</body>
</html>