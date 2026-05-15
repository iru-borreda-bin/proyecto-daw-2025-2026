<?php
require_once "controllerCommon.php";

// CRUD PEDIDO
function valid_pedForm($ped_id, $ped_estado, $ped_dateIni, $ped_dateStart, $ped_dateEnd)
{
    // Validar que los campos no estén vacíos
    console_log('Validando si todos los campos obligatorios han sido rellenados');
    if (empty($ped_id) || empty($ped_estado) || empty($ped_dateIni)) {
        throw new Exception("'Alerta de Backend: Los campos ID de pedido, Estado y Fecha de Inicio son obligatorios.'");
    }
    console_log('Todo correcto!');
    console_log('');

    // Validar el estado del pedido (solo letras y espacios)
    console_log('Validando estado del pedido');
    if (!preg_match("/^[A-Za-zÀ-ÿ ]{3,}$/", $ped_estado)) {
        throw new Exception("'Alerta de Backend: El estado del pedido solo debe contener letras y espacios. Ha de tener un mínimo de 3 letras.'");
    }
    console_log('Estado del pedido correcto!');
    console_log('');

    // Validar formato de fechas (YYYY-MM-DD HH:MM:SS)
    console_log('Validando formato de fechas');
    $date_pattern = "/^\d{4}-\d{2}-\d{2}$/";
    if ((!empty($ped_dateIni) && !preg_match($date_pattern, $ped_dateIni)) || (!empty($ped_dateStart) && !preg_match($date_pattern, $ped_dateStart)) || (!empty($ped_dateEnd) && !preg_match($date_pattern, $ped_dateEnd))) {
        throw new Exception("'Alerta de Backend: Las fechas deben tener el formato YYYY-MM-DD.'");
    }
    console_log('Formato de fechas correcto!');
    console_log('');
}

function subir_pedidoForm($conn, $ID_user, $ID_ropa)
{
    //Cojemos la fecha actual para guardarla como fecha de registro del pedido
    $fecha_registro = getCurrentDate();

    // Estado inicial del pedido, que luego se podrá actualizar a "Completado", "Enviado", etc. según el flujo de la aplicación.
    $estado = "Pendiente"; 

    //Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO pedidos (ped_user_id, ped_ropa_id, ped_estado, ped_dateIni) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("iiss", $ID_user, $ID_ropa, $estado, $fecha_registro); // 's' para string, 'i' para integer
    if ($stmt->execute()) {
        alert_popup('Registro exitoso. Pedido creado!');
        console_log('NUEVO REGISTRO CREADO CON ÉXITO');
    } else {
        throw new Exception("'ERROR: Error al insertar los datos: " . $stmt->error . ".'");
    }
}

function update_pedido($conn, $ped_id, $ped_estado, $ped_dateIni, $ped_dateStart, $ped_dateEnd) {
    //Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("UPDATE pedidos SET ped_estado = ?, ped_dateIni = ?, ped_dateStart = ?, ped_dateEnd = ? WHERE ped_id = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("ssssi", $ped_estado, $ped_dateIni, $ped_dateStart, $ped_dateEnd, $ped_id); // 's' para string, 'i' para integer
    if ($stmt->execute()) {
        alert_popup('Pedido actualizado correctamente!');
        console_log('PEDIDO ACTUALIZADO CON ÉXITO');
    } else {
        throw new Exception("'ERROR: Error al actualizar los datos: " . $stmt->error . ".'");
    }
}

function consult_getPedidosAdmin($conn) {
    //Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM pedidos");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $pedidos = [];
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
    return $pedidos;
}

function consult_getPedidosByUserID($conn, $userID) {
    //Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM pedidos WHERE ped_user_id = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("i", $userID); // 'i' para integer
    $stmt->execute();
    $result = $stmt->get_result();
    $pedidos = [];
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
    }
    return $pedidos;
}

function consult_getPedidoByID($conn, $ped_id) {
    // Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM pedidos WHERE ped_id = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("i", $ped_id); // 'i' para integer
    $stmt->execute();
    $result = $stmt->get_result();
    $pedido = $result->fetch_assoc();
    return $pedido;
}

?>