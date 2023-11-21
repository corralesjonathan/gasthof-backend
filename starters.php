<?php
    require_once 'database.php';
    // Reference: https://medoo.in/api/select
    $categories = $database->select("tb_dishes_categories",[
        "tb_dishes_categories.id_dish_category",
        "tb_dishes_categories.dish_category_name",
    ]);

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
        
       "tb_dishes_categories.id_dish_category" => 1
    ]);  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Starters-Gathof</title>
    <!--favicon-->
    <link rel="icon" href="./imgs/icons/favicon.svg" type="image/x-icon">
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
    <header class="hero-background menu-header-background">
        <!--nav-->
        <?php include './parts/navigation.php'?>
        <!--nav-->
        <div class="hero-container">
            <div class="menu-header-texts-container">
                <h3 class="home-title1 menu-header-title">Starters</h3>
            </div>
        </div>
    </header>
    <!--header & hero-->

    <!--main content-->
    <main>
        <!--dishes main container-->
        <div class="dishes-main-container">
            <!--dishes cards grid-->
            <div class="menu-container">
                <div class="dishes-container">
                    <?php
                    foreach ($dishes as $dish) {
                        echo "<section class='dish-card'>"
                        ."<div class='card-img-container'>"
                        ."<a class='dish-card-link' href='dish.php?id=".$dish["id_dish"]."'>"
                                ."<img src='./imgs/dishes/".$dish["dish_category_name"]."/".$dish["dish_image"]."' alt=".$dish["dish_name"]." class='dish-card-img'>"
                                ."</a>"
                                ."<button id='like'><img class='like-icon' src='./imgs/icons/like.svg'></button>"
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
                <!--dishes cards grid-->
            </div>
            <!--dishes cards grid-->
        </div>
        <!--dishes main container-->

        <!--subscribe form-->
        <?php include './parts/subscribe-form.php'?>
        <!--subscribe form-->
    </main>
    <!--main content-->

    <!--footer-->
    <?php include './parts/footer.php' ?>
    <!--footer-->
</body>

</html>