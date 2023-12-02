<?php 
require_once 'database.php';

if ($_GET){
    $dish = $database->select("tb_dishes",[
        "[>]tb_dishes_sizes"=>["id_dish_size" => "id_dish_size"],
        "[>]tb_dishes_categories"=>["id_dish_category" => "id_dish_category"]
    ],[
        "tb_dishes.id_dish",
        "tb_dishes.dish_name",
        "tb_dishes.dish_name_de",
        "tb_dishes.dish_description",
        "tb_dishes.dish_description_de",
        "tb_dishes.dish_price",
        "tb_dishes.dish_image",
        "tb_dishes.featured",
        "tb_dishes_sizes.id_dish_size",
        "tb_dishes_sizes.dish_size_name",
        "tb_dishes_categories.dish_category_name",
    ],[
        "id_dish" => $_GET["id"]
    ]); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $dish[0]["dish_name"]?> - Gashof</title>
    <!-- Favicon -->
    <?php include './parts/favicon.php'?>
    <!-- Fonts -->
    <?php include './parts/fonts.php'?>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <header>
        <?php include './parts/navigation.php'?>
    </header>

    <main>
        <!-- Single dish -->
        <?php 
        echo "<div class='dish-container'>
        <div class='dish-img-container'>
            <img class='dish-img' src='./imgs/dishes/{$dish[0]["dish_category_name"]}/{$dish[0]["dish_image"]}' alt='{$dish[0]["dish_name"]}'>
        </div>
        <div class='dish-info-container'>
            <div class='language-btn-container'>
                <span id='en' class='btn order' onclick='getTranslation({$dish[0]["id_dish"]}, \"en\")'>EN</span>
                <span id='de' class='btn order' onclick='getTranslation({$dish[0]["id_dish"]}, \"de\")'>DE</span>
            </div>
            <div class='dish-title-container'>
                <h2 id='dish-title' class='single-dish-title dish-title'>{$dish[0]["dish_name"]}</h2>";

        if ($dish[0]["featured"] == 1) {
            echo "<img src='./imgs/icons/star.svg' alt='Star'>";
        }

        echo "</div>
            <p id='dish-category' class='dish-type'>{$dish[0]["dish_category_name"]}</p>
            <p id='dish-price' class='single-dish-price dish-price'>$ {$dish[0]["dish_price"]}</p>
            <p id='dish-description' class='dish-type slide-description'>{$dish[0]["dish_description"]}</p>";

        if ($dish[0]["id_dish_size"] == 1) {
            echo "<img src='./imgs/icons/individual.svg' alt='{$dish[0]["dish_size_name"]}'>";
        } else if ($dish[0]["id_dish_size"] == 2) {
            echo "<img src='./imgs/icons/couple.svg' alt='{$dish[0]["dish_size_name"]}'>";
        } else {
            echo "<img src='./imgs/icons/family.svg' alt='{$dish[0]["dish_size_name"]}'>";
        }

        echo "<div class='add-cart-container'>
                <input class='quantity' type='number' id='quantity' value='1'>";

        if (isset($_SESSION["isLoggedIn"])) {
            echo "<a class='btn add-cart' onclick=\"addToCart({$_SESSION["user_id"]}, {$dish[0]["id_dish"]}, parseInt(document.getElementById('quantity').value), {$dish[0]["dish_price"]})\">ADD TO CART</a>";
        } else {
            echo "<a class='btn add-cart' href='login.php'>ADD TO CART</a>";
        }

        echo "</div>
            </div>
        </div>";

        ?>
        <!-- Single dish -->

        <!-- Added to cart popup -->
        <div id="cart-popup"></div>
        <!-- Added to cart popup -->

        <!-- Related dishes -->
        <!--<div class="dishes-main-container">
            <div class="home-titles-container">
                <h3 class="home-title1">discover</h3>
                <h2 class="home-title2">related dishes</h2>
            </div>
            <div class="dishes-container">
                <?php 
                /*foreach($categories as $category){
                    echo "<section class='dish-card'>
                            <img src='./imgs/dishes/".$category["dish_category_name"]."/".$category["dish_image"]."' alt=".$category["dish_name"]." class='dish-card-img'>
                            <div class='dish-data-container'>
                                <div>
                                    <h2 class='dish-title'>".$category["dish_name"]."</h2>
                                    <p class='dish-type'>".$category["dish_category_name"]."</p>
                                </div>
                                <a href='#'><img src='./imgs/icons/cart.svg' alt='Cart'></a>
                            </div>
                            <p class='dish-price'>$5.90</p>
                            <a class='btn order' href=''>Order</a>
                        </section>";
                }*/
                ?>
            </div>
        </div>-->
        <!-- Related dishes -->

        <!-- Subscribe form -->
        <?php include './parts/subscribe-form.php'?>
        <!-- Subscribe form -->
    </main>

    <footer>
        <?php include './parts/footer.php'?>
    </footer>
    
    <script src="./js/changeLanguage.js"></script>
    <script src="./js/add-to-cart.js"></script>
</body>

</html>
