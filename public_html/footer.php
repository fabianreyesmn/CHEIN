<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/48174618d9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>
    <style>
        .abajo1{
            border-top: solid 1px rgb(194, 194, 194);
            display: grid;
            font-family: 'GFS Didot', serif;
            grid-template-rows: 2;
            grid-template-columns: 7;
            background-color: whitesmoke;
            padding-top: 15px;
            grid-template-areas: 
                                "espacio na    ayuda  weare  interesar iconos espacio2"
                                "abajo2 abajo2 abajo2  abajo2  abajo3 abajo3 abajo3"
                                ;
        }
        .abajo1 .na{grid-area: na;}
        .abajo1 .ayuda{grid-area: ayuda;}
        .abajo1 .weare{grid-area: weare;}
        .abajo1 .interesar{grid-area: interesar;}
        .abajo1 .iconos{grid-area: iconos;}
        .abajo1 .espacio{grid-area: espacio;}
        .abajo1 .espacio2{grid-area: espacio2;}
        .abajo1 .abajo3{
            grid-area: abajo3;
            border-top: solid 1px rgb(194, 194, 194);
        }
        .titulom{
            font-family: 'GFS Didot', serif;
            font-weight: bolder;
        }
        .centrar{
            text-align: center;
        }
        .abajo1 .abajo2{
            grid-area: abajo2;
            border-top: solid 1px rgb(194, 194, 194);

        }
    </style>
</head>
<body>
</body>
<footer>
    <div class="abajo1">
        <div class="na">
        <p class="titulom">Necesitas Ayuda?</p><br>
        <p style="font-weight: bold;"><i class="fa-regular fa-comment-dots fa-lg" style="color: #000000;"></i> Iniciar Chat</p>
        <p>De lunes a viernes de 9:00 a 18:00</p><br>
        <p style="font-weight: bold;"><i class="fa-solid fa-headset fa-lg" style="color: #000000;"></i> Llamar 800 668 4389</p>
        <p>De lunes a viernes de 9:00 a 18:00</p>
        </div>
        <div class="ayuda">
            <p class="titulom">Ayuda</p>
            <p>Comprar Online</p>
            <p>Pago</p>
            <p>Envio</p>
            <p>Devoluciones</p>
            <p>Tarjeta de Regalo</p>
            <p>Compra como invitado</p>
            <p>Ticket Electronico</p>
            <p>Solicitar Factura</p>
        </div>
        <div class="weare">
            <p class="titulom">We are CHEIN</p>
            <p>Sobre CHEIN</p>
            <p>Sostenibilidad</p>
            <p>Affinity card</p>
            <p>Prensa</p>
            <p>Nuestras tiendas</p>
        </div>
        <div class="interesar">
            <p class="titulom">Te puede interesar</p>
            <p>Vestidos mujer</p>
            <p>Cazadoras mujer</p>
            <p>Abrigos mujer</p>
            <p>Jersey y punto mujer</p>
            <p>Baggy jeans</p>
            <p>Pantalones mujer</p>
            <p>Black Friday</p>
        </div>
        <div class="iconos">
            <p class="titulom">Redes sociales</p>
            &nbsp;&nbsp;&nbsp;<a href=""><i class="fa-brands fa-facebook fa-lg " style="color: #000000;"></i></a><br><br>
            &nbsp;&nbsp;&nbsp;<a href=""><i class="fa-brands fa-instagram fa-lg " style="color: #000000;"></i></a><br><br>
            &nbsp;&nbsp;&nbsp;<a href=""><i class="fa-brands fa-x-twitter fa-lg " style="color: #000000;"></i></a><br><br>
            &nbsp;&nbsp;&nbsp;<a href=""><i class="fa-brands fa-tiktok fa-lg" style="color: #000000;"></i></a><br><br>
            &nbsp;&nbsp;&nbsp;<a href=""><i class="fa-brands fa-youtube fa-lg" style="color: #000000;"></i></a><br><br>
            &nbsp;&nbsp;&nbsp;<a href=""><i class="fa-brands fa-pinterest fa-lg" style="color: #000000;"></i></a>
        </div>
        <div class="abajo2">
            <br>
            <p style="text-align: left; font-size: 14px;">Términos y condiciones de compra • Política de privacidad • Política de cookies • Configurar cookies • SiteMap </p>
        </div>
        <div class="abajo3">
            <br>
            <p style="text-align: right; font-size: 14px;"><i class="fa-solid fa-globe fa-lg" style="color: #000000;"></i> ES Espanol    &#169;CHEIN</p>
        </div>
        <div class="espacio">

        </div>
        <div class="espacio2">

        </div>
    </div>
</footer>
</html>