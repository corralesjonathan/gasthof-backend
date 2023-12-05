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
    <!--header-->
    <header>
        <?php include './parts/navigation.php'?>
    </header>
    <!--header-->

    <!--main content-->
    <main>
        <div class="dishes-main-container">
            <?php
            $dishes = getCart($database);
            if (isset($_SESSION["isLoggedIn"])) {
                echo "<div class='home-titles-container'>"
                    . "<h3 class='home-title1'>check</h3>"
                    . "<h2 class='home-title2'>your order</h2>"
                    . "</div>";
            }
            ?>

            <!--review order section-->
            <h2 class="slide-title dish-title wish-list-title">1. review your order</h2>
            <table class="wishlist-table">
                <thead class="wishlist-thead">
                    <tr class="wishlist-tr">
                        <th></th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Unit price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($dishes as $dish) {
                        echo "<tr id='tr-{$dish["id_cart"]}'>"
                            . "<td class='td-actions'><a onclick='removeFromCart(" . $dish["id_cart"] . ")' href='#'><img class='trash-icon' src='./imgs/icons/delete.svg' alt=''></a></td>"
                            . "<td><a href='dish.php?id=" . $dish["id_dish"] . "'><img class='wishlist-img' src='./imgs/dishes/" . $dish["dish_category_name"] . "/" . $dish["dish_image"] . "' alt=''></a></td>"
                            . "<td><a class='td-a' href='dish.php?id=" . $dish["id_dish"] . "'>" . $dish["dish_name"] . "</a><br><a class='td'>" . $dish["dish_category_name"] . "</a></td>"
                            . "<td>$" . $dish["dish_price"] . "</td>"
                            . "<td class='td-actions'><input onchange='updateCart(" . $_SESSION["user_id"] . ", " . $dish["id_dish"] . ", " . $dish["dish_price"] . ", " . $dish["id_cart"] . ")' class='quantity' type='number' id='quantity-{$dish["id_cart"]}' value=" . $dish["quantity"] . " min='1'></td>"
                            . "<td  id='subtotal-{$dish["id_cart"]}'>$" . $dish["subtotal"] . "</td>"
                            . "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <table>
                    <thead>
                        <tr>
                            <th class="dish-title td-total">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;

                        foreach ($dishes as $dish) {
                            $total += $dish["subtotal"];
                        }

                        echo "<tr>"
                            ."<td> <p id='total' class='dish-type slide-description td-total'> <b>$" . number_format($total, 2) . "</b> </p> </td>"
                        ."</tr>";
                        ?>
                    </tbody>
                </table>
            <!--review order section-->
            
            <?php
                if (empty($dishes)) {
                    echo "<p class='dish-type slide-description'>Add dishes to your cart.</p>";
                }
            ?>
            
            <div class="order-container">
                <!--order type section-->
                <div class="order-type-container">
                    <h2 class="slide-title dish-title wish-list-title">2. order type</h2>
                    <p class="dish-type slide-description"><b>Select an order type</b></p>
                    <?php
                    foreach ($order_types as $order_type) {
                        echo "<div class='input-container'>"
                        ."<label class='dish-type slide-description'>"
                        ."<input onclick='getIdOrder(" . $order_type["id_order_type"] . ")' type='radio' name='order_type' value='" . $order_type["id_order_type"] . "' class='styled-radio'>"
                        ."<span class='label-text'>" . $order_type["order_type_name"] . "</span>"
                        ."</label>"
                        ."</div>";
                    }
                    ?>
                </div>
                <!--order type section-->

                <!--delivery address section-->
                <div class="delivery-address-container">
                    <h2 class="slide-title dish-title wish-list-title">3. delivery address</h2>
                    <p class="dish-type slide-description"><b>Select an address</b></p>
                    <?php
                    $addresses = getAddresses($database);
                    if (empty($addresses)) {
                        echo "<p class='dish-type slide-description'>No addresses found</p>";
                        echo "<a class='dish-type slide-description add-address' href='account.php'><b>Add a new address</b></a>";
                    } else {
                        foreach ($addresses as $address) {
                            echo "<div class='input-container'>"
                            ."<label class='dish-type slide-description'>"
                            ."<input onclick='getIdAddress(" . $address["id_address"] . ")'  type='radio' name='address' value='" . $address["id_address"] . "' class='styled-radio'>"
                            ."<span class='label-text'> " . $address["delivery_address"] . ", " . $address["city"] . ", " . $address["province"] . ", " . $address["country"] . "</span>"
                            ."</label>"
                            ."</div>";
                        }
                        if (count($addresses) < 2) {
                            echo "<a class='dish-type slide-description add-address' href='account.php'><b>Add a new address</b></a>";
                        }
                    }
                    ?>
                </div>
                <!--delivery address section-->
            </div>

            <div class="cart-btn-container">
                <a class="btn view-all margin-btn" href="menu.php">explore more dishes</a>
                <?php
                echo "<a id='complete-order' onclick='addOrder(" . $_SESSION["user_id"] . ")'  class='btn view-all margin-btn'>complete order</a>";
                ?>
            </div>
        </div>
    </main>
    <!--main content-->
        
    <!--footer-->
    <footer>
        <?php include './parts/footer.php'?>
    </footer>
    <!--footer-->
        
    <!--script-->
    <script src="./js/remove-from-cart.js"></script>
    <script src="./js/update-cart.js"></script>
    <script src="./js/add-order.js"></script>
    <script>
        function updateInterface(id_cart) {
            let tr = document.querySelector(`#tr-${id_cart}`);
            trNaNpxove();
            location.reload()
        }
    </script>
    <!--script-->
</body>
</html>