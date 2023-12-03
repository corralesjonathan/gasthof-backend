<?php
require_once 'database.php';

function getAddresses($database) {
    $addresses = $database->select("tb_addresses", "*", [
        "id_user" => $_SESSION["user_id"]
    ]);

    return $addresses;
}

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
        "tb_dishes_categories.id_dish_category",
        "tb_dishes_categories.dish_category_name"
    ], [
        "tb_cart.id_user" => $_SESSION["user_id"]
    ]);

    return $dishes;
}

$order_types = $database -> select("tb_order_type", "*");



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Gathof</title>
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
                    ."<h3 class='home-title1'>check</h3>"
                    ."<h2 class='home-title2'>your order</h2>"
                ."</div>";
            }
            ?>

                <h2 class="slide-title dish-title wish-list-title">1. review your order</h2>
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

                    if (empty($dishes)) {
                        echo "<p class='dish-type slide-description'>Add dishes to your cart.</p>";
                    } else {
                        echo "<p id='total' class='dish-type slide-description'><b>TOTAL: $" . number_format($total, 2) . "</b></p>";
                    }
                    ?>


                <div class="order-container">
                    <div class="order-type-container">
                        <h2 class="slide-title dish-title wish-list-title">2. order type</h2>
                        <p class="dish-type slide-description"><b>Select a order type</b></p>
                        <?php 
                        foreach($order_types as $order_type) {
                            echo '<div class="input-container">';
                            echo '<label class="dish-type slide-description">';
                            echo '<input onclick="getIdOrder('.$order_type["id_order_type"].')" type="radio" name="order_type" value="' . $order_type["id_order_type"] . '" class="styled-radio">';
                            echo '<span class="label-text">' . $order_type["order_type_name"] . '</span>';
                            echo '</label>';
                            echo '</div>';
                        }
                        ?>
                    </div>
                    <div class="delivery-address-container">
                        <h2 class="slide-title dish-title wish-list-title">3. delivery address</h2>
                        <p class="dish-type slide-description"><b>Select a address</b></p>
                        <?php
                        $addresses = getAddresses($database);
                        if(empty($addresses)){
                            echo "<p class='dish-type slide-description'>No addresses found</p>";
                            echo "<a class='dish-type slide-description add-address' href='account.php'><b>Add new address</b></a>";
                        }else{ 
                        foreach($addresses as $address) {
                            echo '<div class="input-container">';
                            echo '<label class="dish-type slide-description">';
                            echo '<input onclick="getIdAddress('.$address["id_address"].')"  type="radio" name="address" value="' . $address["id_address"] . '" class="styled-radio">';
                            echo '<span class="label-text"> ' .$address["delivery_address"].', '.$address["city"].', '.$address["province"].', '.$address["country"].'</span>';
                            echo '</label>';
                            echo '</div>';
                        }
                        if(count($addresses)<2){
                            echo "<a class='dish-type slide-description add-address' href='account.php'><b>Add new address</b></a>";
                        }
                        
                    }
                        ?>
                    </div>
                </div>
                
                <div class="cart-btn-container">
                    <a class="btn view-all" href="menu.php">explore more dishes</a>
                    <?php 
                    echo "<a onclick='addOrder(".$_SESSION["user_id"].")' class='btn view-all'>complete order</a>";
                    ?>
                </div>
            </div>

        </main>

        <footer>
            <?php include './parts/footer.php'?>
        </footer>
        <script src="./js/remove-from-cart.js"></script>
        <script src="./js/update-cart.js"></script>
        <script>
        let id_order_type = 0;
        let id_address = 0;
        let total = 0;

        let currentDate = new Date();

        let day = currentDate.getDate();
        let month = currentDate.getMonth() + 1;
        let year = currentDate.getFullYear();
        let hours = currentDate.getHours();
        let minutes = currentDate.getMinutes();
        let seconds = currentDate.getSeconds();

        let formattedDate = `${year}/${month}/${day}`;
        var formattedTime = `${hours}:${minutes}:${seconds}`;

        function getIdOrder(order_type_id) {
            id_order_type = order_type_id;
            console.log(id_order_type);
        }

        function getIdAddress(address_id) {
            id_address = address_id;
            console.log(address_id);
        }

        function addOrder(id_user) {

            let info = {
                id_user: id_user,
                id_order_type: id_order_type,
                id_address: id_address,
                date: formattedDate,
                time: formattedTime,
                total: total
            };

            console.log(info);

            // Fetch
            fetch("http://localhost/gasthof-backend/AJAX/add-order.php", {
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
                    console.log(data);
                })
                .catch(err => console.log("Error al enviar la solicitud: " + err));
        }

        function updateInterface(id_cart) {
            let tr = document.querySelector(`#tr-${id_cart}`);
            trNaNpxove();
            location.reload()
        }
        </script>
</body>

</html>