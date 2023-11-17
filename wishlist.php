<?php 
    require_once 'database.php';
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
            "tb_wishlist.id_user" => 1
        ]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - Gathof</title>
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <!--fonts-->
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <!--header & hero-->
    <header>
        <!--nav-->
        <?php 
            include './parts/navigation.php'
        ?>
        <!--nav-->
    <!--header & hero-->

    <main>
        <div class="dishes-main-container">
            <?php
            if(isset($_SESSION["isLoggedIn"])){ 
                echo "<div class='home-titles-container'>"
                    ."<h3 class='home-title1'>Hello,</h3>"
                    ."<h2 class='home-title2'>".$_SESSION["fullname"]."</h2>"
                ."</div>";
            }
            ?>
            <h2 class="slide-title dish-title wish-list-title">This is your wish list</h2>
            <div class="dishes-container">
            <?php
                        foreach ($dishes as $dish) {
                            echo "<section class='dish-card'>"
                            ."<div class='card-img-container'>"
                            ."<a class='dish-card-link' href='dish.php?id=".$dish["id_dish"]."'>"
                                    ."<img src='./imgs/dishes/".$dish["dish_category_name"]."/".$dish["dish_image"]."' alt=".$dish["dish_name"]." class='dish-card-img'>"
                                    ."</a>"
                                    ."</div>"
                                    ."<div class='dish-data-container'>"
                                        ."<div class='dish-texts-container'>"
                                        ."<a class='a-titles' href='dish.php?id=".$dish["id_dish"]."'>"
                                            ."<h2 class='dish-title'>".$dish["dish_name"]."</h2>"
                                            ."</a>"
                                            ."<p class='dish-type'>".$dish["dish_category_name"]."</p>"
                                        ."</div>"
                                        ."<a href='#'><img src='./imgs/icons/cart.svg' alt='Cart'></a>"
                                    ."</div>"
                                    ."<p class='dish-price'>$".$dish["dish_price"]."</p>"
                                    ."<a class='btn order' href='dish.php?id=".$dish["id_dish"]."'>Order</a>"
                            ."</section>";
                        }
                    ?>  
            </div>
        </div>
    </main>

    <footer>
        <?php 
            include './parts/footer.php'
        ?>
    </footer>
</body>

</html>