<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu-Gathof</title>
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
        <?php 
            include './parts/navigation.php'
        ?>
        <!--nav-->
        <div class="hero-container">
            <div class="menu-header-texts-container">
                <h3 class="home-title1 menu-header-title">our menu</h3>
            </div>
        </div>
    </header>
    <!--header & hero-->

    <!--main content-->
    <main>
        <!--dishes main container-->
        <div class="dishes-main-container">
            <!--filter dishes menu-->
            <div class="categories-buttons-container">
                <ul class="nav-list menu-filter-products-list">
                    <li><a id="btnAll" class="nav-list-link nav-menu-list-link" href="#">All</a></li>
                    <li><a id="btnStarters" class="nav-list-link nav-menu-list-link" href="#">Starters</a></li>
                    <li><a id="btnMainCourses" class="nav-list-link nav-menu-list-link" href="#">Main courses</a></li>
                    <li><a id="btnDesserts" class="nav-list-link nav-menu-list-link" href="#">Desserts</a></li>
                    <li><a id="btnDrinks" class="nav-list-link nav-menu-list-link" href="#">Drinks</a></li>
                </ul>
            </div>
            <!--filter dishes menu-->
            <!--dishes cards grid-->
            <div class="menu-container">
                <div class="dishes-container">
                    <section class="dish-card" data-category="main-courses">
                        <img src="./imgs/dishes/Main Courses/schnitzel.webp" alt="Schnitzel" class="dish-card-img">
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
                    <section class="dish-card" data-category="main-courses">
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
                    <section class="dish-card" data-category="desserts">
                        <img src="./imgs//cards/desserts/käsekuchen.webp" alt="Käsekuchen" class="dish-card-img">
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
                    <section class="dish-card" data-category="starters">
                        <img src="./imgs//cards/starters/kartoffelpuffer.webp" alt="Kartoffelpuffer" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Kartoffelpuffer </h2>
                                <p class="dish-type">Starter</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$6.25</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="starters">
                        <img src="./imgs/cards/starters/kohlrouladen.webp" alt="Kohlrouladen" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Kohlrouladen </h2>
                                <p class="dish-type">Starter</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$5.95</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="desserts">
                        <img src="./imgs/cards/desserts//rote-grütze.webp" alt="Rote Grütze" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Rote Grütze</h2>
                                <p class="dish-type">Dessert</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$3.35</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="drinks">
                        <img src="./imgs/cards/drinks/bitburger.webp" alt="Bitburger" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Bitburger</h2>
                                <p class="dish-type">Drink</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$2.35</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="drinks">
                        <img src="./imgs/cards/drinks/kefir.webp" alt="Kefir" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Kefir</h2>
                                <p class="dish-type">Drink</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$1.505</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="main-courses">
                        <img src="./imgs/cards/main-courses/roastbeef-mit.webp" alt="Roastbeef mit" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Roastbeef mit</h2>
                                <p class="dish-type">Main course</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$6.90</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="drinks">
                        <img src="./imgs/cards/drinks/glühwein.webp" alt="Glühwein" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Glühwein</h2>
                                <p class="dish-type">Drink</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$1.15</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="desserts">
                        <img src="./imgs/cards/desserts/eisbecher.webp" alt="Eisbecher" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Eisbecher</h2>
                                <p class="dish-type">Dessert</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$2.25</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="starters">
                        <img src="./imgs/cards/starters/radieschen-salat.webp" alt="Radieschen Salat" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Radieschen Salat</h2>
                                <p class="dish-type">Starter</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$2</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="starters">
                        <img src="./imgs/cards/starters/kartoffelsalat.webp" alt="Kartoffelsalat" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Kartoffelsalat</h2>
                                <p class="dish-type">Starter</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$2.99</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="desserts">
                        <img src="./imgs/cards/desserts/black-forest-cake.webp" alt="Black Forest Cake" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Black Forest Cake</h2>
                                <p class="dish-type">Dessert</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$4.30</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="main-courses">
                        <img src="./imgs/cards/main-courses/schweinebraten-mit.webp" alt="Schweinebraten mit" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Schweinebraten mit</h2>
                                <p class="dish-type">Main course</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$9</p>
                        <a class="btn order" href="">Order</a>
                    </section>
                    <section class="dish-card" data-category="drinks">
                        <img src="./imgs/cards/drinks/apfelsaftschorle.webp" alt="Apfelsaftschorle" class="dish-card-img">
                        <div class="dish-data-container">
                            <div>
                                <h2 class="dish-title">Apfelsaftschorle</h2>
                                <p class="dish-type">Drink</p>
                            </div>
                            <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                        </div>
                        <p class="dish-price">$1.50</p>
                        <a class="btn order" href="">Order</a>
                    </section>

                </div>
                <!--dishes cards grid-->
            </div>
            <!--dishes cards grid-->
        </div>
        <!--dishes main container-->

        <!--subscribe form-->
        <?php 
            include './parts/subscribe-form.php'
        ?>
        <!--subscribe form-->
    </main>
    <!--main content-->

    <!--footer-->
    <?php 
        include './parts/footer.php'
    ?>
    <!--footer-->

    <!--script-->
    <script src="./js/filterMenu.js"></script>
    <!--script-->
</body>
</html>