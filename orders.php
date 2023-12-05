<?php
    require_once 'database.php';

    function getOrders($database){
        $userId = $_SESSION["user_id"];

        $orders = $database->select("tb_orders", [
            "[>]tb_users" => ["id_user" => "id_user"],
            "[>]tb_order_type" => ["id_order_type" => "id_order_type"]
        ], [
            "tb_users.id_user",
            "tb_orders.id_order",
            "tb_orders.order_date",
            "tb_orders.total",
            "tb_order_type.order_type_name",
        ], [
            "tb_users.id_user" => $userId,
        ]);

        return $orders;
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Gathof</title>
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
                    ."<h3 class='home-title1'>Welcome,</h3>"
                    ."<h2 class='home-title2'>".$_SESSION["fullname"]."</h2>"
                    ."</div>";
                }
            ?>
            <div class="account-container">
                <div class="account-options-container">
                    <a class="btn order" href="account.php">Account details</a>
                    <a class="btn order order-focus" href="">Orders</a>
                    <a class="btn order" href="addresses.php">Addresses</a>
                    <a class="btn order" href="wishlist.php">My Wishlist</a>
                    <a class="btn order" href="logout.php">Log Out</a>
                </div>

                <div class="account-orders-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Order Type</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $orders = getOrders($database);
                            foreach ($orders as $order){
                            echo "<tr>"
                                ."<td><a class='dish-type add-address' href='order.php?id=".$order["id_order"]."'>#".$order["id_order"]."</a></td>"
                                ."<td>".$order["order_date"]."</td>"
                                ."<td>".$order["order_type_name"]."</td>"
                                ."<td>$".$order["total"]."</td>"
                            ."</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                    if (empty($orders)) {
                        echo "<p class='dish-type slide-description'>No orders yet.</p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <?php include './parts/footer.php'?>
    </footer>

    <script>
    let newPassword;
    let confirmedPassword;

    function getNewPassword() {
        newPassword = document.getElementById("new-pdw").value;
        console.log(newPassword);
        passwordMessage();
    }

    function getConfirmedPassword() {
        confirmedPassword = document.getElementById("confirmed-pwd").value;
        console.log(confirmedPassword);
        passwordMessage();
    }

    function passwordMessage() {
        if (newPassword == confirmedPassword) {
            document.getElementById("pwd-message").innerText = "";
        } else {
            document.getElementById("pwd-message").innerText = "Passwords don't match";
        }
    }
    </script>
</body>

</html>