<?php
require_once '../database.php';

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        if($decoded["category"] == "all"){
            $items = $database->rand("tb_dishes", [
                "[>]tb_dishes_categories" => ["id_dish_category" => "id_dish_category"]
            ], [
                "tb_dishes.id_dish",
                "tb_dishes.dish_name",
                "tb_dishes.dish_description",
                "tb_dishes.dish_image",
                "tb_dishes.dish_price",
                "tb_dishes.featured",
                "tb_dishes_categories.id_dish_category",
                "tb_dishes_categories.dish_category_name"
            ]);
        }else{
            $items = $database->rand("tb_dishes", [
                "[>]tb_dishes_categories" => ["id_dish_category" => "id_dish_category"]
            ], [
                "tb_dishes.id_dish",
                "tb_dishes.dish_name",
                "tb_dishes.dish_description",
                "tb_dishes.dish_image",
                "tb_dishes.dish_price",
                "tb_dishes.featured",
                "tb_dishes_categories.id_dish_category",
                "tb_dishes_categories.dish_category_name" 
            ], [
                "tb_dishes_categories.id_dish_category" => $decoded["category"]
            ]); 
        }
        
        echo json_encode($items);
    }
}
?>