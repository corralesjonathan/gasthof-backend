<?php
    require_once 'database.php';
    $message = "";

    if ($_POST){
        if(isset($_POST["add-address01"]) || isset($_POST["add-address02"]) ) {
            $database -> insert("tb_addresses",[
                "id_user" => $_POST["id"],
                "country" => $_POST["country"],
                "province" => $_POST["province"],
                "city" => $_POST["city"],
                "delivery_address" => $_POST["address"],
            ]);
            $message = "User information updated successfully!";
        }

        if(isset($_POST["update-address01"]) || isset($_POST["update-address02"])) {
            $database->update("tb_addresses", [
                "id_user" => $_POST["id"],
                "country" => $_POST["country"],
                "province" => $_POST["province"],
                "city" => $_POST["city"],
                "delivery_address" => $_POST["address"],
            ],[
                "id_address" => $_POST["id-address"],
            ]);

            $message = "User information updated successfully!";
        }
    }

    function getAddress($database){
        $userId = $_SESSION["user_id"];

        $addresses = $database->select("tb_addresses", [
            "[>]tb_users" => ["id_user" => "id_user"]
        ], [
            "tb_addresses.id_address",
            "tb_addresses.country",
            "tb_addresses.province",
            "tb_addresses.city",
            "tb_addresses.delivery_address",
            "tb_users.id_user",
        ], [
            "tb_users.id_user" => $userId,
        ]);

        return $addresses;
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Addresses - Gathof</title>
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
                    <a class="btn order" href="orders.php">Orders</a>
                    <a class="btn order order-focus" href="addresses.php">Addresses</a>
                    <a class="btn order" href="wishlist.php">My Wishlist</a>
                    <a class="btn order" href="logout.php">Log Out</a>
                </div>

                <div class="account-data-container">
                    <div class="addresses">
                <?php
                    $addresses = getAddress($database);
                    if(count($addresses)==1){
                        echo "<form class='contact-form' method='post' action='addresses.php'>"
                        //Country
                        ."<div class='form-items login-form-items'>"
                        ."<h3 class='nav-footer-link contact-texts'><b>Delivery address 01</b></h3>"
                        ."<label class='nav-footer-link contact-texts' for='country'>Country</label>"
                        ."<input id='country' class='contact-input' name='country' type='text' value='".$addresses[0]["country"]."'>"   
                        ."</div>"
                        //Province
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for=province'>Province</label>"
                        ."<input id='province' class='contact-input' name='province' type='text' value='".$addresses[0]["province"]."'>"
                        ."</div>"
                        //City
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='city'>City</label>"
                        ."<input id='city' class='contact-input' name='city' type='text' value='".$addresses[0]["city"]."'>"
                        ."</div>"
                        //Address
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='address'>Address</label>"
                        ."<textarea id='address' class='contact-input' name='address' cols='30' rows='5'>".$addresses[0]["delivery_address"]."</textarea>"
                        ."</div>"
                        //User id
                        ."<input name='id' type='hidden' value='".$_SESSION["user_id"]."'>"
                        //Address id
                        ."<input name='id-address' type='hidden' value='".$addresses[0]["id_address"]."'>"
                        //Submit
                        ."<input class='btn view-all' type='submit' value='Save Changes'>"
                        ."<input type='hidden' name='update-address01' value='1'>"
                    ."</form>";

                    echo "<form class='contact-form' method='post' action='addresses.php'>"
                        //Country
                        ."<div class='form-items login-form-items'>"
                        ."<h3 class='nav-footer-link contact-texts'><b>Delivery address 02</b></h3>"
                        ."<label class='nav-footer-link contact-texts' for='country'>Country</label>"
                        ."<input id='country' class='contact-input' name='country' type='text'>"   
                        ."</div>"
                        //Province
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for=province'>Province</label>"
                        ."<input id='province' class='contact-input' name='province' type='text'>"
                        ."</div>"
                        //City
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='city'>City</label>"
                        ."<input id='city' class='contact-input' name='city' type='text'>"
                        ."</div>"
                        //Address
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='address'>Address</label>"
                        ."<textarea id='address' class='contact-input' name='address' cols='30' rows='5'></textarea>"
                        ."</div>"
                        //User id
                        ."<input name='id' type='hidden' value='".$_SESSION["user_id"]."'>"
                        //Submit
                        ."<input class='btn view-all' type='submit' value='Save Changes'>"
                        ."<input type='hidden' name='add-address02' value='1'>"
                    ."</form>";
                    }

                    if(count($addresses)==2){
                        echo "<form class='contact-form' method='post' action='addresses.php'>"
                        //Country
                        ."<div class='form-items login-form-items'>"
                        ."<h3 class='nav-footer-link contact-texts'><b>Delivery address 01</b></h3>"
                        ."<label class='nav-footer-link contact-texts' for='country'>Country</label>"
                        ."<input id='country' class='contact-input' name='country' type='text' value='".$addresses[0]["country"]."'>"   
                        ."</div>"
                        //Province
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for=province'>Province</label>"
                        ."<input id='province' class='contact-input' name='province' type='text' value='".$addresses[0]["province"]."'>"
                        ."</div>"
                        //City
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='city'>City</label>"
                        ."<input id='city' class='contact-input' name='city' type='text' value='".$addresses[0]["city"]."'>"
                        ."</div>"
                        //Address
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='address'>Address</label>"
                        ."<textarea id='address' class='contact-input' name='address' cols='30' rows='5'>".$addresses[0]["delivery_address"]."</textarea>"
                        ."</div>"
                        //User id
                        ."<input name='id' type='hidden' value='".$_SESSION["user_id"]."'>"
                        //Address id
                        ."<input name='id-address' type='hidden' value='".$addresses[0]["id_address"]."'>"
                        //Submit
                        ."<input class='btn view-all' type='submit' value='Save Changes'>"
                        ."<input type='hidden' name='update-address01' value='1'>"
                    ."</form>";

                    echo "<form class='contact-form' method='post' action='addresses.php'>"
                        //Country
                        ."<div class='form-items login-form-items'>"
                        ."<h3 class='nav-footer-link contact-texts'><b>Delivery address 02</b></h3>"
                        ."<label class='nav-footer-link contact-texts' for='country'>Country</label>"
                        ."<input id='country' class='contact-input' name='country' type='text' value='".$addresses[1]["country"]."'>"   
                        ."</div>"
                        //Province
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for=province'>Province</label>"
                        ."<input id='province' class='contact-input' name='province' type='text' value='".$addresses[1]["province"]."'>"
                        ."</div>"
                        //City
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='city'>City</label>"
                        ."<input id='city' class='contact-input' name='city' type='text' value='".$addresses[1]["city"]."'>"
                        ."</div>"
                        //Address
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='address'>Address</label>"
                        ."<textarea id='address' class='contact-input' name='address' cols='30' rows='5'>".$addresses[1]["delivery_address"]."</textarea>"
                        ."</div>"
                        //User id
                        ."<input name='id' type='hidden' value='".$_SESSION["user_id"]."'>"
                        //Address id
                        ."<input name='id-address' type='hidden' value='".$addresses[1]["id_address"]."'>"
                        //Submit
                        ."<input class='btn view-all' type='submit' value='Save Changes'>"
                        ."<input type='hidden' name='update-address02' value='1'>"
                    ."</form>";
                    }
                    
                    if(count($addresses)==0){
                        echo "<form class='contact-form' method='post' action='addresses.php'>"
                        //Country
                        ."<div class='form-items login-form-items'>"
                        ."<h3 class='nav-footer-link contact-texts'><b>Delivery address 01</b></h3>"
                        ."<label class='nav-footer-link contact-texts' for='country'>Country</label>"
                        ."<input id='country' class='contact-input' name='country' type='text'>"   
                        ."</div>"
                        //Province
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for=province'>Province</label>"
                        ."<input id='province' class='contact-input' name='province' type='text'>"
                        ."</div>"
                        //City
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='city'>City</label>"
                        ."<input id='city' class='contact-input' name='city' type='text'>"
                        ."</div>"
                        //Address
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='address'>Address</label>"
                        ."<textarea id='address' class='contact-input' name='address' cols='30' rows='5'></textarea>"
                        ."</div>"
                        //User id
                        ."<input name='id' type='hidden' value='".$_SESSION["user_id"]."'>"
                        //Submit
                        ."<input class='btn view-all' type='submit' value='Save Changes'>"
                        ."<input type='hidden' name='add-address01' value='1'>"
                    ."</form>"; 
                    
                    echo "<form class='contact-form' method='post' action='addresses.php'>"
                        //Country
                        ."<div class='form-items login-form-items'>"
                        ."<h3 class='nav-footer-link contact-texts'><b>Delivery address 02</b></h3>"
                        ."<label class='nav-footer-link contact-texts' for='country'>Country</label>"
                        ."<input id='country' class='contact-input' name='country' type='text'>"   
                        ."</div>"
                        //Province
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for=province'>Province</label>"
                        ."<input id='province' class='contact-input' name='province' type='text'>"
                        ."</div>"
                        //City
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='city'>City</label>"
                        ."<input id='city' class='contact-input' name='city' type='text'>"
                        ."</div>"
                        //Address
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='address'>Address</label>"
                        ."<textarea id='address' class='contact-input' name='address' cols='30' rows='5'></textarea>"
                        ."</div>"
                        //User id
                        ."<input name='id' type='hidden' value='".$_SESSION["user_id"]."'>"
                        //Submit
                        ."<input class='btn view-all' type='submit' value='Save Changes'>"
                        ."<input type='hidden' name='add-address02' value='1'>"
                    ."</form>";
                    }
                    ?>
                        <?php
                        if (!empty($message)) {
                            echo "<div id='cart-popup' class='show-cart-popup'>"
                                ."<a href='account.php' class='close-btn-popup'><img class='close-img-popup' src='./imgs/icons/close.svg' alt='Close'></a>"
                                ."<h2 class='slide-title dish-title'>Changes saved successfullyl</h2>"
                                ."<p class='dish-type slide-description'>".$_SESSION["fullname"].", your changes have been saved successfully</p>"
                                ."<a class='btn view-all' href='addresses.php'>go back</a>"
                                ."</div>";
                        }
                        ?>
                    </div>
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

        function getNewPassword(){
            newPassword = document.getElementById("new-pdw").value;
            console.log(newPassword);
            passwordMessage();
        }

        function getConfirmedPassword(){
            confirmedPassword = document.getElementById("confirmed-pwd").value;
            console.log(confirmedPassword);
            passwordMessage();
        }

        function passwordMessage(){
            if(newPassword == confirmedPassword){
                document.getElementById("pwd-message").innerText = "";
            }else{
                document.getElementById("pwd-message").innerText = "Passwords don't match";
            }
        }
    </script>
</body>
</html>