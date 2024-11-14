/*Implementacion del plugin jQuey Validation */

$(document).ready(function() {
    $("#formularioContacto").validate({
        rules: {
            nombre: {
                required: true,
                minlength: 2
            },
            apellido: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            nombre: {
                required: "Por favor ingrese su nombre",
                minlength: "Su nombre debe tener al menos 2 caracteres"
            },
            apellido: {
                required: "Por favor ingrese su apellido",
                minlength: "Su apellido debe tener al menos 2 caracteres"
            }
        },
        errorElement: "span", // Cambiamos el elemento predeterminado a <span>
        errorPlacement: function(error, element) {
            error.addClass("validar-datos"); // Solo agregamos la clase al mensaje de error
            error.insertAfter(element); // Colocamos el mensaje después del input correspondiente
        },
        highlight: function(element) {
            $(element).removeClass("validar-datos"); // Removemos la clase del input, si se aplica por error
        },
        unhighlight: function(element) {
            $(element).removeClass("validar-datos"); // Asegurmos que el input no reciba la clase
        }
    });
});
