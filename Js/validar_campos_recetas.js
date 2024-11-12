
    // Validación para el campo 'titulo'
    document.getElementById('titulo').addEventListener('invalid', function(event) {
        if (event.target.value === '') {
            event.target.setCustomValidity('Por favor ingresa un título para la receta.');
        } else {
            event.target.setCustomValidity('');
        }
    });

    // Validación para el campo 'subtitulo'
    document.getElementById('subtitulo').addEventListener('invalid', function(event) {
        if (event.target.value === '') {
            event.target.setCustomValidity('Por favor ingresa un subtítulo para la receta.');
        } else {
            event.target.setCustomValidity('');
        }
    });

    // Validación para el campo 'ingredientes'
    document.getElementById('ingredientes').addEventListener('invalid', function(event) {
        if (event.target.value === '') {
            event.target.setCustomValidity('Por favor ingresa los ingredientes, separados por coma.');
        } else {
            event.target.setCustomValidity('');
        }
    });

    // Validación para el campo 'pasos'
    document.getElementById('pasos').addEventListener('invalid', function(event) {
        if (event.target.value === '') {
            event.target.setCustomValidity('Por favor ingresa los pasos a seguir, separados por coma.');
        } else {
            event.target.setCustomValidity('');
        }
    });

