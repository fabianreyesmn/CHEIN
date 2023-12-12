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
            var respuesta = JSON.parse(xhr.responseText);
            document.getElementById('cantidad' + idProducto).innerText = respuesta[0];
            document.getElementById('sub' + idProducto).innerText = '$ ' + respuesta[1];
            document.getElementById('total-pagar').innerText = '$ ' + respuesta[2];
            document.getElementById('carritoContador').innerText = respuesta[3];
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
            var respuesta = JSON.parse(xhr.responseText);
            document.getElementById('cantidad' + idProducto).innerText = respuesta[0];
            document.getElementById('sub' + idProducto).innerText = '$ ' + respuesta[1];
            document.getElementById('total-pagar').innerText = '$ ' + respuesta[2];
            document.getElementById('carritoContador').innerText = respuesta[3];
            console.log(xhr.responseText);
        }
    };

    xhr.send('restarCarrito=true&ID_Producto=' + idProducto + '&cantidad=' + cantidad);
}

function quitarCarrito(idProducto) {
    var cantidad = 1;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'quitar.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            console.log(xhr.responseText);
        }
    };

    xhr.send('quitarCarrito=true&ID_Producto=' + idProducto + '&cantidad=' + cantidad);
}
