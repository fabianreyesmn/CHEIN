<?php
SESSION_START();
?>

<head>
    <link rel="stylesheet" href="estilos.css">
</head>

<body id="html">
    <div class="contenido2">
        <div class="contenedor-Altas">
            <div class="flex">
                <form id="productos" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="altas" enctype="multipart/form-data">
                    <legend>Nuevo producto</legend>

                    <label for="nombre_producto">Nombre del producto</label><br>
                    <input type="text" id="nombre_producto" name="nombre_producto" required><br>

                    <label for="descripcion_producto">Descripción del producto</label><br>
                    <textarea id="descripcion_producto" name="descripcion_producto" rows="7" cols="40" required></textarea><br>

                    <label for="precio_producto">Precio</label><br>
                    <input type="text" id="precio_producto" name="precio_producto"><br>

                    <label for="stock_producto">Cantidad en existencia</label><br>
                    <input type="text" id="stock_producto" name="stock_producto"><br>

                    <label for="imagen_producto">Imagen del producto</label><br>
                    <input type="file" id="imagen_producto" name="imagen_producto" accept="image/*"><br>

                    <label for="tiene_descuento">Tiene descuento</label><br>
                    <input type="checkbox" id="tiene_descuento" name="tiene_descuento" value="1"><br>

                    <label for="descuento_valor">Valor del descuento</label><br>
                    <input type="text" id="descuento_valor" name="descuento_valor"><br>

                    <input type="hidden" name="formulario" value="productos">
                    <input id="boton" type="submit" value="Enviar">
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST["formulario"]) && $_POST["formulario"] == "productos") {

                            $servidor = 'localhost';
                            $usuario = 'root';
                            $contrasena = '';
                            $base_de_datos = 'chein';

                            $conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);
                            if ($conexion->connect_error) {
                                die("Conexión fallida: " . $conexion->connect_error);
                            } else {
                                $nombre_producto = $_POST["nombre_producto"];
                                $descripcion_producto = $_POST["descripcion_producto"];
                                $precio_producto = $_POST["precio_producto"];
                                $stock_producto = $_POST["stock_producto"];
                                $imagen_producto = $_POST["imagen_producto"];
                                $tiene_descuento = isset($_POST["tiene_descuento"]) ? 1 : 0;
                                $descuento_valor = $_POST["descuento_valor"];

                                // Insertar en la tabla Producto
                                $sql = "INSERT INTO Producto (Nombre_P, Descripcion_P, Precio_P, Existencias_P, Imagen_P, Tiene_Descuento_P, Descuento_P) VALUES ('$nombre_producto', '$descripcion_producto', '$precio_producto', '$stock_producto', '$imagen_producto', '$tiene_descuento', '$descuento_valor')";
                                if ($conexion->query($sql) === TRUE) {
                                    echo "<div class='agregado'>";
                                    echo "<h4>Producto Agregado</h4>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='denegado'>";
                                    echo "<h4>Error al agregar el producto: " . $conexion->error . "</h4>";
                                    echo "</div>";
                                }
                            }
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="contenedor-Bajas">
            <legend id="title-bajas">Eliminar</legend>
            <form id="bajas" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div id="div-bajas">
                    <input id="bajas" type="text" placeholder="Nombre del producto" name="nombre" required>
                    <input type="hidden" name="formulario" value="bajas">
                    <button id="btn-bajas" type="submit">
                        <img src="https://icones.pro/wp-content/uploads/2021/06/icone-loupe-noir.png" alt="Lupa" width="25px" height="25px">
                    </button>
                </div>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["formulario"] == "bajas") {
                $servidor = 'localhost';
                $usuario = 'root';
                $contrasena = '';
                $base_de_datos = 'zara';

                $conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);
                if ($conexion->connect_error) {
                    die("Conexión fallida: " . $conexion->connect_error);
                } else {
                    $nombre = $_POST['nombre'];
                    $sql = "DELETE FROM Producto WHERE Nombre_P = '$nombre'";

                    if ($conexion->query($sql) === TRUE) {
                        echo "<div class='eliminado bajasmsg'>";
                        echo "<h4>Producto eliminado con éxito</h4>";
                        echo "</div>";
                    } else {
                        echo "<div class='denegado bajasmsg'>";
                        echo "<h4>Error al eliminar el producto: " . $conexion->error . "</h4>";
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>
        <div class="contenedor-Cambios">
            <legend id="title-cambios">Cambios</legend>
            <form id="cambios" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div id="div-cambios">
                    <input id="cambios" type="text" placeholder="Nombre del producto" name="nombre" required>
                    <input type="hidden" name="formulario" value="cambios">
                    <button id="btn-cambios" type="submit">
                        <img src="https://icones.pro/wp-content/uploads/2021/06/icone-loupe-noir.png" alt="Lupa" width="25px" height="25px">
                    </button>
                </div>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["formulario"] == "cambios") {

                $servidor = 'localhost';
                $usuario = 'root';
                $contrasena = '';
                $base_de_datos = 'chein';

                $conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);
                if ($conexion->connect_error) {
                    die("Conexión fallida: " . $conexion->connect_error);
                } else {
                    $nombre = $_POST['nombre'];
                    $sql = "SELECT
                        Producto.ID_Producto,
                        Producto.Nombre_P,
                        Producto.Descripcion_P,
                        Producto.Precio_P,
                        Producto.Categoria_P,
                        Producto.Existencias_P,
                        Producto.Esta_Agotado_P,
                        Producto.Imagen_P,
                        Producto.Tiene_Descuento_P,
                        Producto.Descuento_P
                        FROM
                            Producto
                        WHERE 
                            Nombre_P = '$nombre';";
                    $resultado = $conexion->query($sql);
                    if ($resultado->num_rows > 0) {
                        echo '<form id="form2" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
                        echo '<table id="tabla-cambios">';
                        echo '<tr>';
                        echo '<th>ID</th>';
                        echo '<th>Nombre</th>';
                        echo '<th>Descripcion</th>';
                        echo '<th>Precio</th>';
                        echo '<th>Categoria</th>';
                        echo '<th>Stock</th>';
                        echo '<th>Agotado</th>';
                        echo '<th>Imagen</th>';
                        echo '<th>Tiene Descuento</th>';
                        echo '<th>Descuento</th>';
                        echo '</tr>';

                        while ($fila = $resultado->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . '<input type="text" name="id_producto" value="' . $fila["ID_Producto"] . '" readonly>' . '</td>';
                            echo '<td>' . '<input type="text" name="nombre_producto" value="' . $fila['Nombre_P'] . '">' . '</td>';
                            echo '<td>' . '<input type="text" name="descripcion_producto" value="' . $fila['Descripcion_P'] . '">' . '</td>';
                            echo '<td>' . '<input type="text" name="precio_producto" value="' . $fila['Precio_P'] . '">' . '</td>';
                            echo '<td>' . '<input type="text" name="categoria_producto" value="' . $fila['Categoria_P'] . '">' . '</td>';
                            echo '<td>' . '<input type="text" name="stock_producto" value="' . $fila['Existencias_P'] . '">' . '</td>';
                            echo '<td>' . '<input type="text" name="agotado_producto" value="' . $fila['Esta_Agotado_P'] . '">' . '</td>';
                            echo '<td>' . '<input type="text" name="imagen_producto" value="' . $fila['Imagen_P'] . '">' . '</td>';
                            echo '<td>' . '<input type="text" name="tiene_descuento_producto" value="' . $fila['Tiene_Descuento_P'] . '">' . '</td>';
                            echo '<td>' . '<input type="text" name="descuento_producto" value="' . $fila['Descuento_P'] . '">' . '</td>';
                            echo '</tr>';
                        }

                        echo '</table>';
                        echo '<input type="hidden" name="formulario" value="realizar-cambios">';
                        echo '<button type="submit" name="enviar_fila">Enviar</button>';
                        echo '</form>';
                    } else {
                        echo "<div class='denegado cambiosmsg'>";
                        echo "<h4>El producto no existe</h4>";
                        echo "</div>";
                    }
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["formulario"] == "realizar-cambios") {
                $servidor = 'localhost';
                $usuario = 'root';
                $contrasena = '';
                $base_de_datos = 'chein';

                $conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);
                if ($conexion->connect_error) {
                    die("Conexión fallida: " . $conexion->connect_error);
                } else {
                    $id = $_POST['id_producto'];
                    $nombre = $_POST['nombre_producto'];
                    $descripcion = $_POST['descripcion_producto'];
                    $precio = $_POST['precio_producto'];
                    $categoria = $_POST['categoria_producto'];
                    $stock = $_POST['stock_producto'];
                    $agotado = $_POST['agotado_producto'];
                    $imagen = $_POST['imagen_producto'];
                    $tiene_descuento = $_POST['tiene_descuento_producto'];
                    $descuento = $_POST['descuento_producto'];

                    $sql = "UPDATE Producto SET 
                        Nombre_P = '$nombre', 
                        Descripcion_P = '$descripcion', 
                        Precio_P = '$precio', 
                        Categoria_P = '$categoria', 
                        Existencias_P = '$stock', 
                        Esta_Agotado_P = '$agotado', 
                        Imagen_P = '$imagen', 
                        Tiene_Descuento_P = '$tiene_descuento', 
                        Descuento_P = '$descuento' 
                    WHERE ID_Producto = '$id'";
                    $conexion->query($sql);

                    echo "<div class='agregado cambiosmsg'>";
                    echo "<h4>Producto modificado con éxito</h4>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    </div>
</body>