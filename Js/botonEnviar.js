// Obtenemos elementos del DOM
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
    // Prevenimos que el formulario se envíe de inmediato
    event.preventDefault();

    // Mostramos el modal
    mostrarModal();

});

// Cerramos el modal cuando se haga clic en la X o en el botón OK
closeBtn.addEventListener('click', cerrarModal);
modalOk.addEventListener('click', function() {
    cerrarModal();
    formulario.submit();  // Cuando cerramos el modal, enviamos el form
});
