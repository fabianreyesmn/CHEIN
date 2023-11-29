function validarFormulario(){
    var password1 = document.getElementById('password').value;
    var password2 = document.getElementById('password2').value;
    var errorMensaje = document.getElementById('passwordMatchError');

    if (password1 !== password2) {
        errorMensaje.textContent = 'Las contraseñas no coinciden';
        return false; // Evita que se envíe el formulario
    } else {
        errorMensaje.textContent = '';
        return true; // Envía el formulario si las contraseñas coinciden
    }
}

$(document).ready(function() {
    $(document).on("click", "#iniciarSesion", function() {
        cargarContenido("iniciarSesion.php");
    });

    $(document).on("click", "#registrar", function() {
        $(this).addClass("boton-clic-registrar");
        cargarContenido("registrarse.php");
    });
});


function cargarContenido(url) {
    $.ajax({
        type: "get",
        url: url,
        success: function(data) {
            $(".formulariosLoginRegistro").html(data);
        },
        error: function() {
            alert("Error al cargar el contenido.");
        }
    });
}

document.getElementById('mostrarLoginBtn').addEventListener('click', function() {
    // Obtener el elemento del formulario de inicio de sesión
    var formularioLogin = document.getElementById('formularioLogin');

    // Alternar la clase "visible" para mostrar u ocultar el formulario al hacer clic en el botón
    formularioLogin.classList.toggle('visible');
});
  




