<?php
require_once 'database.php';

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        $isInCart=$database->select("tb_cart", "*", [
            "AND" => [
                "id_user" => $decoded["id_user"],
                "id_dish" => $decoded["id_dish"],
            ],
        ]);

        if($isInCart){
            $updateCart = $database->update("tb_cart",[
                "quantity" => 4,
                "subtotal" => $decoded["subtotal"]*4
            ]);
        }else{
            $insertCart = $database->insert("tb_cart",[
                "id_user" => $decoded["id_user"],
                "id_dish" => $decoded["id_dish"],
                "quantity" => $decoded["quantity"],
                "subtotal" => $decoded["subtotal"],
            ]);
        }

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