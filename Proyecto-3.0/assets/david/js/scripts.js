document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const lengthRule = document.getElementById('length');
    const uppercaseRule = document.getElementById('uppercase');
    const specialRule = document.getElementById('special');
    const matchConfirmRule = document.getElementById('match-confirm');
    const lengthConfirmRule = document.getElementById('length-confirm');
    const uppercaseConfirmRule = document.getElementById('uppercase-confirm');
    const specialConfirmRule = document.getElementById('special-confirm');

    // Función para validar las reglas de la contraseña
    function validatePassword() {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        // Validar longitud
        lengthRule.className = password.length >= 8 ? 'valid' : 'invalid';
        lengthConfirmRule.className = confirmPassword.length >= 8 ? 'valid' : 'invalid';

        // Validar mayúscula
        uppercaseRule.className = /[A-Z]/.test(password) ? 'valid' : 'invalid';
        uppercaseConfirmRule.className = /[A-Z]/.test(confirmPassword) ? 'valid' : 'invalid';

        // Validar carácter especial
        specialRule.className = /[!@#$%^&*(),.?":{}|<>]/.test(password) ? 'valid' : 'invalid';
        specialConfirmRule.className = /[!@#$%^&*(),.?":{}|<>]/.test(confirmPassword) ? 'valid' : 'invalid';

        // Validar confirmación de la contraseña
        matchConfirmRule.className = (password === confirmPassword && password !== '') ? 'valid' : 'invalid';
    }

    // Mostrar las reglas cuando se enfoca el campo de contraseña
    passwordInput.addEventListener('focus', function () {
        document.getElementById('password-rules').style.display = 'block';
    });

    confirmPasswordInput.addEventListener('focus', function () {
        document.getElementById('confirm-password-rules').style.display = 'block';
    });

    // Ocultar las reglas cuando se pierde el foco
    passwordInput.addEventListener('blur', function () {
        document.getElementById('password-rules').style.display = 'none';
    });

    confirmPasswordInput.addEventListener('blur', function () {
        document.getElementById('confirm-password-rules').style.display = 'none';
    });

    // Actualizar validación mientras se escribe
    passwordInput.addEventListener('input', validatePassword);
    confirmPasswordInput.addEventListener('input', validatePassword);
});




