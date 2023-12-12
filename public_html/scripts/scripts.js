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

function mostrarPopup() {
    document.getElementById('miPopup').style.display = 'flex';
}

function cerrarPopup() {
    document.getElementById('miPopup').style.display = 'none';
}

window.onload = function() {
    // mostrarPopup(); // Puedes decidir si mostrar el popup al cargar la página
}

document.querySelector('#btn-sus').addEventListener('click', function(event) {
    event.preventDefault();
    mostrarPopup();
});

document.getElementById('formLogin').addEventListener('submit', function (event) {
    event.preventDefault();
    if (validarFormulario()) {
        // Obtener la información del formulario
        var formData = new FormData(this);

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'post',
            url: 'info.php',  // Cambia esto a la ruta correcta de tu archivo PHP
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                // Actualizar el contenido del div con la respuesta del servidor
                document.getElementById('infoPHP').innerHTML = response;
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
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




