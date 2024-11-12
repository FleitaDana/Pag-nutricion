// Obtener elementos del DOM
const formulario = document.getElementById('formularioContacto');
const modal = document.getElementById('modal');
const closeBtn = document.querySelector('.close');
const modalOk = document.getElementById('modalOk');

// Función para mostrar el modal
function mostrarModal() {
    modal.style.display = 'block';
}

// Función para cerrar el modal
function cerrarModal() {
    modal.style.display = 'none';
}

// Evento cuando se envía el formulario
formulario.addEventListener('submit', function(event) {
    // Prevenir que el formulario se envíe de inmediato
    event.preventDefault();

    // Mostrar el modal
    mostrarModal();

    // Puedes enviar el formulario después de que el modal se haya mostrado,
    // pero se debe enviar a través de un POST en el backend (PHP).
    // Aquí, el formulario se enviará después de cerrar el modal, con el botón OK.
});

// Cerrar el modal cuando se haga clic en la X o en el botón OK
closeBtn.addEventListener('click', cerrarModal);
modalOk.addEventListener('click', function() {
    cerrarModal();
    formulario.submit();  // Ahora que el modal se ha cerrado, puedes enviar el formulario
});
