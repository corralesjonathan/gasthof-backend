<?php
    require_once 'database.php';
    // Reference: https://medoo.in/api/select
    $categories = $database->select("tb_dishes_categories", "*");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Gathof</title>
    <!--favicon-->
    <?php include './parts/favicon.php'?>
    <!--fonts-->
    <?php include './parts/fonts.php'?>
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
                    <?php
                        $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
                        echo "<li><a id='all' onclick=\"getCategories('all', $userId)\" class='nav-list-link nav-menu-list-link'>All</a></li>"
                        . "<li><a id='starters' onclick=\"getCategories(" . $categories[0]["id_dish_category"] .", $userId)\" class='nav-list-link nav-menu-list-link' >" . $categories[0]["dish_category_name"] . "</a></li>"
                        . "<li><a id='main-courses' onclick=\"getCategories(" . $categories[1]["id_dish_category"] .", $userId)\" class='nav-list-link nav-menu-list-link' >" . $categories[1]["dish_category_name"] . "</a></li>"
                        . "<li><a id='desserts' onclick=\"getCategories(" . $categories[2]["id_dish_category"] .", $userId)\" class='nav-list-link nav-menu-list-link' >" . $categories[2]["dish_category_name"] . "</a></li>"
                        . "<li><a id='drinks' onclick=\"getCategories(" . $categories[3]["id_dish_category"] .", $userId)\" class='nav-list-link nav-menu-list-link' >" . $categories[3]["dish_category_name"] . "</a></li>";                    
                    ?>
                </ul>
            </div>
            <!--filter dishes menu-->
            <!--dishes cards grid-->
            <div id="menu-container" class="menu-container">
                <!--dishes cards grid-->
            </div>
            <!--dishes cards grid-->
        </div>
        <!--dishes main container-->

        <!--Added to cart popup-->
        <div id="cart-popup"></div>
        <!--Added to cart popup-->

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
    <?php echo "<script>const userId = $userId;</script>";?>
    <script src="./js/filter-dishes.js"></script>
</body>
</html>