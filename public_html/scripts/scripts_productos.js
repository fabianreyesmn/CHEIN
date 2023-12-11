function agregarAlCarrito(idProducto) {
    var cantidad = 1;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'agregar.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('carritoContador').innerText = xhr.responseText;
            console.log(xhr.responseText);
        }
    };

    xhr.send('agregarAlCarrito=true&ID_Producto=' + idProducto + '&cantidad=' + cantidad);
}

function sumarCarrito(idProducto) {
    var cantidad = 1;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'sumar.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('cantidad' + idProducto).innerText = xhr.responseText;
            console.log(xhr.responseText);
        }
    };

    xhr.send('sumarCarrito=true&ID_Producto=' + idProducto + '&cantidad=' + cantidad);
}

function restarCarrito(idProducto) {
    var cantidad = 1;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'restar.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            document.getElementById('cantidad' + idProducto).innerText = xhr.responseText;
            console.log(xhr.responseText);
        }
    };

    xhr.send('restarCarrito=true&ID_Producto=' + idProducto + '&cantidad=' + cantidad);
}
