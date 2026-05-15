<!doctype html>
<html lang="es">

<?php
// Es vital que siempre carguemos la sesión al principio de cada página que necesite acceder a los datos del usuario, para evitar errores.
session_start();
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Camisaedit - Iniciar Sesión</title>
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
                    <li><a id="link_iniSess_nav" href="login.html">Iniciar Sesión</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section id="sect_form">
            <h2>Inciar Sesión</h2>
            <form id="form_login" method="POST">
                <span style="color: red;">Los campos obligatorios están marcados con un *</span>
                <fieldset>
                    <label for="input_email">Correo:</label>
                    <div class="div_input">
                        <input type="email" id="input_email" name="email" required placeholder="ejemplo@email.com" />
                        <span aria-live="polite">Email erróneo</span>
                    </div>
                    <label for="input_passwd">Contraseña:</label>
                    <div class="div_input">
                        <input type="password" id="input_passwd" name="passwd" required placeholder="!1234ABcd" />
                        <span aria-live="polite">Contraseña errónea</span>
                    </div>
                </fieldset>
                <button class="btn" id="btn_add_entrada" type="submit" name="submit">Iniciar Sesión</button>
            </form>
            <p>¿No tienes una cuenta? <a id="link_iniSess" href="register.php">¡Regístrate!</a></p>
        </section>
    </main>
    <!-- FOOTER -->
    <footer>
        <p>&copy; 2026 Iru Borredá Bin. Todos los derechos reservados.</p>
    </footer>
</body>
</body>

<script>
    // VALIDACIONES (llaman al archivo js linkeado)//
    // Para el email (línea 38 del archivo script)
    document.getElementById("input_email").addEventListener("keyup", validEmail);

    // Para validar la contraseña (Línea 65 del archivo loginReg.js)
    document.getElementById("input_passwd").addEventListener("keyup", validPasswd);

</script>

<?php
require_once "../controller/bdcon/bdcon.php";
require_once "../controller/userController.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['passwd'];

    try {
        console_log('====Validación PHP====');
        console_log("Datos: " . $email . " y password");
        console_log('Validando que el email y contraseña sean correctos');
        valid_loginForm($email, $password);
        alert_popup('Validación exitosa. Viendo si su cuenta existe...');
        console_log("====Comprobando credenciales...====");
        consult_loginForm($conn, $email, $password);
        console_log(" ");
        console_log("====Redirigiendo a profile.php====");
        echo '<script type="text/javascript">window.location.href="profile.php";</script>';
        exit();
    } catch (Exception $e) {
        console_log('ERROR: ' . $e->getMessage());
    }
}
?>

</html>