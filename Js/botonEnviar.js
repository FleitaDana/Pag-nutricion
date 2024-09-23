
function restaurarValoresPredeterminados() { // Función para vaciar los campos, pero devolver los valores predeterminados

    document.getElementById('name').value = 'Escribe tu nombre...'; // Establece el valor predeterminado en el campo "name"


    document.getElementById('lastname').value = 'Escribe tu apellido..'; // Establece el valor predeterminado en el campo "lastname"


    document.getElementById('phone').value = 'Escribe tu número de teléfono...'; // Establece el valor predeterminado en el campo "phone"


    document.getElementById('service').selectedIndex = 0; // Restaura la primera opción del menú desplegable "service"


    document.getElementById('consultation').value = 'Deja tu consulta aquí...'; // Establece el valor predeterminado en el campo "consultation"
}

// Captura el formulario y previene el comportamiento por defecto de envío
document.getElementById('formularioContacto').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita que el formulario se envíe automáticamente

    // Mostrar el modal personalizado
    document.getElementById('modal').style.display = 'block';

    // Limpia los campos y luego restaura los valores predeterminados
    restaurarValoresPredeterminados();
});

// Cuando el usuario hace clic en "OK", cerrar el modal
document.getElementById('modalOk').addEventListener('click', function () {
    // Oculta el modal cuando el botón OK es presionado
    document.getElementById('modal').style.display = 'none';
});

// Si se presiona la 'X' para cerrar el modal
document.querySelector('.close').addEventListener('click', function () {
    // Oculta el modal cuando el usuario hace clic en la 'X'
    document.getElementById('modal').style.display = 'none';
});

// Si el usuario hace clic fuera del contenido del modal, también se cierra
window.addEventListener('click', function (event) {
    // Si el usuario hace clic fuera del modal, lo oculta
    if (event.target === document.getElementById('modal')) {
        document.getElementById('modal').style.display = 'none';
    }
});
