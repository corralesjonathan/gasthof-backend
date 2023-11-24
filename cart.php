<?php

function getWishlist($database) {

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
        "tb_wishlist.id_user" => $_SESSION["user_id"]
    ]);

    return $dishes;
}

function isWishlistEmpty($database) {
    $wishlistCount = $database->count("tb_wishlist", [
        "id_user" => $_SESSION["user_id"]
    ]);

    return $wishlistCount == 0;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - Gathof</title>
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
            $dishes = getWishlist($database);
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
                    echo "<tr id='tr-{$dish["id_wishlist"]}'>"
                        ."<td><a onclick='removeFromWishlist(".$dish["id_wishlist"].")' href='#'><img src='./imgs/icons/delete.svg' alt=''></a></td>"
                        ."<td class='dish-type slide-description'><a href='dish.php?id=".$dish["id_dish"]."'><img class='wishlist-img' src='./imgs/dishes/".$dish["dish_category_name"]."/".$dish["dish_image"]."' alt=''></a></td>"
                        ."<td class='wishlist-dish-title'><a class='dish-type slide-description' href='dish.php?id=".$dish["id_dish"]."'>".$dish["dish_name"]."</a><br><a class='dish-type'>".$dish["dish_category_name"]."</a></td>"
                        ."<td class='dish-type slide-description'>$".$dish["dish_price"]."</td>"
                        ."<td><input class='quantity' type='number' id='quantity' value='1'></td>"
                        ."<td class='dish-type slide-description'>$".$dish["dish_price"]."</td>"
                    ."</tr>";
                }
            ?>
                    </tbody>
                </table>
                <?php 
                if (isWishlistEmpty($database)){
                echo "<p class='dish-type slide-description'>Your wishlist is empty.</p>";
                }
                ?>
            </div>
        </main>

        <footer>
            <?php 
            include './parts/footer.php'
        ?>
        </footer>

        <script>
        function removeFromWishlist(id_wishlist) {
            console.log(id_wishlist);

            let info = {
                id_wishlist: id_wishlist,
            };

            // Fetch
            fetch("http://localhost/gasthof-backend/remove-from-wishlist.php", {
                    method: "POST",
                    mode: "same-origin",
                    credentials: "same-origin",
                    headers: {
                        'Accept': "application/json, text/plain, */*",
                        'Content-Type': "application/json"
                    },
                    body: JSON.stringify(info)
                })
                .then(response => response.json())
                .then(data => {
                    updateInterface(id_wishlist);
                    console.log(data);
                })
                .catch(err => console.log("Error al enviar la solicitud: " + err));
        }

        function updateInterface(id_wishlist) {
            let tr = document.querySelector(`#tr-${id_wishlist}`);
            tr.remove();
            location.reload()
        }
        </script>
</body>

</html>