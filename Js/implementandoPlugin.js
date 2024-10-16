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
        errorElement: "span", // Cambia el elemento predeterminado a <span>
        errorPlacement: function(error, element) {
            error.addClass("validar-datos"); // Solo agrega la clase al mensaje de error
            error.insertAfter(element); // Coloca el mensaje después del input correspondiente
        },
        highlight: function(element) {
            $(element).removeClass("validar-datos"); // Remueve la clase del input, si se aplica por error
        },
        unhighlight: function(element) {
            $(element).removeClass("validar-datos"); // Asegura que el input no reciba la clase
        }
    });
});
