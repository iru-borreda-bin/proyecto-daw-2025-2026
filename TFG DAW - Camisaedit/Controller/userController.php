<?php
require_once "controllerCommon.php";

// CRUD USUARIOS

// REGISTER
function valid_regForm($nombre, $email, $password, $telef)
{
    // Validar que los campos no estén vacíos
    console_log('Validando si todos los campos obligatorios han sido rellenados');
    if (empty($nombre) || empty($email) || empty($password)) {
        throw new Exception("'Alerta de Backend: Los campos obligatorios no pueden estar vacíos.'");
    }
    console_log('Todo correcto!');
    console_log('');

    // Validar el nombre (solo letras y espacios)
    console_log('Validando nombre');
    if (!preg_match("/^[A-Za-zÀ-ÿ ]{3,}$/", $nombre)) {
        throw new Exception("'Alerta de Backend: El nombre completo solo debe contener letras y espacios. Ha de tener un mínimo de 3 letras.'");
    }
    console_log('Nombre correcto!');
    console_log('');

    // Validar el email
    console_log('Validando email');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("'Alerta de Backend: Por favor, ingresa un email válido.'");
    }
    console_log('Email correcto!');
    console_log('');

    // Validar telefono (Todo números o vacío)
    console_log('Validando teléfono');
    if (!preg_match("/^\d{9,9}$|^$/", $telef) || !empty($telef)) {
        throw new Exception("'Alerta de Backend: Por favor inserte un teléfono válido (o déjelo vacío)'");
    }
    console_log('Teléfono correcto!');
    console_log('');

    // Validar contraseña (mínimo 8 caracteres, máximo 15, al menos una mayúscula, una minúscula, un número y un carácter especial)
    console_log('Validando contraseña');
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/", $password)) {
        throw new Exception("'Alerta de Backend: La contraseña debe tener entre 8 y 15 caracteres, incluyendo al menos una mayúscula, una minúscula, un número y un carácter especial.'");
    }
    console_log('Contraseña correcta!');
    console_log('');

}

//Función para validar que el email no esté ya registrado en la base de datos (para evitar registros duplicados)
function valid_freeEmail($conn, $email)
{
    $stmt = $conn->prepare("SELECT user_email FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->num_rows === 0;
}

function subir_regForm($conn, $nombre, $email, $password, $telef)
{
    // Primero llamamos a una función que nos devuelva la fecha actual en formato YYYY-MM-DD para guardarla en la base de datos 
    $fecha_registro = getCurrentDate();

    //Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO users (user_email, user_passwd, user_nomCom, user_tlf, user_dateCreado) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("sssss", $email, $password, $nombre, $telef, $fecha_registro); // 's' para string, 'i' para integer si hubiera alguno
    if ($stmt->execute()) {
        alert_popup('Registro exitoso. Ahora puedes iniciar sesión con tu cuenta.');
        console_log('NUEVO REGISTRO CREADO CON ÉXITO');
    } else {
        throw new Exception("'ERROR: Error al insertar los datos: " . $stmt->error . ".'");
    }
}

// LOGIN
function valid_loginForm($email, $password)
{
    // Validar que los campos no estén vacíos
    console_log('Validando si todos los campos obligatorios han sido rellenados');
    if (empty($email) || empty($password)) {
        throw new Exception("'Alerta de Backend: Los campos obligatorios no pueden estar vacíos.'");
    }
    console_log('Todo correcto!');
    console_log('');

    // Validar el email
    console_log('Validando email');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("'Alerta de Backend: Por favor, ingresa un email válido.'");
    }
    console_log('Email correcto!');
    console_log('');

    // Validar contraseña (mínimo 8 caracteres, máximo 15, al menos una mayúscula, una minúscula, un número y un carácter especial)
    console_log('Validando contraseña');
    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,15}$/", $password)) {
        throw new Exception("'Alerta de Backend: La contraseña debe tener entre 8 y 15 caracteres, incluyendo al menos una mayúscula, una minúscula, un número y un carácter especial.'");
    }
    console_log('Contraseña correcta!');
    console_log('');
}

function upload_userSessionStorage($conn, $email)
{
    // Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $userData = $result->fetch_assoc();
        $_SESSION['user_id'] = $userData['user_id'];
        $_SESSION['user_email'] = $userData['user_email'];
        $_SESSION['user_nomCom'] = $userData['user_nomCom'];
        $_SESSION['user_tlf'] = $userData['user_tlf'];
        $_SESSION['user_dateCreado'] = $userData['user_dateCreado'];
        
        console_log('Datos del usuario cargados en sesión:');
        console_log('ID: ' . $_SESSION['user_id']);
        console_log('Email: ' . $_SESSION['user_email']);
        console_log('Nombre: ' . $_SESSION['user_nomCom']);
        console_log('Teléfono: ' . $_SESSION['user_tlf']);
        console_log('Fecha de creación: ' . $_SESSION['user_dateCreado']);
    } else {
        throw new Exception("'Alerta de Backend: Las credenciales ingresadas son incorrectas. Por favor, inténtalo de nuevo.'");
    }
}

function consult_loginForm($conn, $email, $password)
{
    // Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT user_email FROM users WHERE user_email = ? AND user_passwd = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        upload_userSessionStorage($conn, $email);
        alert_popup('Inicio de sesión exitoso. ¡Bienvenido a Camisaedit!');
        console_log('USUARIO ENCONTRADO. INICIO DE SESIÓN EXITOSO.');
    } else {
        throw new Exception("'Alerta de Backend: Las credenciales ingresadas son incorrectas. Por favor, inténtalo de nuevo.'");
    }
}
?>