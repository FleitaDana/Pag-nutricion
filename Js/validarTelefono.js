

const phoneInput = document.getElementById('phone'); //Obtenemos el elemento por su Id

phoneInput.addEventListener('input', function () { // Agregamos un evento para validar que solo se ingresen números

  this.value = this.value.replace(/[^0-9]/g, ''); // Eliminamos cualquier carácter que no sea un número

  // Verificamos si el valor está vacío o no contiene números
  if (this.value === '' || /[^0-9]/.test(this.value)) {
    message.style.display = 'block'; // Mostramos el mensaje
  } else {
    message.style.display = 'none'; // Ocultamos el mensaje
  }
});