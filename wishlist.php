<?php

function getWishlist($database) {

    $dishes = $database->select("tb_wishlist", [
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
        "tb_wishlist.id_user" => $_SESSION["user_id"]
    ]);

    return $dishes;
}

function isWishlistEmpty($database) {
    $wishlistCount = $database->count("tb_wishlist", [
        "id_user" => $_SESSION["user_id"]
    ]);

    return $wishlistCount == 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - Gathof</title>
    <!--favicon-->
    <?php include './parts/favicon.php'?>
    <!--fonts-->
    <?php include './parts/fonts.php'?>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <!--header & hero-->
    <header>
        <!--nav-->
        <?php include './parts/navigation.php'?>
        <!--nav-->
    </header>
    <!--header & hero-->

    <!--main content-->
    <main>
        <div class="dishes-main-container">
            <?php
            $dishes = getWishlist($database);
            if(isset($_SESSION["isLoggedIn"])){ 
                echo "<div class='home-titles-container'>"
                    ."<h3 class='home-title1'>Hello,</h3>"
                    ."<h2 class='home-title2'>".$_SESSION["fullname"]."</h2>"
                ."</div>";
            }
            ?>
            <?php echo "<h2 class='slide-title dish-title wish-list-title'>My Wishlist (".count($dishes)." items)</h2>"; ?>
            <table>
                <thead>
                    <tr>
                        <th class="dish-title"></th>
                        <th class="dish-title">Image</th>
                        <th class="dish-title">Name</th>
                        <th class="dish-title">Unit price</th>
                        <th class="dish-title"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                foreach($dishes as $dish){
                    echo "<tr id='tr-{$dish["id_wishlist"]}'>"
                        ."<td class='td-actions'><a onclick='removeFromWishlist(".$dish["id_wishlist"].")' href='#'><img class='trash-icon' src='./imgs/icons/delete.svg' alt=''></a></td>"
                        ."<td class='dish-type'><a href='dish.php?id=".$dish["id_dish"]."'><img class='wishlist-img' src='./imgs/dishes/".$dish["dish_category_name"]."/".$dish["dish_image"]."' alt=''></a></td>"
                        ."<td class='dish-type'><a class='dish-type' href='dish.php?id=".$dish["id_dish"]."'>".$dish["dish_name"]."</a><br><a class='dish-type'>".$dish["dish_category_name"]."</a></td>"
                        ."<td class='dish-type'>$".$dish["dish_price"]."</td>"
                        ."<td class='td-actions'><a onclick='addToCart(".$_SESSION["user_id"].", ".$dish["id_dish"].", 1, ".$dish["dish_price"].")'><img class='cart-img' src='./imgs/icons/cart.svg' alt=''></a></td>"
                    ."</tr>";
                }
            ?>
                </tbody>
            </table>
            <?php 
                if (isWishlistEmpty($database)){
                echo "<p class='dish-type slide-description'>Your wishlist is empty.</p>";
                }
                ?>
        </div>

        <!--Added to cart popup-->
        <div id="cart-popup"></div>
        <!--Added to cart popup-->
    </main>
    <!--main content-->

    <!--footer-->
    <footer> <?php include './parts/footer.php'?> </footer>
    <!--footer-->

    <!--script-->
    <script src="./js/remove-from-wishlist.js"></script>
    <script src="./js/add-to-cart.js"></script>
    <script>
    function updateInterface(id_wishlist) {
        let tr = document.querySelector(`#tr-${id_wishlist}`);
        tr.remove();
        location.reload()
    }
    </script>
    <!--script-->
</body>

</html>