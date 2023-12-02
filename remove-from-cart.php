<?php

require_once 'database.php';

if (isset($_SERVER["CONTENT_TYPE"])) {
    $contentType = $_SERVER["CONTENT_TYPE"];

    if ($contentType == "application/json") {
        $content = trim(file_get_contents("php://input"));
        $decoded = json_decode($content, true);

        $id_cart = $decoded["id_cart"];

        $database->delete("tb_cart",[
            "id_cart" => $id_cart
        ]);
        

        echo json_encode($id_cart);
    }
}
?>