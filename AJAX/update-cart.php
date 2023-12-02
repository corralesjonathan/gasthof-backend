<?php
require_once '../database.php';

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        $id_user = $decoded["id_user"];
        $id_dish = $decoded["id_dish"];
        $quantity = $decoded["quantity"];
        $subtotal = $decoded["subtotal"];

        $database->update("tb_cart", [
            "quantity" => $quantity,
            "subtotal" => $subtotal
        ], [
            "id_user" => $id_user,
            "id_dish" => $id_dish,
        ]);
       
        // Retrieve and return the updated cart
        $cart = $database->select("tb_cart", [
            "[>]tb_dishes" => ["id_dish" => "id_dish"],
            "[>]tb_users" => ["id_user" => "id_user"],
        ], [
            "tb_cart.id_cart",
            "tb_dishes.id_dish",
            "tb_users.id_user",
            "tb_cart.quantity",
            "tb_cart.subtotal",
        ], [
            "tb_cart.id_user" => $decoded["id_user"],
        ]);

        echo json_encode($cart);
    }
}
?>