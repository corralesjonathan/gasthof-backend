<?php
    require_once 'database.php';
    $message = "";

    if ($_POST && isset($_POST["update"])) {
        $userData = [
            "id_country" => $_POST["prefix"],
            "id_user_type" => 1,
            "usr" => $_POST["usr"],
            "email" => $_POST["email"],
            "name" => $_POST["name"],
            "lastname" => $_POST["lastname"],
            "phone" => $_POST["phone"],
        ];
    
        //verify if password exist
        if (!empty($_POST["confirmed-pwd"])) {
            ////new password hash
            $pass = password_hash($_POST["confirmed-pwd"], PASSWORD_DEFAULT, ['cost' => 12]);
            $userData["pwd"] = $pass;
        }
    
        //update user info
        $database->update("tb_users", $userData, ["id_user" => $_POST["id"]]);
    
        $message = "User information updated successfully!";
    }

    // Reference: https://medoo.in/api/select
    $countries = $database->select("tb_countries","*");

    function getUser($database){
        $userId = $_SESSION["user_id"];

        $users = $database->select("tb_users", [
            "[>]tb_countries" => ["id_country" => "id_country"]
        ], [
            "tb_users.id_user",
            "tb_users.usr",
            "tb_users.email",
            "tb_users.pwd",
            "tb_users.name",
            "tb_users.lastname",
            "tb_users.phone",
            "tb_countries.id_country",
            "tb_countries.country_name",
            "tb_countries.country_nicename",
            "tb_countries.country_phonecode",
        ], [
            "tb_users.id_user" => $userId,
        ]);

        return $users;
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account - Gathof</title>
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
                    <a class="btn order" href="">Addresses</a>
                    <a class="btn order" href="wishlist.php">My Wishlist</a>
                    <a class="btn order" href="logout.php">Log Out</a>
                </div>

                <div class="account-orders-container">
                    <table class="order-table">
                        <thead>
                            <tr>
                                <th class="dish-title">Order</th>
                                <th class="dish-title">Date</th>
                                <th class="dish-title">Order Type</th>
                                <th class="dish-title">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí puedes agregar filas con los datos específicos -->
                            <tr>
                                <td class="dish-type">1</td>
                                <td class="dish-type">2023-12-04</td>
                                <td class="dish-type">Online</td>
                                <td class="dish-type">$50.00</td>
                            </tr>
                            <tr>
                                <td class="dish-type">2</td>
                                <td class="dish-type">2023-12-05</td>
                                <td class="dish-type">In-store</td>
                                <td class="dish-type">$75.00</td>
                            </tr>
                            <!-- Agrega más filas según sea necesario -->
                        </tbody>
                    </table>
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