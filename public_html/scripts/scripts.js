$(document).ready(function() {
    let formularioActual = "registrarse";

    $(document).on("click", "#registrar", function(event) {
        event.preventDefault();
        if (formularioActual !== "registrarse") {
            resetearDiv('infoPHP');
            cargarContenido("registrarse.php");
            formularioActual = "registrarse";
        }
    });

    $(document).on("click", "#iniciarSesion", function(event) {
        event.preventDefault();
        if (formularioActual !== "iniciarSesion") {
            resetearDiv('infoPHP');
            cargarContenido("iniciarSesion.php");
            formularioActual = "iniciarSesion";
            //cargarCaptcha("captcha.php");
        }
    });   
});

function resetearDiv(idDiv) {
    $("#" + idDiv).empty();  // Elimina todos los nodos hijos del div
}

function cargarContenido(url, formType) {
    $.ajax({
        type: "post",
        url: url,
        data: { formulario: formType },
        success: function(data) {
            $(".formulariosLR").html(data);
            formularioActual = formType;
        },
        error: function() {
            console.log("Error al cargar el contenido");
        }
    });
}

document.getElementById('mostrarLoginBtn').addEventListener('click', function() {
    // Obtener el elemento del formulario de inicio de sesión
    var formularioLogin = document.getElementById('formularioLogin');

    // Alternar la clase "visible" para mostrar u ocultar el formulario al hacer clic en el botón
    formularioLogin.classList.toggle('visible');
});




