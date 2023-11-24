<?php 
    require_once 'database.php';
    // Reference: https://medoo.in/api/select
    // tb_dishes and tb_categories JOIN
    $dishes = $database->select("tb_dishes", [
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
        //where to show featured dishes only
        "tb_dishes.featured" => 1 
    ]);
    
    function getWishlist($database, $id_dish) {
        $userId = $_SESSION["user_id"];
    
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
            "tb_wishlist.id_dish" => $id_dish,
        ]);
    
        return $wishlist;
    }

    function createDishCard($database, $dish){
                echo "<section class='dish-card'>"
                    . "<div class='card-img-container'>"
                    . "<a class='dish-card-link' href='dish.php?id=".$dish["id_dish"]."'>"
                    . "<img src='./imgs/dishes/".$dish["dish_category_name"]."/".$dish["dish_image"]."' alt=".$dish["dish_name"]." class='dish-card-img'>"
                    . "</a>";

                if (isset($_SESSION["isLoggedIn"])) {
                    $wishlist = getWishlist($database, $dish["id_dish"]);
                    $likeAction = !empty($wishlist) ? "removeFromWishlist(".$wishlist[0]["id_wishlist"].")" : "addToWishlist(".$dish["id_dish"].", ".$_SESSION["user_id"].")";
                    echo "<a id='like' onclick='".$likeAction."'><img class='like-icon' src='./imgs/icons/like".(!empty($wishlist) ? '-fill' : '').".svg'></a>";
                } else {
                    echo "<a href='login.php' id='like'><img id='like-icon' src='./imgs/icons/like.svg'></a>";
                }

                echo "</div>"
                    . "<div class='dish-data-container'>"
                    . "<div class='dish-texts-container'>"
                    . "<a class='a-titles' href='dish.php?id=".$dish["id_dish"]."'>"
                    . "<h2 class='dish-title'>".$dish["dish_name"]."</h2>"
                    . "</a>"
                    . "<p class='dish-type'>".$dish["dish_category_name"]."</p>"
                    . "</div>";

                if (isset($_SESSION["isLoggedIn"])) {
                    echo "<a onclick='addToCart(".$_SESSION["user_id"].", ".$dish["id_dish"].", 1, ".$dish["dish_price"].")'><img class='cart-img' src='./imgs/icons/cart.svg' alt='Cart'></a>";
                } else {
                    echo "<a href='login.php'><img src='./imgs/icons/cart.svg' alt='Cart'></a>";
                }

                echo "</div>"
                    . "<p class='dish-price'>$".$dish["dish_price"]."</p>"
                    . "<a class='btn order' href='dish.php?id=".$dish["id_dish"]."'>Order</a>"
                    . "</section>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Gasthof</title>
    <!--favicon-->
    <?php include './parts/favicon.php'?>
    <!--fonts-->
    <?php include './parts/fonts.php'?>
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <!--header & hero-->
    <header> <?php include './parts/header.php'?> </header>
    <!--header & hero-->

    <!--main content-->
    <main>
        <!--featured dishes-->
        <div class="dishes-main-container">
            <div class="home-titles-container">
                <h3 class="home-title1">discover our</h3>
                <h2 class="home-title2">featured dishes</h2>
            </div>
            <div class="dishes-container">
                <?php
                foreach ($dishes as $dish) {
                createDishCard($database, $dish); 
                }
                ?>
            </div>
            <a href="menu.php" class="btn view-all">view all</a>
        </div>
        <!--featured dishes-->

        <!--beers slider-->
        <?php include './parts/beer-slider.php'?>
        <!--beers slider-->

        <!--about restaurant section-->
        <?php include './parts/about-us.php'?>
        <!--about restaurant section-->

        <!--subscribe form-->
        <?php include './parts/subscribe-form.php'?>
        <!--subscribe form-->
    </main>
    <!--main content-->

    <!--footer-->
    <footer> <?php include './parts/footer.php'?> </footer>
    <!--footer-->

    <!--script-->
    <script src="./js/add-to-wishlist.js"></script>
    <script src="./js/remove-from-wishlist.js"></script>
    <script src="./js/add-to-cart.js"></script>
    <!--script-->
</body>
</html>