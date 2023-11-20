<?php

require_once 'database.php';

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        $id_wishlist = $decoded["id_wishlist"];

        $database->delete("tb_wishlist",[
            "id_wishlist" => $id_wishlist
        ]);
        

        echo json_encode($id_wishlist);
    }
}
?>