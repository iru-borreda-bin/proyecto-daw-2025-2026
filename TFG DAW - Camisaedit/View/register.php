<!doctype html>
<html lang="es">

<?php
session_start();
require_once "../controller/bdcon/bdcon.php";
require_once "../controller/userController.php";

if (isset($_POST['submit'])) {
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $telef = $_POST['telefono'];
    $password = $_POST['passwd'];

    try {
        console_log('====Validación PHP====');
        console_log("Datos: " . $nombre . " " . $email . " " . $password . " " . $telef);
        valid_regForm($nombre, $email, $password, $telef);
        console_log('Validando que el email no esté ya registrado en la base de datos');

        // Aquí va la función valid_freeEmail($email) que haría una consulta a
        // la base de datos para comprobar que el email no esté ya registrado. Si lo está, lanzaría una excepción.
        if (!valid_freeEmail($conn, $email)) {
            alert_popup('El email ingresado ya está registrado. Por favor, utiliza otro email.');
            throw new Exception("'Alerta de Backend: El email ingresado ya está registrado. Por favor, utiliza otro email.'");
        }

        alert_popup('Validación exitosa. Subiendo datos a la base de datos...');
        console_log("====Subiendo...====");
        subir_regForm($conn, $nombre, $email, $password, $telef);
        console_log(" ");
        console_log("====Redirigiendo a login.php====");
        echo '<script type="text/javascript">window.location.href="login.php";</script>';
        exit();
    } catch (Exception $e) {
        console_log('ERROR: ' . $e->getMessage());
    }
}
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Camisaedit - Registrarse</title>
    <!-- Enlace a archivo CSS en la carpeta styles -->
    <link rel="stylesheet" href="./styles/generalStyle.css" />
    <link rel="stylesheet" href="./styles/loginRegStyle.css" />
    <script src="../model/loginReg.js" type="text/javascript"></script>
</head>

<body>
    <header>
        <div class="container bar">
            <div id="logo">
                <img src="./img/Logo-camisaEdit.svg" alt="Logo Camisaedit" width="40" height="40" />
                <div>
                    <h1>Camisaedit</h1>
                    <p>Camisetas para todos</p>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.html">Inicio</a></li>
                    <li><a href="#">Acerca de</a></li>
                    <li><a href="#">Contacto</a></li>
                    <li><a id="link_iniSess_nav" href="login.php">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="sect_form">
            <h2>Registrarse</h2>
            <form id="form_register" method="POST">
                <span style="color: red;">Los campos obligatorios están marcados con un *</span>
                <fieldset>
                    <legend>Registro</legend>
                    <label for="input_name">Nombre Completo: <span style="color: red;">*</span></label>
                    <div class="div_input">
                        <input type="text" id="input_name" name="name" required placeholder="Nombre Completo" />
                        <span aria-live="polite">Se necesita un nombre válido (Solo letras, mínimo 3
                            carácteres)</span>
                    </div>

                    <label for="input_email">Correo: <span style="color: red;">*</span></label>
                    <div class="div_input">
                        <input type="text" id="input_email" name="email" required placeholder="ejemplo@email.com" />
                        <span aria-live="polite">Se necesita un email válido</span>
                    </div>
                    <label for="input_telefono">Teléfono: +34</label>
                    <div class="div_input">
                        <input type="text" id="input_telefono" name="telefono" placeholder="123456789" maxlength="9" />
                        <span aria-live="polite">Se necesita un número de teléfono válido (solo números sin
                            espacios, nueve dígitos)</span>
                    </div>

                    <label for="input_passwd">Contraseña: <span style="color: red;">*</span></label>
                    <div class="div_input">
                        <input type="password" id="input_passwd" name="passwd" required placeholder="!1234ABcd"
                            maxlength="15" />
                        <span aria-live="polite">Formato de contraseña errónea.
                            Aseegúrese que su contraseña tenga:
                            <ul>
                                <li>Al menos 8 caracteres</li>
                                <li>Máximo de 15 caracteres</li>
                                <li>Una letra mayúscula</li>
                                <li>Una letra minúscula</li>
                                <li>Un número</li>
                                <li>Un carácter especial</li>
                        </span>
                    </div>
                    <label for="input_confPasswd">Confirmar contraseña: <span style="color: red;">*</span></label>
                    <div class="div_input">
                        <input type="password" id="input_confPasswd" name="confPasswd" required placeholder="!1234ABcd"
                            maxlength="15" />
                        <span aria-live="polite">Las contraseñas no coinciden</span>
                    </div>
                    <label for="input_chk_terminos">Acepto los términos y condiciones: <span style="color: red;">*</span></label>
                    <div class="div_input">
                        <input type="checkbox" id="input_chk_terminos" name="terminos" required oninvalid="
                                    this.setCustomValidity(
                                        'Accepte los términos y condiciones por favor',
                                    )
                                " oninput="this.setCustomValidity('')" onclick="
                                    sendToValidationChkEnabler('btn_add_entrada', this.checked)
                                " />
                        <span aria-live="polite">Para proseguir, acepte los términos y condiciones</span>
                    </div>
                </fieldset>
                <button class="btn" id="btn_add_entrada" type="submit" name="submit" disabled>Enviar</button>
            </form>
            <p>¿Tienes una cuenta? <a id="link_iniSess" href="login.php">¡Inicia tu sesión!</a></p>
        </section>
    </main>
</body>
<!-- FOOTER -->
<footer>
    <p>&copy; 2026 Iru Borredá Bin. Todos los derechos reservados.</p>
</footer>

<script>
    // VALIDACIONES (llaman al archivo js linkeado)//

    // Para el nombre completo (Línea 3 del archivo loginReg.js)
    document.getElementById("input_name").addEventListener("keyup", validName);

    // Para el email (línea 17 del archivo loginReg.js)
    document.getElementById("input_email").addEventListener("keyup", validEmail);

    // Para el número de teléfono
    // Validación (Línea 38 del archivo loginReg.js)
    document.getElementById("input_telefono").addEventListener("keyup", validTlf);
    // Prevención de que se pongan otros carácteres que no sean números (Línea 74 del archivo loginReg.js)
    // Aquí utilizamos keydown en vez de up para "interceptar" el ingreso del carácter antes que aparezca el input.
    document.getElementById("input_telefono").addEventListener("keydown", noLetras);

    // Para validar la contraseña (Línea 65 del archivo loginReg.js)
    document.getElementById("input_passwd").addEventListener("keyup", validPasswd);
    // Y para confirmar que las contraseñas coinciden
    document.getElementById("input_confPasswd").addEventListener("keyup", validConfPasswd);

    // Para que se acepten los términos y condiciones (Línea 95 del archivo loginReg.js)
    // A pesar que el checkbox de términos y condiciones ya está marcado como "required" podemos añadir
    // una manera adicional de asegurarnos que el usuario las acepte: Deshabilitando el botón "enviar"
    // hasta que el checkbox esté checkeado.
    function sendToValidationChkEnabler(id_button, habilitado) {
        //Llamado desde un atributo onclick desde el checkbox (línea 110 de este archivo)
        terminosChecker(id_button, habilitado);
    }

    // Cuando el formulario es dado para enviar, esta función intercepta el proceso para mostrar la notificación y luego enviarlo
    // const formulario = document.getElementById("form_register");
    // formulario.addEventListener("submit", (e) => {
    //     e.preventDefault();
    //     alert("Formulario enviado correctamente.");
    //     formulario.submit();
    // });
</script>

</html>