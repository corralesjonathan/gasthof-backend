<?php

require_once '../database.php';

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        $wishlist = $database->insert("tb_wishlist",[
            "id_dish" => $decoded["id_dish"],
            "id_user" => $decoded["id_user"] 
        ]);

        echo json_encode($wishlist);
    }
}
?>