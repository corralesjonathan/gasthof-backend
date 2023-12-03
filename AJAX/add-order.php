<?php
require_once '../database.php';

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        // Obtener los elementos del carrito
        $cartItems = $database->select("tb_cart", "*", [
            "id_user" => $decoded["id_user"]
        ]);

        $total = 0;

        // Calcular el total del carrito
        foreach ($cartItems as $item) {
            $total += $item["subtotal"];
        }

        // Insertar la orden en la tabla tb_orders
        $database->insert("tb_orders", [
            "id_user" => $decoded["id_user"],
            "id_order_type" => $decoded["id_order_type"],
            "id_address" => $decoded["id_address"],
            "order_date" => $decoded["date"],
            "order_time" => $decoded["time"],
            "total" => $total,
        ]);

        // Verificar si la inserción fue exitosa
        $orderId = $database->id(); // Obtener el ID de la última inserción

        if ($orderId) {
            // Eliminar elementos del carrito
            $database->delete("tb_cart", [
                "id_user" => $decoded["id_user"]
            ]);

            // Obtener información sobre la orden recién insertada
            $orders = $database->select("tb_orders", "*", [
                "id_order" => $orderId
            ]);

            echo json_encode($orders);
        } else {
            // La inserción de la orden no fue exitosa
            echo json_encode(["error" => "Error al agregar la orden"]);
        }
    }
}
?>