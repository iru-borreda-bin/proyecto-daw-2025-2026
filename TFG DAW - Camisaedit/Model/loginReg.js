// VALIDACIONES //
// Nombre Completo
function validName(e) {
    // Establecemos el regex por el cual se validará el valor de input_nombre, comparándolos usando la función "test"
    // (Cualquier letra, incluyendo vocales con acentos y espacios, un mínimo de 3 carácteres)
    const regex_nombre = /^[A-zÀ-ú ]{3,}$/;
    const input_nombre = document.getElementById("input_name");

    if (regex_nombre.test(input_nombre.value)) {
        input_nombre.setCustomValidity("");
    } else {
        input_nombre.setCustomValidity("Ponga un nombre válido.");
    }
}

// Email
function validEmail(e) {
    // Siguiendo como lo hacíamos con el Nombre, comparamos el email con su regex apropiado
    // (Cualquier palabra (\w) o número (\d) una vez o más, el arroba, cualquier palabra o número una vez o más, un punto, y luego un mínimo de dos letras al final.)
    // (Los carácteres "." y "-" debían ser "escaped" debido a que la validación de HTML los tiene reservados, junto con cualquier paréntesis, corchete, etc.)
    const regex_email = /^[\w\d\._%+\-]+@[\w\d\.\-]+\.[a-zA-Z]{2,}$/;
    const input_email = document.getElementById("input_email");

    if (regex_email.test(input_email.value)) {
        input_email.setCustomValidity("");
    } else {
        input_email.setCustomValidity("Ponga un email válido.");
    }
}

// Teléfono
// Este área tendrá dos funciones:
// 1) Validar que el número de teléfono sea un número válido.
// 2) Impedir que el usuario pueda introducir letras en el campo.
// (Utilizando el HTML, ya hemos impedido que el usuario pueda poner más de 9 dígitos en el área de texto)

// Para validar que el número está en le formato correcto
function validTlf(e) {
    const regex_tlf = /^\d{9,9}$/;
    const input_tlf = document.getElementById("input_telefono");

    if (regex_tlf.test(input_tlf.value) || input_tlf.value === "") {
        // Para que sea válido tanto si se ha rellenado el campo o no
        input_tlf.setCustomValidity("");
    } else {
        input_tlf.setCustomValidity("Ponga un número de teléfono válido.");
    }
}

// Para impedir que se pongan letras
function noLetras(e) {
    const regex_tlf_prevent = /\d+$/;
    // Para excluír "Delete", "Backspace", "Left arrow", "Rigth arrow" para que se puedan borrar carácteres, llamamos a otra función para que nos compruebe el keyevent introducido
    const isBcksp = backspChecker(e);

    if (!regex_tlf_prevent.test(e.key) && isBcksp) {
        //Aquí nos aseguramos que el keyevent introducido NO es un número, ni uno de los carácteres que nos interesa mantener

        e.preventDefault();
    }
}

// Contraseña. Se probará que la contraseña tenga un mínimo de 8 carácteres, al menos una letra mayúscula, una letra minúscula, 
// un número y un carácter especial.
function validPasswd(e) {
    const regex_passwd = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    const input_passwd = document.getElementById("input_passwd");

    if (regex_passwd.test(input_passwd.value)) {
        input_passwd.setCustomValidity("");
    } else {
        input_passwd.setCustomValidity("La contraseña debe tener al menos 8 caracteres, incluyendo una letra mayúscula, una letra minúscula, un número y un carácter especial.");
    }
}

// Para comprobar que la contraseña introducida en el campo de confirmación es igual a la del campo de contraseña
function validConfPasswd(e) {
    const input_passwd = document.getElementById("input_passwd");
    const input_confirm_passwd = document.getElementById("input_confPasswd");

    if (input_passwd.value === input_confirm_passwd.value) {
        input_confirm_passwd.setCustomValidity("");
    } else {
        input_confirm_passwd.setCustomValidity("Las contraseñas no coinciden.");
    }
}

function backspChecker(e) {
    var key = e.keyCode; //Instanciamos una variable que solo recoga el carácter introducido

    if (key == 8 || key == 46 || key == 37 || key == 39) {
        //"Delete", "Backspace", "Left arrow", "Rigth arrow" respectivamente
        return false;
    } else {
        return true;
    }
}

// Términos
function terminosChecker(id_button, habilitado) {
    document.getElementById(id_button).disabled = !habilitado; // De esta manera, cuando el checkbox esté "unchecked", disabled seguirá siendo "true", y viceversa.
}