<?php
require_once 'database.php';

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        $isInCart = $database->select("tb_cart", "*", [
            "AND" => [
                "id_user" => $decoded["id_user"],
                "id_dish" => $decoded["id_dish"],
            ],
        ]);

        //if to verify if dish is already in the cart
        if ($isInCart) {
            // Dish is already in the cart, update quantity and subtotal
            $currentSubtotal = $isInCart[0]['subtotal'];
            $currentQuantity = $isInCart[0]['quantity'];
            $newQuantity = $currentQuantity + $decoded["quantity"];

            $database->update("tb_cart", [
                "quantity" => $newQuantity,
                "subtotal" => $currentSubtotal + $decoded["subtotal"],//is $decoded["subtotal"] because in jv code subtotal=dish_price*quantity
            ], [
                "id_user" => $decoded["id_user"],
                "id_dish" => $decoded["id_dish"],
            ]);
        } else {
            // Dish is not in the cart, insert a new record
            $insertCart = $database->insert("tb_cart", [
                "id_user" => $decoded["id_user"],
                "id_dish" => $decoded["id_dish"],
                "quantity" => $decoded["quantity"],
                "subtotal" => $decoded["subtotal"],
            ]);
        }

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