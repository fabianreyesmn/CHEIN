<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/48174618d9.js" crossorigin="anonymous"></script>
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
            <p><a class="links" href="">Usuario</a></p>
            <p><a class="links" href=""><i class="fa-regular fa-user" style="color: #050505;">&nbsp;</i>Iniciar Sesion</a></p>
            <p><a class="links" href=""><i class="fa-solid fa-bag-shopping" style="color: #000000;"></i></a></p>
        </div>
    </div>
</body>
</html>