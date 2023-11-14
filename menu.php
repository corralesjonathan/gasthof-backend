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
    //], [
        //where to show featured dishes only
       //"tb_dishes_categories.id_dish_category" => 1
    ]);  
?>
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
                    <?php 
                        echo "<li><a id='btnStarters' class='nav-list-link nav-menu-list-link' href='#'>".$categories[0]["dish_category_name"]."</a></li>"
                        ."<li><a id='btnMainCourses' class='nav-list-link nav-menu-list-link' href='#'>".$categories[1]["dish_category_name"]."</a></li>"
                        ."<li><a id='btnDesserts' class='nav-list-link nav-menu-list-link' href='#'>".$categories[2]["dish_category_name"]."</a></li>"
                        ."<li><a id='btnDrinks' class='nav-list-link nav-menu-list-link' href='#'>".$categories[3]["dish_category_name"]."</a></li>";
                    ?>
                </ul>
            </div>
            <!--filter dishes menu-->
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
                    <!--<section class="dish-card" data-category="main-courses">
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
                    </section>-->
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
    <!--<script src="./js/filterMenu.js"></script>-->
    <!--script-->
</body>

</html>