<?php
// get_pedido_details.php
session_start();
require_once "bdcon/bdcon.php";
require_once "pedidoController.php";

if (isset($_GET['ped_id'])) {
    $ped_id = intval($_GET['ped_id']);
    $pedido = consult_getPedidoByID($conn, $ped_id);
    if ($pedido) {
        echo json_encode($pedido);
    } else {
        echo json_encode(['error' => 'Pedido no encontrado']);
    }
} else {
    echo json_encode(['error' => 'ID de pedido requerido']);
}
?>