// js/script.js
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#contact-form');
    if (!form) return;

    const inputs = {
        nombre: form.querySelector('#nombre'),
        email: form.querySelector('#email'),
        asunto: form.querySelector('#asunto'),
        mensaje: form.querySelector('#mensaje'),
    };

    const submitBtn = form.querySelector('button[type="submit"]');

    // Función para mostrar error debajo del campo
    function showError(input, message) {
        let errorEl = input.nextElementSibling;
        if (!errorEl || !errorEl.classList.contains('error-text')) {
            errorEl = document.createElement('p');
            errorEl.className = 'error-text text-red-600 text-sm mt-1';
            input.parentNode.appendChild(errorEl);
        }
        errorEl.textContent = message;
        input.classList.add('border-red-500');
    }

    function clearError(input) {
        const errorEl = input.nextElementSibling;
        if (errorEl && errorEl.classList.contains('error-text')) {
            errorEl.textContent = '';
        }
        input.classList.remove('border-red-500');
    }

    // Validaciones en tiempo real (al blur o input)
    Object.keys(inputs).forEach(key => {
        inputs[key].addEventListener('input', validateField);
        inputs[key].addEventListener('blur', validateField);
    });

    function validateField(e) {
        const input = e.target;
        const value = input.value.trim();

        clearError(input);

        if (input.required && value === '') {
            showError(input, 'Este campo es obligatorio.');
            return false;
        }

        if (input.type === 'email' && value !== '' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            showError(input, 'Correo electrónico inválido.');
            return false;
        }

        if (key === 'mensaje' && value.length < 10) {
            showError(input, 'El mensaje debe tener al menos 10 caracteres.');
            return false;
        }

        return true;
    }

    // Validar todo antes de enviar
    form.addEventListener('submit', function (e) {
        let isValid = true;

        Object.values(inputs).forEach(input => {
            if (!validateField({ target: input })) {
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault();
            alert('Por favor corrige los errores en el formulario.');
        }
    });
});