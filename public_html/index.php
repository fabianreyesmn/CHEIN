<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
    <title>CHEIN</title>
    <?php include 'otroheader.php'; ?>
    <style>
      .imagen1:hover {
        filter: grayscale(100%);
      }
      .titulop{
        font-family: 'GFS Didot', serif;
        font-weight: bolder;
      }
      .textoc{
            font-family: 'GFS Didot', serif;
            font-weight: bold;
      }
      .video{
        object-fit: fill;
      }
      .acomodarr{
        background-color: whitesmoke;
        padding: 0px;
        display: grid;
        grid-template-columns: 2;
        grid-template-rows: 5;
        grid-template-areas: "carrusel carrusel"
                             "categorias categorias"
                             "otro mensaje"
                             "enviar enviar"
                             "estilos estilos"
                              ;
      }
      .acomodarr .carrusel{
        grid-area: carrusel;}
      .acomodarr .estilos{
        grid-area: estilos;
        text-align: center;
        background-color: whitesmoke;
      }
      .acomodarr .categorias{
        grid-area: categorias;
        text-align: center;
        background-color: whitesmoke;
      }
      .acomodarr .enviar{grid-area: enviar;}
      .acomodarr .otro{
         text-align: center;
        grid-area: otro;
      }
      .acomodarr .mensaje{
        text-align:justify;
        grid-area:mensaje;
        padding-top:170px;
      }
      .contenedor{
        position: relative;
        display: inline-block;
        text-align: center;
      }
      .texto-encima{
        position: absolute;
        top: 260px;
        left: 10px;
      }
      .contenedor2:hover .imagen2 {-webkit-transform:scale(1.1);transform:scale(1.1);}
      .contenedor2 {overflow:hidden;}
      @font-face {
      font-family: myFirstFont;
      src: url(imagenes/Eina02-SemiBold.ttf);
    }
    .prueba{
      font-family: myFirstFont;
    }
    </style>
</head>
<body>
  <div class="acomodarr">
    <div class="carrusel">
  <div id="myCarousel" class="carousel slide carousel-container" data-ride="carousel">
  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <video class="video" style="height: 600px; width: 100%;" autoplay="true" muted="true" loop="true" >
          <source  src="imagenes/videomodelo1final.mp4" type="video/mp4">
        </video>
        <div class="carousel-caption d-none d-md-block">
          <!-- <h5>CHEIN</h5> -->
          <p style="font-family: 'GFS Didot', serif; color:whitesmoke;">Descubre tu estilo único en cada prenda. En nuestra tienda, la moda es más que ropa, es una expresión de tu personalidad.</p>
        </div>
      </div>
      <div class="carousel-item">
        <video class="video" style="height: 600px; width: 100%;" autoplay="true" muted="true" loop="true" >
          <source src="imagenes/videoModelo2.mp4" type="video/mp4">
        </video>
        <div class="carousel-caption d-none d-md-block">
          <!-- <h5>CHEIN</h5> -->
          <p style="font-family: 'GFS Didot', serif; color:whitesmoke;">Cada prenda cuenta una historia de moda y elegancia. Encuentra la tuya en nuestra colección exclusiva de tendencias irresistibles.</p>
        </div>
      </div>
      <div class="carousel-item">
        <video class="video" style="height: 600px; width: 100%;" autoplay="true" muted="true" loop="true" >
          <source src="imagenes/shoot.mp4" type="video/mp4">
        </video>
        <div class="carousel-caption d-none d-md-block">
          <!-- <h5>CHEIN</h5> -->
          <p style="font-family: 'GFS Didot', serif; color:whitesmoke;">Viste con confianza, viste con estilo. Explora nuestra tienda de ropa y haz que cada día sea una pasarela para tu propia moda.</p>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-target="#carouselExampleFade" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-target="#carouselExampleFade" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </button>
  </div>
</div>
<br><br><br>
</div>
<div class="categorias">
<p class="titulop" style="font-size:40px">Top Categories</p>
<div class="contenedor contenedor2">
  <a href=""><img class="imagen2" style="height: 300px; width: 250px;" src="imagenes/chamarra_azul.png" /></a>
  <div style="color: rgb(155, 153, 153); font-size: 20px;" class="texto-encima prueba ">Chamarras</div>
</div>
<div class="contenedor contenedor2">
  <a href=""><img class="imagen2" style="height: 300px; width: 250px;" src="imagenes/pantalon.png" /></a>
  <div style="color: rgb(155, 153, 153);  font-size: 20px;" class="texto-encima prueba">Pantalones</div>
</div>
<div class="contenedor contenedor2">
  <a href=""><img class="imagen2" style="height: 300px; width: 250px;" src="imagenes/scream.png" /></a>
  <div style="color: rgb(155, 153, 153);  font-size: 20px;" class="texto-encima prueba">Camisetas</div>
</div>
<div class="contenedor contenedor2">
  <a href=""><img class="imagen2" style="height: 300px; width: 250px;" src="imagenes/sudadera.png" /></a>
  <div style="color: rgb(155, 153, 153);  font-size: 20px;" class="texto-encima prueba">Sudaderas</div>
</div>
<div class="contenedor contenedor2">
  <a href=""><img class="imagen2" style="height: 300px; width: 250px;" src="imagenes/bolso.png" /></a>
  <div style="color: rgb(155, 153, 153);  font-size: 20px" class="texto-encima prueba">Accesorios</div>
</div>
<br><br><br><br>
</div>

<div class="estilos">
<p style="font-size:40px" class="titulop">Get the Look</p>
<p class="textoc">#CHEINSTYLE</p>
<a href=""><img class="imagen1" src="imagenes/party.png" alt=""></a>
<a href=""><img class="imagen1" src="imagenes/trendy.png" alt=""></a>
<a href=""><img class="imagen1" src="imagenes/leather.png" alt=""></a>
<a href=""><img class="imagen1" src="imagenes/casual.png" alt=""></a>
<br><br><br><br>
</div>
<div class="otro">
<a href=""><img src="imagenes/howtogift.png" alt=""></a>
<br><br><br><br>
</div>
<div class="mensaje">
<p class="textoc" style="font-size: 20px;">La forma más fácil de acertar este año, <br> encontrar lo que has estado buscando para tus seres queridos <br> o incluso para ti mismo.</p>
</div>
</div>
</body>

<?php include 'footer.php'; ?>
