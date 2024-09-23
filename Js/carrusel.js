// Seleccionamos el contenedor que tiene las imágenes del carrusel
const carruselContainer = document.querySelector('.carrusel-imagenes');

// Duplicamos las imágenes del carrusel para que el bucle sea infinito
const images = Array.from(carruselContainer.children); //Con .children obtenemos los hijos de carruselContainer y con array.from los convertimos en un array para poder iterarlos
images.forEach(img => { //Recorremos cada imagen
    const clone = img.cloneNode(true); //Por cada imagen la clonamos y guardamos en clone
    carruselContainer.appendChild(clone); //Añadimos el clone al carruselContainer
});

// Variable para controlar la posición actual
let currentPosition = 0;

// Velocidad de desplazamiento en milisegundos
const speed = 0.2;

// Función para mover el carrusel
function moveCarrusel() {
    currentPosition -= speed; //Se resta el speed a la posicion en cada iamgen lo que hace que se muevan a la izquierda

    // Cuando las imágenes originales desaparecen por completo del área visible, reinicia la posición
    if (currentPosition <= -carruselContainer.scrollWidth / 2) { //scrollWidth es el ancho total del contenedor, incluidas las imágenes duplicadas. Por lo cual cuando currentPosition es igual o menor a este, quiere decir que ya se recorriendon las imagenes originales
        currentPosition = 0; //entonces volvemos a la posicion 0 creando el efecto infinito
    }

    // Aplicamos el desplazamiento al contenedor
    carruselContainer.style.transform = `translateX(${currentPosition}px)`;

    // Continuamos el ciclo
    requestAnimationFrame(moveCarrusel);
}

// Iniciar el carrusel
moveCarrusel();
