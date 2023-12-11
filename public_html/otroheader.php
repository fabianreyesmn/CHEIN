<?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $servername = "localhost";
    $username = "cheinspa_admin";
    $password = "passWord#24";
    $dbname = "cheinspa_Chein";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexionn fallida: " . $conn->connect_error);
    }

    $agregados = null;

    if (isset($_SESSION['id']) && isset($_SESSION['nombre']) && isset($_SESSION['rango'])) {
        $id_usuario = $_SESSION['id'];
        $nombre_usuario = $_SESSION['nombre'];
        $rango_usuario = $_SESSION['rango'];

        $sql = "SELECT SUM(Cantidad) AS suma FROM carrito WHERE ID_Usuario = $id_usuario;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $agregados = $row['suma'];
        }
    }

?> 

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="estilos/estilosLogin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/48174618d9.js" crossorigin="anonymous"></script>
    <script src="scripts/scripts.js"></script>
    <title>CHEIN</title>
    
</head>
<body>
    <div style="color: black;" class="cute">
        <div class="cute1">
            <p><a class="links" href="productos.php">TIENDA</a></p>
            <p><a class="links" href="faqG.php">Q&A</a></p>
            <p><a class="links" href="contacto.php">CONTACTANOS</a></p>
            <p><a class="links" href="acerca_de.php">ABOUT</a></p>
        </div>
        <div class="cute2">
            <p class="titulo"><a class="links" href="index.php">CHEIN</a></p>
        </div>
        <div class="cute3">
            <?php
                if (isset($nombre_usuario) && $nombre_usuario !== null){
                    if(isset($rango_usuario) && $rango_usuario !== null){
                        if($rango_usuario == 1){
                            echo "<p><a class='links' href='ABC.php'>Altas, Bajas y Cambios</a></p>";
                        }
                    }
                    echo "<p><a class='links'>Hola, $nombre_usuario</a></p>";
                    echo '<p><a class="links" href="logout.php?logout"><i class="fa-solid fa-right-from-bracket">&nbsp;</i>Cerrar Sesion</a></p>';
                }else{
                    echo '<p><a class="links" name="btnMostrarMenu"><i class="fa-regular fa-user" style="color: #050505;">&nbsp;</i>Iniciar Sesion</a></p>';
                }
            ?>
            <p>
                <a class="links" href="carrito.php"><i class="fa-solid fa-bag-shopping" style="color: #000000;"></i></a>
                <span id="carritoContador" class="carrito-contador"><?php echo $agregados; ?></span>
            </p>
        </div>
    </div>

    <div id="contenedor">
        <div id="menuCierre" class="cerrar-menu">&times;</div>
        <div class="carruselLogin">
            <div class="mySlides" style="width:100%;  height: 100%;">
                <img src="imagenes/carrusel-1.png" style="width:100%;  height: 100%; border-start-start-radius: 9px; border-end-start-radius: 9px;">
            </div>
            <div class="mySlides" style="width:100%;  height: 100%;">
                <img src="imagenes/carrusel-2.png" style="width:100%;  height: 100%; border-start-start-radius: 9px; border-end-start-radius: 9px;">
            </div>
            <div class="mySlides" style="width:100%;  height: 100%;">
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
    <?php
        $conn->close();
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            btnOcultarMenu = document.getElementById('menuCierre');
            var btnMostrarMenu = document.getElementsByName('btnMostrarMenu');
            var menuFlotante = document.getElementById('contenedor');

            btnOcultarMenu.addEventListener('click', function() {
                var estiloDisplay = window.getComputedStyle(menuFlotante).display;
                
                if (estiloDisplay == 'grid') {
                    menuFlotante.style.display = 'none';
                }
            });

            btnMostrarMenu.forEach(function(boton) {
                boton.addEventListener('click', function() {
                    var estiloDisplay = window.getComputedStyle(menuFlotante).display;
                    
                    if (estiloDisplay === 'none') {
                        menuFlotante.style.display = 'grid';
                    }
                });
            });
        });

        function validarFormulario() {
            var password1 = document.getElementById('password').value;
            var password2 = document.getElementById('password2').value;
            var errorMensaje = document.getElementById('passwordMatchError');

            if (password1 !== password2) {
                errorMensaje.textContent = 'Las contrasenas no coinciden';
                return false;
            } else {
                errorMensaje.textContent = '';
                return true;
            }
        }
    </script>   
</body>