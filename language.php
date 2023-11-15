<?php
require_once 'database.php';

$dish = [];

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        if ($decoded["language"] == "en") {
            $item = $database->select("tb_dishes", [
                "tb_dishes.dish_name",
                "tb_dishes.dish_description"
            ],[
                "id_dish" => $decoded["id_dish"]
            ]);
            $dish["name"] = $item[0]["dish_name"];
            $dish["description"] = $item[0]["dish_description"];
        } else {
            $item = $database->select("tb_dishes", [
                "tb_dishes.dish_name_de",
                "tb_dishes.dish_description_de"
            ],
                [
                "id_dish" => $decoded["id_dish"]
            ]);
            $dish["name"] = $item[0]["dish_name_de"];
            $dish["description"] = $item[0]["dish_description_de"];
        }

        echo json_encode($dish);
    }
}
?>