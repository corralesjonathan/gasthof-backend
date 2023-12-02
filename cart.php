<?php

function getCart($database) {

    $dishes = $database->select("tb_cart", [
        "[>]tb_dishes" => ["id_dish" => "id_dish"],
        "[>]tb_users" => ["id_user" => "id_user"],
        "[>]tb_dishes_categories" => ["tb_dishes.id_dish_category" => "id_dish_category"],
    ], [
        "tb_cart.id_cart",
        "tb_cart.subtotal",
        "tb_cart.quantity",
        "tb_dishes.id_dish",
        "tb_dishes.dish_name",
        "tb_dishes.dish_image",
        "tb_dishes.dish_price",
        "tb_users.id_user",
        "tb_dishes_categories.dish_category_name"
    ], [
        "tb_cart.id_user" => $_SESSION["user_id"]
    ]);

    return $dishes;
}

function isCartEmpty($database) {
    $cartCount = $database->count("tb_cart", [
        "id_user" => $_SESSION["user_id"]
    ]);

    return $cartCount == 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Gathof</title>
    <!--favicon-->
    <?php include './parts/favicon.php'?>
    <!--fonts-->
    <?php include './parts/fonts.php'?>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <header>
        <!--nav-->
        <?php include './parts/navigation.php'?>
        <!--nav-->

        <main>
            <div class="dishes-main-container">
                <?php
            $dishes = getCart($database);
            if(isset($_SESSION["isLoggedIn"])){ 
                echo "<div class='home-titles-container'>"
                    ."<h3 class='home-title1'>my</h3>"
                    ."<h2 class='home-title2'>shopping cart</h2>"
                ."</div>";
            }
            ?>
                <?php echo"<h2 class='slide-title dish-title wish-list-title'>Your Cart (".count($dishes)." items)</h2>";?>
                <table class="wishlist-table">
                    <thead class="wishlist-thead">
                        <tr class="wishlist-tr">
                            <td class="dish-title wishlist-td-delete"></td>
                            <td class="dish-title wishlist-td-image"></td>
                            <td class="dish-title wishlist-td-name">Name</td>
                            <td class="dish-title wishlist-td-price">Unit price</td>
                            <td class="dish-title wishlist-td-actions">Quantity</td>
                            <td class="dish-title wishlist-td-actions">Subtotal</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($dishes as $dish){
                        echo "<tr id='tr-{$dish["id_cart"]}'>"
                            ."<td><a onclick='removeFromCart(".$dish["id_cart"].")' href='#'><img src='./imgs/icons/delete.svg' alt=''></a></td>"
                            ."<td class='dish-type slide-description'><a href='dish.php?id=".$dish["id_dish"]."'><img class='wishlist-img' src='./imgs/dishes/".$dish["dish_category_name"]."/".$dish["dish_image"]."' alt=''></a></td>"
                            ."<td class='wishlist-dish-title'><a class='dish-type slide-description' href='dish.php?id=".$dish["id_dish"]."'>".$dish["dish_name"]."</a><br><a class='dish-type'>".$dish["dish_category_name"]."</a></td>"
                            ."<td class='dish-type slide-description'>$".$dish["dish_price"]."</td>"
                            ."<td><input onchange='updateCart(".$_SESSION["user_id"].", ".$dish["id_dish"].", ".$dish["dish_price"].", ".$dish["id_cart"].")' class='quantity' type='number' id='quantity-{$dish["id_cart"]}' value=".$dish["quantity"]." min='1'></td>"
                            ."<td class='dish-type slide-description' id='subtotal-{$dish["id_cart"]}'>$".$dish["subtotal"]."</td>"
                        ."</tr>";
                    }
                    ?>

                    </tbody>
                </table>
                <?php
                    $total = 0;

                    foreach ($dishes as $dish) {
                        $total += $dish["subtotal"];
                    }

                    if (isCartEmpty($database)) {
                        echo "<p class='dish-type slide-description'>Your cart is empty.</p>";
                    } else {
                        echo "<p id='total' class='dish-type slide-description'><b>TOTAL: $" . number_format($total, 2) . "</b></p>";
                    }
                    ?>
            </div>
        </main>

        <footer>
            <?php include './parts/footer.php'?>
        </footer>
        <script src="./js/remove-from-cart.js"></script>
        <script src="./js/update-cart.js"></script>
        <script>
        function updateInterface(id_cart) {
            let tr = document.querySelector(`#tr-${id_cart}`);
            tr.remove();
            location.reload()
        }
        </script>
</body>

</html>