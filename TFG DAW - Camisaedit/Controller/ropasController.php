<?php
require_once "controllerCommon.php";

// CRUD ROPA
function valid_ropaForm($base_tamano, $base_color, $dis_patr, $dis_color, $txt_cont, $txt_tam, $txt_tipo, $txt_color, $txt_pos, $img_sel, $img_tam, $img_elev, $img_pos)
{
    // Validar que los campos no estén vacíos
    console_log('Validando si todos los campos obligatorios han sido rellenados');
    if (empty($base_tamano) || empty($base_color) || empty($dis_patr) || empty($dis_color) || empty($txt_cont) || empty($txt_tam) || empty($txt_tipo) || empty($txt_color) || empty($txt_pos) || empty($img_sel) || empty($img_tam) || empty($img_elev) || empty($img_pos)) {
        throw new Exception("'Alerta de Backend: Todos los campos habilitados son obligatorios.'");
    }
    console_log('Todo correcto!');
    console_log('');
}

function update_ropa($conn, $ropa_id, $base_tamano, $base_color, $dis_patr, $dis_color, $txt_cont, $txt_tam, $txt_tipo, $txt_color, $txt_pos, $img_sel, $img_tam, $img_elev, $img_pos) {
    //Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("UPDATE ropa SET ropa_tamano = ?, ropa_colBase = ?, ropa_dis = ?, ropa_colDis = ?, ropa_txtCont = ?, ropa_txtCol = ?, ropa_txtPos = ?, ropa_txtTam = ?, ropa_txtTip = ?, ropa_logo = ?, ropa_logoElev = ?, ropa_logoPos = ?, ropa_logoTam = ? WHERE ropa_id = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("sssssssssssssi", $base_tamano, $base_color, $dis_patr, $dis_color, $txt_cont, $txt_color, $txt_pos, $txt_tam, $txt_tipo, $img_sel, $img_elev, $img_pos, $img_tam, $ropa_id); // 's' para string, 'i' para integer si hubiera alguno
    if ($stmt->execute()) {
        alert_popup('Ropa actualizada correctamente!');
        console_log('ROPA ACTUALIZADA CON ÉXITO');
    } else {
        throw new Exception("'ERROR: Error al actualizar los datos: " . $stmt->error . ".'");
    }
}

function delete_ropa($conn, $ropa_id) {
    //Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("DELETE FROM ropa WHERE ropa_id = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("i", $ropa_id); // 'i' para integer
    if ($stmt->execute()) {
        alert_popup('Ropa y pedido eliminados correctamente!');
        console_log('ROPA Y PEDIDO ELIMINADOS CON ÉXITO');
    } else {
        throw new Exception("'ERROR: Error al eliminar los datos: " . $stmt->error . ".'");
    }
}

function subir_ropaForm($conn, $base_tamano, $base_color, $dis_patr, $dis_color, $txt_cont, $txt_tam, $txt_tipo, $txt_color, $txt_pos, $img_sel, $img_tam, $img_elev, $img_pos)
{
    //Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("INSERT INTO ropa (ropa_tamano, ropa_colBase, ropa_dis, ropa_colDis, ropa_txtCont, ropa_txtCol, ropa_txtPos, ropa_txtTam, ropa_txtTip, ropa_logo, ropa_logoElev, ropa_logoPos, ropa_logoTam) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("sssssssssssss", $base_tamano, $base_color, $dis_patr, $dis_color, $txt_cont, $txt_color, $txt_pos, $txt_tam, $txt_tipo, $img_sel, $img_elev, $img_pos, $img_tam); // 's' para string, 'i' para integer si hubiera alguno
    if ($stmt->execute()) {
        alert_popup('Registro exitoso. Ropa creada!');
        console_log('NUEVO REGISTRO CREADO CON ÉXITO');
    } else {
        throw new Exception("'ERROR: Error al insertar los datos: " . $stmt->error . ".'");
    }
}

function consult_getRopaByID($conn, $ropa_id) {
    // Preparando consulta para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT * FROM ropa WHERE ropa_id = ?");
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }
    $stmt->bind_param("i", $ropa_id); // 'i' para integer
    $stmt->execute();
    $result = $stmt->get_result();
    $ropa = $result->fetch_assoc();
    return $ropa;
}

?>