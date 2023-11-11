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
    <?php 
        include './parts/header.php'
    ?>
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
                        ."<a href='dish.php?id=".$dish["id_dish"]."'>"
                                ."<img src='./imgs/dishes/".$dish["dish_category_name"]."/".$dish["dish_image"]."' alt=".$dish["dish_name"]." class='dish-card-img'>"
                                ."</a>"
                                ."<div class='dish-data-container'>"
                                    ."<div>"
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
                <!--<section class="dish-card">
                    <img src="./imgs/cards/main-courses/schnitzel.webp" alt="Schnitzel" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Schnitzel</h2>
                            <p class="dish-type">Main course</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$5.90</p>
                    <a class="btn order" href="">Order</a>
                </section>
                <section class="dish-card">
                    <img src="./imgs/cards/main-courses/spätzle.webp" alt="Spätzle" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Spätzle</h2>
                            <p class="dish-type">Main course</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$6.85</p>
                    <a class="btn order" href="">Order</a>
                </section>
                <section class="dish-card">
                    <img src="./imgs/cards/desserts/käsekuchen.webp" alt="Käsekuchen" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Käsekuchen</h2>
                            <p class="dish-type">Dessert</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$7.25</p>
                    <a class="btn order" href="">Order</a>
                </section>
                <section class="dish-card">
                    <img src="./imgs/cards/starters/kartoffelpuffer.webp" alt="Kartoffelpuffer" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Kartoffelpuffer </h2>
                            <p class="dish-type">Starter</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$6.25</p>
                    <a class="btn order" href="dish.html">Order</a>
                </section>
                <section class="dish-card">
                    <img src="./imgs/cards/drinks/apfelsaft-minze.webp" alt="Apfelsaft-Minze" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Apfelsaft-Minze</h2>
                            <p class="dish-type">Drink</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$1.15</p>
                    <a class="btn order" href="dish.html">Order</a>
                </section>
                <section class="dish-card">
                    <img src="./imgs/cards/desserts/black-forest-cake.webp" alt="Black Forest Cake"
                        class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Black Forest Cake" </h2>
                            <p class="dish-type">Dessert</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$4.30</p>
                    <a class="btn order" href="dish.html">Order</a>
                </section>
                <section class="dish-card">
                    <img src="./imgs/cards/desserts/apfelstrudel.webp" alt="Apfelstrudel" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Apfelstrudel" </h2>
                            <p class="dish-type">Dessert</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$3.50</p>
                    <a class="btn order" href="dish.html">Order</a>
                </section>
                <section class="dish-card">
                    <img src="./imgs/cards/starters/kohlrouladen.webp" alt="Kohlrouladen" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Kohlrouladen</h2>
                            <p class="dish-type">Starter</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$4.50</p>
                    <a class="btn order" href="dish.html">Order</a>
                </section>
                <section class="dish-card">
                    <img src="./imgs/cards/drinks/eiskaffee.webp" alt="Eiskaffee" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Eiskaffee</h2>
                            <p class="dish-type">Drink</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$2.50</p>
                    <a class="btn order" href="dish.html">Order</a>
                </section>
                <section class="dish-card">
                    <img src="./imgs/cards/drinks/kefir.webp" alt="Kefir" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Kefir</h2>
                            <p class="dish-type">Drink</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$1.50</p>
                    <a class="btn order" href="dish.html">Order</a>
                </section>-->
            </div>
            <a href="menu.html" class="btn view-all">view all</a>
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
                    <img src="./imgs/köstritzer.webp" alt="" class="slide-img">
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
                    <img src="./imgs/bitburger.webp" alt="" class="slide-img">
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
                    <img src="./imgs/schneider.webp" alt="" class="slide-img">
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
                    <img src="./imgs/weihenstephaner.webp" alt="" class="slide-img">
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
        <div class="restaurant-data-container">
            <div class="home-titles-container">
                <h3 class="home-title1">about us</h3>
                <h2 class="home-title2">meet gasthof</h2>
            </div>
            <section class="restaurant-data-grid">
                <div class="restaurant-img-container">
                    <img class="restaurant-img" src="./imgs/restaurant-farcade.webp" alt="">
                </div>
                <div class="restaurant-data-column">
                    <div class="restaurant-data">
                        <h2 class="dish-title slide-title">our mission</h2>
                        <p class="dish-type restaurant-data-text">Lorem ipsum dolor sit amet consectetur. <br>
                            Tempus interdum in facilisi sapien feugiat <br>
                            parturient sed phasellus.</p>
                        <h2 class="dish-title slide-title">our vision</h2>
                        <p class="dish-type restaurant-data-text">Lorem ipsum dolor sit amet consectetur. <br> Proin
                            senectus mauris ipsum suspendisse.</p>
                        <a href="#" class="btn view-all">read more</a>
                    </div>
                </div>
            </section>
            <!--services cards-->
            <div class="services-grid">
                <div class="service-card">
                    <img class="service-img" src="./imgs/icons/motorcycle.svg" alt="Motorcycle">
                    <h2 class="dish-title service-title">Fast deliveries</h2>
                    <p class="dish-type restaurant-data-text">Your freshly prepped 15-min dinner <br>
                        kits arrive on your doorstep.</p>
                </div>
                <div class="service-card">
                    <img class="service-img" src="./imgs/icons/fork-knife.svg" alt="Fork and Knife">
                    <h2 class="dish-title service-title">Choose your Favorite</h2>
                    <p class="dish-type restaurant-data-text">Choose your favorite German dish from<br>our diverse menu.
                    </p>
                </div>
                <div class="service-card">
                    <img class="service-img" src="./imgs/icons/food.svg" alt="Food">
                    <h2 class="dish-title service-title">Fresh Food</h2>
                    <p class="dish-type restaurant-data-text">We serve the best and fresh<br>quality food.</p>
                </div>
            </div>
            <!--services cards-->
        </div>
        <!--about restaurant section-->

        <!--subscribe form-->
        <div class="subscribe-form-container">
            <div class="form-titles-container">
                <h3 class="home-title1">subscribe now</h3>
                <h2 class="home-title2">join the family</h2>
            </div>
            <form class="subscribe-form">
                <input class="email email-focus" type="text" placeholder="Email Address">
                <input class="submit-btn" type="submit" value="">
            </form>
        </div>
        <!--subscribe form-->
    </main>
    <!--main content-->

    <!--footer-->
    <footer class="footer-container">
        <div class="footer-website-icon-container">
            <img src="./imgs/icons/website-icon.svg" alt="">
        </div>
        <div class="footer-content">
            <!--social links-->
            <div>
                <hr class="footer-hr">
                <div class="social-icons-container">
                    <a href="https://www.facebook.com/" target="_blank"> <img src="./imgs/icons/facebook.svg"
                            alt="Facebook"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="./imgs/icons/instagram.svg"
                            alt="Instagram"></a>
                    <a href="https://www.tiktok.com/explore" target="_blank"><img src="./imgs/icons/tiktok.svg"
                            alt="TikTok"></a>
                </div>
            </div>
            <!--social links-->
            <div class="footer-links">
                <!--explore-->
                <section>
                    <hr class="footer-hr">
                    <h2 class="dish-title footer-titles">explore</h2>
                    <ul class="nav-footer-list">
                        <li><a class="nav-footer-link" href="home.html">Home</a></li>
                        <li><a class="nav-footer-link" href="menu.html">Menu</a></li>
                        <li><a class="nav-footer-link" href="#">About Us</a></li>
                    </ul>
                </section>
                <!--explore-->
                <!--contact us-->
                <section>
                    <hr class="footer-hr">
                    <h2 class="dish-title footer-titles">CONTACT US</h2>
                    <ul class="nav-footer-list">
                        <li><a class="nav-footer-link" href="tel:+490304664553700">+490304664553700</a></li>
                        <li><a class="nav-footer-link" href="mailto:info@gasthof.com">info@gasthof.com</a></li>
                        <li><a class="nav-footer-link" href="#">Berliner Strasse, Belin.</a></li>
                    </ul>
                </section>
                <!--contact us-->
                <!--legal-->
                <section>
                    <hr class="footer-hr">
                    <h2 class="dish-title footer-titles">LEGAL</h2>
                    <ul class="nav-footer-list">
                        <li><a class="nav-footer-link" href="#">Terms</a></li>
                        <li><a class="nav-footer-link" href="#">Privacy</a></li>
                    </ul>
                </section>
                <!--legal-->
            </div>
        </div>
        <!--footer legal-->
        <p class="footer-legal">©<span id="current-year"></span> Gasthof. - All rights reserved.</p>
        <!--footer legal-->
    </footer>
    <!--footer-->

    <!--script-->
    <script src="./js/mobileNavMenu.js"></script>
    <script src="./js/navMenu.js"></script>
    <script src="./js/Slider.js"></script>
    <script src="./js/HeroSlider.js"></script>
    <script src="./js/currentYear.js"></script>
    <!--script-->
</body>

</html>