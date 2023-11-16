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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home-Gasthof</title>
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
            <?php 
                include './parts/header.php'
            ?>
        </header>
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
                            echo "<section class='dish-card'>"
                            ."<div class='card-img-container'>"
                            ."<a class='dish-card-link' href='dish.php?id=".$dish["id_dish"]."'>"
                                    ."<img src='./imgs/dishes/".$dish["dish_category_name"]."/".$dish["dish_image"]."' alt=".$dish["dish_name"]." class='dish-card-img'>"
                                    ."</a>"
                                    ."<button class='like'><img class='like-icon' src='./imgs/icons/like.svg'></button>"
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
                <a href="menu.php" class="btn view-all">view all</a>
            </div>
            <!--featured dishes-->

            <!--beers slider-->
            <div id="slider-container">
                <div class="home-titles-container">
                    <h3 class="home-title1">we have the better</h3>
                    <h2 class="home-title2">german beer</h2>
                </div>
                <!--slides-->
                <section class="slide fade">
                    <div class="slide-data-column">
                        <!--left-column-->
                        <div class="slide-data-container">
                            <h2 class="slide-title dish-title">Köstritzer Schwarzbier</h2>
                            <p class="dish-type ">330ml</p>
                            <p class="dish-type slide-description">A Schwarzbier is a dark lager with roasted malt and
                                sometimes a slightly memorable smoky flavour.</p>
                            <p class="dish-price">$2.35</p>
                            <a class="btn order" href="">Order</a>
                        </div>
                    </div>
                    <!--left-column-->
                    <div class="slide-img-container">
                        <!--right column-->
                        <img src="./imgs/slides/köstritzer.webp" alt="" class="slide-img">
                    </div>
                </section>
                <section class="slide fade">
                    <div class="slide-data-column">
                        <!--left-column-->
                        <div class="slide-data-container">
                            <h2 class="slide-title dish-title">bitburger premium pils</h2>
                            <p class="dish-type ">330ml</p>
                            <p class="dish-type slide-description">The straw-coloured pilsner is crystal-clear and
                                perfectly hopped,
                                boasting a light taste and a lasting foam head with extra-fine bubbles.</p>
                            <p class="dish-price">$2.25</p>
                            <a class="btn order" href="">Order</a>
                        </div>
                    </div>
                    <!--left-column-->
                    <div class="slide-img-container">
                        <!--right column-->
                        <img src="./imgs/slides/bitburger.webp" alt="" class="slide-img">
                    </div>
                </section>
                <section class="slide fade">
                    <div class="slide-data-column">
                        <!--left-column-->
                        <div class="slide-data-container">
                            <h2 class="slide-title dish-title">schneider weisse</h2>
                            <p class="dish-type ">500ml</p>
                            <p class="dish-type slide-description">Schneider Weisse Love Beer is a wheat beer with a
                                lovely golden color topped with a
                                dense and bright white foam.</p>
                            <p class="dish-price">$3.95</p>
                            <a class="btn order" href="">Order</a>
                        </div>
                    </div>
                    <!--left-column-->
                    <div class="slide-img-container">
                        <!--right column-->
                        <img src="./imgs/slides/schneider.webp" alt="" class="slide-img">
                    </div>
                </section>
                <section class="slide fade">
                    <div class="slide-data-column">
                        <!--left-column-->
                        <div class="slide-data-container">
                            <h2 class="slide-title dish-title">Weihenstephaner</h2>
                            <p class="dish-type ">330ml</p>
                            <p class="dish-type slide-description">A full-bodied golden yellow wheat beer with aromas of
                                cloves.</p>
                            <p class="dish-price">$2.50</p>
                            <a class="btn order" href="">Order</a>
                        </div>
                    </div>
                    <!--left-column-->
                    <div class="slide-img-container">
                        <!--right column-->
                        <img src="./imgs/slides/weihenstephaner.webp" alt="" class="slide-img">
                    </div>
                </section>
                <!--slides-->
                <!--slider dots-->
                <div class="dots-container">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                    <span class="dot" onclick="currentSlide(4)"></span>
                </div>
                <!--slider dots-->
            </div>
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
        <?php include './parts/footer.php'?>
        <!--footer-->

        <!--script-->
        <script src="./js/Slider.js"></script>
        <script src="./js/HeroSlider.js"></script>
        <!--script-->
    </body>
</html>