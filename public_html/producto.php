<?php
    $Nombre_P = $_GET['Nombre_P'];
    $Imagen_P = $_GET['Imagen_P'];
    $Descripcion_P = $_GET['Descripcion_P'];
    $Existencias_P = $_GET['Existencias_P'];
    $Precio_P = $_GET['Precio_P'];
    $Tiene_Descuento_P = $_GET['Tiene_Descuento_P'];
    $Descuento_P = $_GET['Descuento_P'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilosProd.css">
    <title><?php echo $Nombre_P; ?></title>
</head>
<body>
    <?php include "otroheader.php" ?>
    <div class="principal">
        <div class="imagen">
            <?php
                echo '<img src="fotos/' . $Imagen_P . '" alt="' . $Nombre_P . '">';
            ?>
        </div>

        <div class="informacion">
            <?php
                echo '<h1>' . $Nombre_P . '</h1>';
                echo '<p>' . $Descripcion_P . '</p>';
                echo '<p>Existencias: ' . $Existencias_P . ' unidades</p>';
                echo '<p>Precio: $' . $Precio_P . '</p>';
                
                if ($Tiene_Descuento_P) {
                    echo '<p>Descuento: $' . $Descuento_P . '</p>';
                }

                echo '<button id="agregar-p">Agregar al carrito</button>';
            ?>
        </div>
    </div>
    <?php include "footer.php" ?>
</body>
</html>