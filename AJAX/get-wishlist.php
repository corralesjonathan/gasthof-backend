<?php
require_once '../database.php';

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        $userId = $decoded["id_user"];
        $dishId = $decoded["id_dish"];
    
        $wishlist = $database->select("tb_wishlist", [
            "[>]tb_dishes" => ["id_dish" => "id_dish"],
            "[>]tb_users" => ["id_user" => "id_user"],
            "[>]tb_dishes_categories" => ["tb_dishes.id_dish_category" => "id_dish_category"],
        ], [
            "tb_wishlist.id_wishlist",
            "tb_dishes.id_dish",
            "tb_dishes.dish_name",
            "tb_dishes.dish_image",
            "tb_dishes.dish_price",
            "tb_users.id_user",
            "tb_dishes_categories.dish_category_name"
        ], [
            "tb_wishlist.id_user" => $userId,
            "tb_wishlist.id_dish" => $dishId,
        ]);

        if (!empty($wishlist)) {
            $id_wishlist = $wishlist[0]['id_wishlist'];
            $database->delete("tb_wishlist", [
                "id_wishlist" => $id_wishlist
            ]);

            // Obtener la lista de deseos actualizada después de eliminar
            $updatedWishlist = $database->select("tb_wishlist", [
                "[>]tb_dishes" => ["id_dish" => "id_dish"],
                "[>]tb_users" => ["id_user" => "id_user"],
                "[>]tb_dishes_categories" => ["tb_dishes.id_dish_category" => "id_dish_category"],
            ], [
                "tb_wishlist.id_wishlist",
                "tb_dishes.id_dish",
                "tb_dishes.dish_name",
                "tb_dishes.dish_image",
                "tb_dishes.dish_price",
                "tb_users.id_user",
                "tb_dishes_categories.dish_category_name"
            ], [
                "tb_wishlist.id_user" => $userId,
                "tb_wishlist.id_dish" => $dishId,
            ]);

            echo json_encode($updatedWishlist);
        } else {
            $wishlist = $database->insert("tb_wishlist", [
                "id_dish" => $dishId,
                "id_user" => $userId 
            ]);

            // Obtener la lista de deseos actualizada después de insertar
            $updatedWishlist = $database->select("tb_wishlist", [
                "[>]tb_dishes" => ["id_dish" => "id_dish"],
                "[>]tb_users" => ["id_user" => "id_user"],
                "[>]tb_dishes_categories" => ["tb_dishes.id_dish_category" => "id_dish_category"],
            ], [
                "tb_wishlist.id_wishlist",
                "tb_dishes.id_dish",
                "tb_dishes.dish_name",
                "tb_dishes.dish_image",
                "tb_dishes.dish_price",
                "tb_users.id_user",
                "tb_dishes_categories.dish_category_name"
            ], [
                "tb_wishlist.id_user" => $userId,
                "tb_wishlist.id_dish" => $dishId,
            ]);

            echo json_encode($updatedWishlist);
        }
    }
}
?>
