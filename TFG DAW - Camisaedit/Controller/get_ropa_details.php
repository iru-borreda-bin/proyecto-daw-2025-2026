<?php
// get_ropa_details.php
session_start();
require_once "bdcon/bdcon.php";
require_once "ropasController.php";

if (isset($_GET['ropa_id'])) {
    $ropa_id = intval($_GET['ropa_id']);
    $ropa = consult_getRopaByID($conn, $ropa_id);
    if ($ropa) {
        echo json_encode($ropa);
    } else {
        echo json_encode(['error' => 'Ropa no encontrada']);
    }
} else {
    echo json_encode(['error' => 'ID de ropa requerido']);
}
?>