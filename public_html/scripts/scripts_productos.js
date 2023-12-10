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
