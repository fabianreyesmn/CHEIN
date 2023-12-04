<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
        .tabla{
            text-align: center;
            padding-top: 30px;
            padding-left: 210px;
        }
        .imagenbb{
            width: 300px;
            height: 400px;
        }
        .t{
            text-align: center;
            font-family: 'GFS Didot', serif;
            font-weight: bold;
        }
        .contenedor:hover .imagen {-webkit-transform:scale(1.3);transform:scale(1.3);}
        .contenedor {overflow:hidden;}
        .titulo{
            text-align: center;
            font-family: 'GFS Didot', serif;
            font-size: 40px;
            font-weight: bold;
        }
        video {
        position: fixed;
        right: 0;
        bottom: 0;
        min-width: 105%;
        min-height: 100%;
        transform: translateX(calc((100% - 100vw) / 2));
        z-index: -2;
        }
    </style>
</head>
<body>
    <div class="todo">
        <video src="imagenes/production_id_4779866 (1080p).mp4" autoplay="true" muted="true" loop="true"></video>
    <p class="titulo">CHEIN</p>
    <table class="tabla">
        <tr>
            <td><div class="contenedor"><a href="mujer.html"><img class="imagenbb mujer imagen" src="imagenes/mujer.jpg" alt=""></a></div></td>
            <td><div class="contenedor"><a href="hombre.php"><img class="imagenbb hombre imagen" src="imagenes/hombre.jpg" alt=""></a></div></td>
            <td><div class="contenedor"><a href="accesorios.php"><img class="imagenbb otros imagen" src="imagenes/otros.jpg" alt=""></a></div></td>
        </tr>
        <tr>
            <td class="t">Ir a Moda MUJER</td>
            <td class="t">Ir a Moda HOMBRE</td>
            <td class="t">Ir a Moda ACCESORIOS</td>
        </tr>
    </table>
    </div>
</body>
</html>