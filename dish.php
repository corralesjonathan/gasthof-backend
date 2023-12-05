<?php 
require_once 'database.php';

$relatedDishes = $database->rand("tb_dishes",[
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
]); 

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
        <div class="dishes-main-container">
        <div class="home-titles-container">
                <h3 class="home-title1">discover</h3>
                <h2 class="home-title2">related dishes</h2>
            </div>
        <div class="dishes-container">
        <?php
        $contador = 0;
        foreach($relatedDishes as $relatedDish){
            //dish image
            echo "<section class='dish-card'>"
            . "<div class='card-img-container'>"
            . "<a class='dish-card-link' href='dish.php?id=".$relatedDish["id_dish"]."'>"
            . "<img src='./imgs/dishes/".$relatedDish["dish_category_name"]."/".$relatedDish["dish_image"]."' alt=".$relatedDish["dish_name"]." class='dish-card-img'>"
            . "</a>";
        //add to wishlist
        if (isset($_SESSION["isLoggedIn"])) {
            $wishlist = getWishlist($database, $relatedDish["id_dish"]);
            $likeAction = !empty($wishlist) ? "removeFromWishlist(".$wishlist[0]["id_wishlist"].")" : "addToWishlist(".$relatedDish["id_dish"].", ".$_SESSION["user_id"].")";
            echo "<a id='like' onclick='".$likeAction."'><img class='like-icon' src='./imgs/icons/like".(!empty($wishlist) ? '-fill' : '').".svg'></a>";
        } else {
            echo "<a href='login.php' id='like'><img class='like-icon' src='./imgs/icons/like.svg'></a>";
        }
        //dish data
        echo "</div>"
            . "<div class='dish-data-container'>"
            . "<div class='dish-texts-container'>"
            . "<a class='a-titles' href='dish.php?id=".$relatedDish["id_dish"]."'>"
            . "<h2 class='dish-title'>".$relatedDish["dish_name"]."</h2>"
            . "</a>"
            . "<p class='dish-type'>".$relatedDish["dish_category_name"]."</p>"
            . "</div>";
        //add to cart
        if (isset($_SESSION["isLoggedIn"])) {
            echo "<a onclick='addToCart(".$_SESSION["user_id"].", ".$relatedDish["id_dish"].", 1, ".$relatedDish["dish_price"].")'><img class='cart-img' src='./imgs/icons/cart.svg' alt='Cart'></a>";
        } else {
            echo "<a href='login.php'><img class='cart-img' src='./imgs/icons/cart.svg' alt='Cart'></a>";
        }
        //order
        echo "</div>"
            . "<p class='dish-price'>$".$relatedDish["dish_price"]."</p>"
            . "<a class='btn order' href='dish.php?id=".$relatedDish["id_dish"]."'>Order</a>"
            . "</section>";

            $contador++;
            if($contador == 4){
                break;
            }
        }
        ?>
        </div>
        </div>
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
    <script src="./js/add-to-wishlist.js"></script>
    <script src="./js/remove-from-wishlist.js"></script>
</body>

</html>
