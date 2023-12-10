<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c29b677056.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="estilos/estilo_productos.css">
    <title>CHEIN</title>
</head>
<body>
    <?php

    include "otroheader.php";

    $servername = "localhost:3306";
    $username = "root";
    $password = "";
    $dbname = "chein";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    ?>

    <div class="contenido">
        <div class="opciones">
            <div class="informacion">
                <h2>Todos los productos</h2>
                <div class="btns-categorias">
                    <a href="productos.php" class="btn-categoria">Todos</a>
                    <a href="ropa.php" class="btn-categoria">Ropa</a>
                    <a href="accesorios.php" class="btn-categoria">Accesorios</a>
                </div>
            </div>
            <div class="filtros">
                <div>
                    <p>
                        <button class="btn-filtros" type="button" data-bs-toggle="collapse" data-bs-target="#filtros" aria-expanded="false" aria-controls="filtros">
                            Filtros
                        </button>
                    </p>
                    <div style="min-height: 120px;">
                        <div class="collapse collapse-horizontal" id="filtros">
                            <div class="card card-body" style="width: 370px; height: 350px;">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                <label for="precio_min">Precio mínimo:</label>
                                <input type="number" name="precio_min" id="precio_min" placeholder="Precio mínimo" min="0">

                                <label for="precio_max">Precio máximo:</label>
                                <input type="number" name="precio_max" id="precio_max" placeholder="Precio máximo" min="0">

                                <label for="existencias_min">Existencias mínimas:</label>
                                <input type="number" name="existencias_min" id="existencias_min" placeholder="Existencias mínimas" min="0">

                                <label for="descuento">Con descuento:</label>
                                <select name="descuento" id="descuento">
                                    <option value="0">No</option>
                                    <option value="1">Sí</option>
                                </select>

                                <input type="submit" value="Filtrar" name="filtrar">
                            </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="orden">
                    <form id="formulario" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                        <label for="orden">Ordenar por precio:</label>
                        <select name="orden" id="orden">
                            <option value="asc">Precio de menor a mayor</option>
                            <option value="desc">Precio de mayor a menor</option>
                            <option value="none">Sin orden</option>
                        </select>

                        <input type="submit" value="Ordenar" name="ordenar" id="btn-ordenar">
                    </form>
                </div>
            </div>
        </div>
        <div class="tarjetas">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filtrar'])){
                    $precio_min = $_POST['precio_min'];
                    $precio_max = $_POST['precio_max'];
                    $existencias_min = $_POST['existencias_min'];
                    $descuento = $_POST['descuento'];

                    if ($precio_min == null){
                        $precio_min = 0;
                    }
                    if ($precio_max == null){
                        $precio_max = 999999999;
                    }
                    if ($existencias_min == null){
                        $existencias_min = 0;
                    }

                    $sql = "SELECT * FROM producto WHERE Precio_P - Descuento_P >= $precio_min AND Precio_P - Descuento_P <= $precio_max AND Existencias_P >= $existencias_min";

                    if ($descuento == 1) {
                        $sql .= " AND Descuento_P > 0;";
                    }else{
                        $sql .= " AND Descuento_P = 0;";
                    }

                    $result = $conn->query($sql);

                }elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ordenar'])){
                    $orden = $_POST['orden'];

                    $sql = "SELECT * FROM producto";
                    
                    if ($orden == 'asc') {
                        $sql .= " ORDER BY Precio_P - Descuento_P ASC";
                    } elseif ($orden == 'desc') {
                        $sql .= " ORDER BY Precio_P - Descuento_P DESC";
                    } else{
                        $sql .= ";";
                    }
                    
                    $result = $conn->query($sql);
                    
                }else{
                    $sql = "SELECT * FROM producto;";

                    $result = $conn->query($sql);
                    
                }
                if ($result->num_rows > 0){
                    echo '<div class="cuadricula">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="card-producto">';
                        echo '<form action="producto.php" method="post">';
                        echo '<input type="hidden" name="Imagen_P" value="' . $row['Imagen_P'] . '">';
                        echo '<input type="hidden" name="Nombre_P" value="' . $row['Nombre_P'] . '">';
                        echo '<input type="hidden" name="ID_Producto" value="' . $row['ID_Producto'] . '">';
                        echo '<input type="hidden" name="Descripcion_P" value="' . $row['Descripcion_P'] . '">';
                        echo '<input type="hidden" name="Existencias_P" value="' . $row['Existencias_P'] . '">';
                        echo '<input type="hidden" name="Precio_P" value="' . $row['Precio_P'] . '">';
                        echo '<input type="hidden" name="Tiene_Descuento_P" value="' . $row['Tiene_Descuento_P'] . '">';
                        echo '<input type="hidden" name="Descuento_P" value="' . $row['Descuento_P'] . '">';
                        echo '<button type="submit" class="btn-imagen"><img src="fotos/' . $row['Imagen_P'] . '" alt="' . $row['Nombre_P'] . '"></button>';
                        echo '</form>';
                        echo '<h4>' . $row['Nombre_P'] . '</h4>';
                        echo '<div class="centrar-card">';
                        echo '<p><i class="fa-solid fa-fingerprint"></i> ' . $row['ID_Producto'] . '</p>';
                        if ($row['Existencias_P'] > 125){
                            echo '<p class="verde">' . $row['Existencias_P'] . ' pzas.</p>';
                        }elseif ($row['Existencias_P'] >=50 && $row['Existencias_P'] <= 125){
                            echo '<p class="gris">' . $row['Existencias_P'] . ' pzas.</p>';
                        }elseif ($row['Existencias_P'] < 50 && $row['Existencias_P'] > 0){
                            echo '<p class="naranja">' . $row['Existencias_P'] . ' pzas.</p>';
                        }elseif ($row['Existencias_P'] == 0){
                            echo '<p class="rojo">' . $row['Existencias_P'] . ' pzas.</p>';
                        }
                        echo '<form id="agregar-car' . $row['ID_Producto'] . '">';
                        echo '<input type="hidden" name="ID_Producto" value="' . $row['ID_Producto'] . '">';
                        if (isset($_SESSION['id']) && $_SESSION['id'] !== null){
                            echo '<button type="button" onclick="agregarAlCarrito(' . $row['ID_Producto'] . ')" class="agregar-p"><i class="fa-solid fa-cart-plus"></i></button>';
                        }else{
                            echo '<button name="btnMostrarMenu" type="button" class="no-agregar-p"><i class="fa-solid fa-cart-plus"></i></button>';
                        }
                        echo '</form>';
                        echo '</div>';
                        
                        if ($row['Tiene_Descuento_P']) {
                            echo '<div class="centrar-card">';
                            echo '<p class="tachado"><i class="fa-solid fa-dollar-sign"></i> ' . $row['Precio_P'] . '</p>';
                            echo '<p><i class="fa-solid fa-dollar-sign"></i> ' . ($row['Precio_P'] - $row['Descuento_P']) . '</p>';
                            echo '</div>';
                        }else{
                            echo '<p><i class="fa-solid fa-dollar-sign"></i> ' . $row['Precio_P'] . '</p>';
                        }

                        echo '<p>' . $row['Descripcion_P'] . '</p>';

                        echo '</div>';
                    }
                    echo '</div>';
                }else{
                    echo "0 resultados";
                }
            ?>
        </div>
    </div>

    <?php
        $conn->close();
        include "footer.php";
    ?>
    <script src="scripts/scripts_productos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>