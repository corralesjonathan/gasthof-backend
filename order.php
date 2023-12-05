<?php
require_once 'database.php';

if($_GET){
    // Realiza la consulta para obtener las órdenes del usuario
    $orders = $database->select("tb_orders", [
        "[>]tb_order_items" => ["id_order" => "id_order"],
        "[>]tb_order_type" => ["id_order_type" => "id_order_type"],
        "[>]tb_dishes" => ["tb_order_items.id_dish" => "id_dish"],
        "[>]tb_dishes_categories" => ["tb_dishes.id_dish_category" => "id_dish_category"]
    ], [
        "tb_orders.id_order",
        "tb_orders.order_date",
        "tb_orders.total",
        "tb_order_type.order_type_name",
        "tb_order_items.quantity",
        "tb_order_items.subtotal",
        "tb_dishes.dish_name",
        "tb_dishes.dish_image",
        "tb_dishes.dish_price",
        "tb_dishes_categories.dish_category_name"
    ], [
        "tb_orders.id_order" => $_GET["id"]
    ]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Gathof</title>
    <!--favicon-->
    <?php include './parts/favicon.php'?>
    <!--fonts-->
    <?php include './parts/fonts.php'?>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <header>
        <?php include './parts/navigation.php'?>
    </header>

    <main>
            <div class="dishes-main-container">
                <?php
            if(isset($_SESSION["isLoggedIn"])){ 
                echo "<div class='home-titles-container'>"
                    ."<h3 class='home-title1'>tank you</h3>"
                    ."<h2 class='home-title2'>your order was received</h2>"
                ."</div>";
            }
            ?>
            <?php 
                echo "<h2 class='slide-title dish-title wish-list-title'>Order #".$orders[0]["id_order"]."</h2>";
            ?>
             <table>
                    <thead>
                        <tr>
                            <th class="dish-title">Image</th>
                            <th class="dish-title">Name</th>
                            <th class="dish-title">Unit price</th>
                            <th class="dish-title">Quantity</thd>
                            <th class="dish-title">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($orders as $order){
                        echo "<tr>"
                            ."<td class='dish-type'><a><img class='wishlist-img' src='./imgs/dishes/".$order["dish_category_name"]."/".$order["dish_image"]."' alt=''></a></td>"
                            ."<td class='dish-type'><a class='dish-type'>".$order["dish_name"]."</a><br><a class='dish-type'>".$order["dish_category_name"]."</a></td>"
                            ."<td class='dish-type'>$".$order["dish_price"]."</td>"
                            ."<td class='dish-type'>".$order["quantity"]."</td>"
                            ."<td class='dish-type'>$ ".$order["subtotal"]."</td>"
                        ."</tr>";
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
                        echo "<tr>"
                            ."<td class='dish-type slide-description td-total'> <b>$ ".$orders[0]["total"]."</b> </td>"
                        ."</tr>";
                    ?>
                    </tbody>
                </table>
                
                
                <?php    
                echo "<div class='order-container'>"
                    . "<div class='order-type-container'>"
                        . "<h2 class='slide-title dish-title wish-list-title'>order type</h2>"
                        . "<p class='dish-type slide-description'>" . $orders[0]["order_type_name"] . "</p>"  
                    . "</div>"
                    . "<div class='delivery-address-container'>"
                        . "<h2 class='slide-title dish-title wish-list-title'>Address</h2>"
                        . "<p class='dish-type slide-description'>" . $orders[0]["order_type_name"] . "</p>"  
                    . "</div>"
                . "</div>";
                ?>
            </div>
                
    </main>

    <footer>
        <?php include './parts/footer.php'?>
    </footer>
</body>
</html>