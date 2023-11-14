<?php
// insert_wishlist.php

// Incluir archivo de conexión a la base de datos
require_once 'database.php';

// Verificar si se recibieron los datos necesarios
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dish_id']) && isset($_POST['user_id'])) {
    // Obtener datos de la solicitud POST
    $dishId = $_POST['dish_id'];
    $userId = $_POST['user_id'];

    // Realizar la inserción en la tabla wishlist
    $database->insert("tb_wishlist", [
        "dish_id" => $dishId,
        "user_id" => $userId,
        // ... otros campos de la tabla ...
    ]);

    // Enviar respuesta JSON exitosa
    echo json_encode(['success' => true]);
} else {
    // Enviar respuesta JSON de error si faltan datos
    echo json_encode(['success' => false, 'error' => 'Missing dish_id or user_id']);
}
?>
