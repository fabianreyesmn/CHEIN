<?php
SESSION_START();
?>

<?php include("otroheader.php") ?>

<head>
    <meta charset="UTF-8">
    <script src="https://kit.fontawesome.com/48174618d9.js" crossorigin="anonymous"></script>
    <link rel="icon" href="imagenes/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="imagenes/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=GFS+Didot&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABC</title>
    <link rel="stylesheet" href="estilos/estilosABC.css">
</head>

<body id="html">
    <div class="contenido2">
        <div class="contenedor-Altas">
            <div class="flex">
                <form id="productos" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="altas" enctype="multipart/form-data">
                    <legend>Nuevo producto</legend>
                    <label for="nombre_producto">Nombre del producto</label><br>
                    <input type="text" id="nombre_producto" name="nombre_producto" required><br>

                    <label for="descripcion_producto">Descripcion del producto</label><br>
                    <textarea id="descripcion_producto" name="descripcion_producto" rows="7" cols="40" required></textarea><br>

                    <label for="categoria_producto">Categoria</label><br>
                    <input type="text" id="categoria_producto" name="categoria_producto"><br>

                    <label for="existencias_producto">Cantidad en existencia</label><br>
                    <input type="text" id="existencias_producto" name="existencias_producto"><br>

                    <label for="agotado_producto">Esta Agotado?</label><br>
                    <input type="checkbox" id="agotado_producto" name="agotado_producto" value="1" onclick="toggleExistencias()"><br>

                    <label for="precio_producto">Precio</label><br>
                    <input type="text" id="precio_producto" name="precio_producto"><br>

                    <label for="imagen_producto">Imagen</label><br>
                    <input type="file" id="imagen_producto" name="imagen_producto"><br>

                    <label for="tiene_descuento">Tiene descuento</label><br>
                    <input type="checkbox" id="tiene_descuento" name="tiene_descuento" value="1" onclick="toggleDescuento()"><br>

                    <label for="descuento_producto">Descuento</label><br>
                    <input type="text" id="descuento_producto" name="descuento_producto"><br>

                    <input type="hidden" id="existencias_hidden" name="existencias_hidden">
                    <input type="hidden" id="descuento_hidden" name="descuento_hidden">

                    <input type="hidden" name="formulario" value="productos">
                    <input id="boton" type="submit" value="Enviar">
                    <script>
                        function toggleExistencias() {
                            var existenciasInput = document.getElementById('existencias_producto');
                            var agotadoCheckbox = document.getElementById('agotado_producto');
                            var existenciasHidden = document.getElementById('existencias_hidden');

                            if (agotadoCheckbox.checked) {
                                existenciasInput.style.display = 'none';
                                existenciasHidden.value = '0';
                            } else {
                                existenciasInput.style.display = 'block';
                                existenciasHidden.value = '';
                            }
                        }

                        function toggleDescuento() {
                            var descuentoInput = document.getElementById('descuento_producto');
                            var tieneDescuentoCheckbox = document.getElementById('tiene_descuento');
                            var descuentoHidden = document.getElementById('descuento_hidden');

                            if (tieneDescuentoCheckbox.checked) {
                                descuentoInput.style.display = 'block';
                                descuentoHidden.value = '';
                            } else {
                                descuentoInput.style.display = 'none';
                                descuentoHidden.value = '0';
                            }
                        }
                    </script>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (isset($_POST["formulario"]) && $_POST["formulario"] == "productos") {

                            /*
            $servidor = 'localhost';
            $usuario = 'cheinspa_admin';
            $contrasena = 'passWord#24';
            $base_de_datos = 'cheinspa_Chein';
            */

                            $servidor = 'localhost';
                            $usuario = 'root';
                            $contrasena = '';
                            $base_de_datos = 'chein';

                            $conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);
                            if ($conexion->connect_error) {
                                die("Conexión fallida: " . $conexion->connect_error);
                            } else {
                                $query = "SELECT MAX(ID_Producto) as maxID FROM Producto";
                                $result = $conexion->query($query);
                                $row = $result->fetch_assoc();
                                $lastID = $row['maxID'];

                                // Incrementar el último ID de producto para obtener un nuevo ID
                                $newID = $lastID + 1;
                                $nombre_producto = $_POST["nombre_producto"];
                                $descripcion_producto = $_POST["descripcion_producto"];
                                $categoria_producto = $_POST["categoria_producto"];
                                $existencias_producto = $_POST["existencias_producto"];
                                $agotado_producto = isset($_POST["agotado_producto"]) ? 1 : 0;
                                $precio_producto = $_POST["precio_producto"];

                                $targetDir = "fotos/";
                                $targetFile = $targetDir . basename($_FILES["imagen_producto"]["name"]);

                                $check = getimagesize($_FILES["imagen_producto"]["tmp_name"]);
                                if ($check !== false) {
                                    if (move_uploaded_file($_FILES["imagen_producto"]["tmp_name"], $targetFile)) {
                                        $nombreArchivo = pathinfo($targetFile, PATHINFO_BASENAME);
                                        $imagen_producto = $nombreArchivo;
                                        $tiene_descuento_producto = isset($_POST["tiene_descuento"]) ? 1 : 0;
                                        $descuento_producto = $_POST["descuento_producto"];
                                        $sql = "INSERT INTO Producto (ID_Producto, Nombre_P, Descripcion_P, Categoria_P, Existencias_P, Esta_Agotado_P, Precio_P, Imagen_P, Tiene_Descuento_P, Descuento_P) 
                    VALUES ('$newID', '$nombre_producto', '$descripcion_producto', '$categoria_producto', '$existencias_producto', '$agotado_producto', '$precio_producto', '$imagen_producto', '$tiene_descuento_producto', '$descuento_producto');";
                                        if ($conexion->query($sql) === TRUE) {
                                            echo "<div class='agregado'>";
                                            echo "<h4>Producto Agregado</h4>";
                                            echo "</div>";
                                        } else {
                                            echo "<div class='denegado'>";
                                            echo "<h4>Error al agregar el producto: " . $conexion->error . "</h4>";
                                            echo "</div>";
                                        }
                                    } else {
                                        echo "<div class='denegado'>";
                                        echo "<h4>Hubo un problema al subir la imagen.</h4>";
                                        echo "</div>";
                                    }
                                } else {
                                    echo "<div class='denegado'>";
                                    echo "<h4>El archivo no es una imagen válida.</h4>";
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
                    <input id="bajas" type="text" placeholder="ID del producto" name="id" required>
                    <input type="hidden" name="formulario" value="bajas">
                    <button id="btn-bajas" type="submit">
                        <img src="https://icones.pro/wp-content/uploads/2021/06/icone-loupe-noir.png" alt="Lupa" width="25px" height="25px">
                    </button>
                </div>
            </form>
            <?php

            /*
            $servidor = 'localhost';
            $usuario = 'cheinspa_admin';
            $contrasena = 'passWord#24';
            $base_de_datos = 'cheinspa_Chein';
            */

            $servidor = 'localhost';
            $usuario = 'root';
            $contrasena = '';
            $base_de_datos = 'chein';

            $conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);
            if ($conexion->connect_error) {
                die("Conexión fallida: " . $conexion->connect_error);
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["formulario"]) && $_POST["formulario"] == "bajas") {
                $id = $_POST['id'];
                $query = "SELECT * FROM producto WHERE ID_Producto = $id";
                $result = $conexion->query($query);
                if ($result->num_rows > 0) {
                    $producto = $result->fetch_assoc();
                    echo '<form id="form2" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post" enctype="multipart/form-data">';
                    echo '<legend>Eliminar producto</legend>';

                    echo '<label for="id_producto">ID del producto</label><br>';
                    echo '<input type="text" id="id_producto" name="id_producto" value="' . $id . '" readonly><br>';

                    echo '<label for="nombre_producto">Nombre del producto</label><br>';
                    echo '<input type="text" id="nombre_producto" name="nombre_producto" value="' . $producto['Nombre_P'] . '" readonly><br>';

                    echo '<label for="descripcion_producto">Descripcion del producto</label><br>';
                    echo '<textarea id="descripcion_producto" name="descripcion_producto" rows="7" cols="40" readonly>';
                    echo $producto['Descripcion_P'];
                    echo '</textarea><br>';

                    echo '<label for="categoria_producto">Categoria</label><br>';
                    echo '<input type="text" id="categoria_producto" name="categoria_producto" value="' . $producto['Categoria_P'] . '" readonly><br>';

                    echo '<label for="existencias_producto">Cantidad en existencia</label><br>';
                    echo '<input type="text" id="existencias_producto" name="existencias_producto" value="' . $producto['Existencias_P'] . '" readonly><br>';

                    echo '<label for="agotado_producto">Esta Agotado?</label><br>';
                    echo '<input type="checkbox" id="agotado_producto" name="agotado_producto" value="1"';
                    if ($producto['Esta_Agotado_P'] == 1) {
                        echo ' checked';
                    }
                    echo ' disabled><br>';

                    echo '<label for="precio_producto">Precio</label><br>';
                    echo '<input type="text" id="precio_producto" name="precio_producto" value="' . $producto['Precio_P'] . '" readonly><br>';

                    echo '<label for="imagen_producto">Imagen actual: ' . $producto['Imagen_P'] . '</label><br>';
                    echo '<input type="file" id="imagen_producto" name="imagen_producto" disabled><br>';

                    echo '<label for="tiene_descuento">Tiene descuento</label><br>';
                    echo '<input type="checkbox" id="tiene_descuento" name="tiene_descuento" value="1"';
                    if ($producto['Tiene_Descuento_P'] == 1) {
                        echo ' checked';
                    }
                    echo ' disabled><br>';

                    echo '<label for="descuento_producto">Descuento</label><br>';
                    echo '<input type="text" id="descuento_producto" name="descuento_producto" value="' . $producto['Descuento_P'] . '" readonly><br>';

                    echo '<input type="hidden" name="formulario" value="eliminar">';
                    echo '<input type="hidden" name="id" value="' . $id . '">';
                    echo '<button type="submit" name="confirmar" value="si">Sí</button>';
                    echo '<button type="submit" name="confirmar" value="no">No</button>';
                    echo '</form>';
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirmar"]) && $_POST["confirmar"] == "si") {
                $id = $_POST['id'];
                $deleteQuery = "DELETE FROM producto WHERE ID_Producto = $id";
                if ($conexion->query($deleteQuery) === TRUE) {
                    echo "Producto eliminado.";
                } else {
                    echo "Error al eliminar el producto: " . $conexion->error;
                }
            }
            ?>
        </div>
        <div class="contenedor-Cambios">
            <legend id="title-cambios">Cambios</legend>
            <form id="cambios" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div id="div-cambios">
                    <input id="cambios" type="text" placeholder="ID del producto" name="id" required>
                    <input type="hidden" name="formulario" value="cambios">
                    <button id="btn-cambios" type="submit">
                        <img src="https://icones.pro/wp-content/uploads/2021/06/icone-loupe-noir.png" alt="Lupa" width="25px" height="25px">
                    </button>
                </div>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["formulario"]) && $_POST["formulario"] == "cambios") {

                /*
            $servidor = 'localhost';
            $usuario = 'cheinspa_admin';
            $contrasena = 'passWord#24';
            $base_de_datos = 'cheinspa_Chein';
            */

                $servidor = 'localhost';
                $usuario = 'root';
                $contrasena = '';
                $base_de_datos = 'chein';

                $conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);
                if ($conexion->connect_error) {
                    die("Conexión fallida: " . $conexion->connect_error);
                } else {
                    $id = $_POST['id'];
                    $sql = "SELECT
                        Producto.ID_Producto,
                        Producto.Nombre_P,
                        Producto.Descripcion_P,
                        Producto.Categoria_P,
                        Producto.Existencias_P,
                        Producto.Esta_Agotado_P,
                        Producto.Precio_P,
                        Producto.Imagen_P,
                        Producto.Tiene_Descuento_P,
                        Producto.Descuento_P
                        FROM
                            Producto
                        WHERE 
                            ID_Producto = '$id';";
                    $resultado = $conexion->query($sql);
                    if ($resultado->num_rows > 0) {
                        while ($fila = $resultado->fetch_assoc()) {
                            echo '<form id="form2" action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post" enctype="multipart/form-data">';
                            echo '<legend>Modificar producto</legend>';

                            echo '<label for="id_producto">ID del producto</label><br>';
                            echo '<input type="text" id="id_producto" name="id_producto" value="' . $id . '" required><br>';

                            echo '<label for="nombre_producto">Nombre del producto</label><br>';
                            echo '<input type="text" id="nombre_producto" name="nombre_producto" value="' . $fila['Nombre_P'] . '" required><br>';

                            echo '<label for="descripcion_producto">Descripcion del producto</label><br>';
                            echo '<textarea id="descripcion_producto" name="descripcion_producto" rows="7" cols="40" required>';
                            echo $fila['Descripcion_P'];
                            echo '</textarea><br>';

                            echo '<label for="categoria_producto">Categoria</label><br>';
                            echo '<input type="text" id="categoria_producto" name="categoria_producto" value="' . $fila['Categoria_P'] . '"><br>';

                            echo '<label for="existencias_producto">Cantidad en existencia</label><br>';
                            echo '<input type="text" id="existencias_producto" name="existencias_producto" value="' . $fila['Existencias_P'] . '"><br>';

                            echo '<label for="agotado_producto">Esta Agotado?</label><br>';
                            echo '<input type="checkbox" id="agotado_producto" name="agotado_producto" value="1"';
                            if ($fila['Esta_Agotado_P'] == 1) {
                                echo ' checked';
                            }
                            echo '><br>';

                            echo '<label for="precio_producto">Precio</label><br>';
                            echo '<input type="text" id="precio_producto" name="precio_producto" value="' . $fila['Precio_P'] . '"><br>';

                            echo '<label for="imagen_producto">Imagen actual: ' . $fila['Imagen_P'] . '</label><br>';
                            echo '<input type="file" id="imagen_producto" name="imagen_producto"><br>';

                            echo '<label for="tiene_descuento">Tiene descuento</label><br>';
                            echo '<input type="checkbox" id="tiene_descuento" name="tiene_descuento" value="1"';
                            if ($fila['Tiene_Descuento_P'] == 1) {
                                echo ' checked';
                            }
                            echo '><br>';

                            echo '<label for="descuento_producto">Descuento</label><br>';
                            echo '<input type="text" id="descuento_producto" name="descuento_producto" value="' . $fila['Descuento_P'] . '"><br>';

                            echo '<input type="hidden" name="formulario" value="realizar-cambios">';
                            echo '<button type="submit" name="enviar_fila">Enviar</button>';
                            echo '</form>';
                        }
                    } else {
                        echo "<div class='denegado cambiosmsg'>";
                        echo "<h4>El producto no existe</h4>";
                        echo "</div>";
                    }
                }
            }
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["formulario"]) && $_POST["formulario"] == "realizar-cambios") {
                /*
            $servidor = 'localhost';
            $usuario = 'cheinspa_admin';
            $contrasena = 'passWord#24';
            $base_de_datos = 'cheinspa_Chein';
            */

                $servidor = 'localhost';
                $usuario = 'root';
                $contrasena = '';
                $base_de_datos = 'chein';

                $conexion = new mysqli($servidor, $usuario, $contrasena, $base_de_datos);
                if ($conexion->connect_error) {
                    die("Conexión fallida: " . $conexion->connect_error);
                } else {
                    $id = isset($_POST['id_producto']) ? $_POST['id_producto'] : '';
                    $nombre = $_POST['nombre_producto'];
                    $descripcion = $_POST['descripcion_producto'];
                    $categoria = $_POST['categoria_producto'];
                    $existencias = $_POST['existencias_producto'];
                    $agotado = isset($_POST['agotado_producto']) ? 1 : 0;
                    $precio = $_POST['precio_producto'];
                    $imagen = basename($_FILES["imagen_producto"]["name"]);
                    $tiene_descuento = isset($_POST['tiene_descuento']) ? 1 : 0;
                    $descuento = $_POST['descuento_producto'];

                    if ($agotado == 1) {
                        $existencias = 0;
                    }
                    if ($tiene_descuento == 0) {
                        $descuento = 0;
                    }

                    $imagen = isset($_FILES['imagen_producto']['name']) ? $_FILES['imagen_producto']['name'] : '';

                    $tiene_descuento = isset($_POST['tiene_descuento']) ? 1 : 0;
                    $descuento = $_POST['descuento_producto'];

                    if ($imagen != '') {
                        $carpeta_destino = 'fotos/';
                        $ruta_imagen = $carpeta_destino . $imagen;
                        move_uploaded_file($_FILES['imagen_producto']['tmp_name'], $ruta_imagen);
                    } else {
                        $sqlImagen = "SELECT Imagen_P FROM Producto WHERE Nombre_P = '$nombre'";
                        $resultadoImagen = $conexion->query($sqlImagen);

                        if ($resultadoImagen->num_rows > 0) {
                            $filaImagen = $resultadoImagen->fetch_assoc();
                            $imagen = $filaImagen['Imagen_P'];
                        }
                    }
                    $sql = "UPDATE Producto SET 
                    Nombre_P = '$nombre', 
                    Descripcion_P = '$descripcion', 
                    Categoria_P = '$categoria', 
                    Existencias_P = '$existencias', 
                    Esta_Agotado_P = '$agotado', 
                    Precio_P = '$precio', 
                    Imagen_P = '$imagen', 
                    Tiene_Descuento_P = '$tiene_descuento', 
                    Descuento_P = '$descuento' 
                WHERE ID_Producto = '$id';";
                    if ($conexion->query($sql) === TRUE) {
                        echo "<div class='aprobado cambiosmsg'>";
                        echo "<h4>El producto ha sido modificado con éxito.</h4>";
                        echo "</div>";
                    } else {
                        echo "<div class='denegado cambiosmsg'>";
                        echo "<h4>Error al modificar el producto: " . $conexion->error . "</h4>";
                        echo "</div>";
                    }
                }
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Crear los elementos canvas para las gráficas -->
    <div style="width: 50%; height: 400px;">
        <canvas id="productosChart"></canvas>
    </div>
    <div style="width: 50%; height: 400px;">
        <canvas id="usuariosChart"></canvas>
    </div>

    <?php
    $conexion = new mysqli('localhost', 'root', '', 'chein');

    $sqlProductos = "SELECT Nombre_P, Existencias_P FROM producto";
    $resultadoProductos = $conexion->query($sqlProductos);

    $sqlUsuarios = "SELECT COUNT(ID_Usuario) as usuarios FROM usuario";
    $resultadoUsuarios = $conexion->query($sqlUsuarios);

    $datosProductos = [];
    $datosUsuarios = [];

    while ($filaProductos = $resultadoProductos->fetch_assoc()) {
        $datosProductos[] = $filaProductos;
    }

    $filaUsuarios = $resultadoUsuarios->fetch_assoc();
    $datosUsuarios[] = $filaUsuarios;

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo json_encode(['productos' => $datosProductos, 'usuarios' => $datosUsuarios]);
        exit;
    }
    ?>

    <!-- Crear las gráficas con Chart.js -->
    <script>
        var ctxProductos = document.getElementById('productosChart').getContext('2d');
        var productosChart = new Chart(ctxProductos, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($datosProductos, 'Nombre_P')); ?>,
                datasets: [{
                    label: 'Existencias',
                    data: <?php echo json_encode(array_column($datosProductos, 'Existencias_P')); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        });

        var ctxUsuarios = document.getElementById('usuariosChart').getContext('2d');
        var usuariosChart = new Chart(ctxUsuarios, {
            type: 'pie',
            data: {
                labels: ['Usuarios registrados'],
                datasets: [{
                    label: 'Usuarios registrados',
                    data: <?php echo json_encode(array_column($datosUsuarios, 'usuarios')); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            }
        });

        function actualizarGraficas() {
            fetch('ABC.php', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    ventasChart.data.labels = data.ventas.map(item => item.Nombre_P);
                    ventasChart.data.datasets[0].data = data.ventas.map(item => item.ventas);
                    ventasChart.update();

                    usuariosChart.data.datasets[0].data = data.usuarios.map(item => item.usuarios);
                    usuariosChart.update();
                });
        }

        // Actualizar las gráficas cada 5 segundos
        setInterval(actualizarGraficas, 5000);
    </script>
</body>

<?php include("footer.php") ?>