<?php
    require_once 'database.php';
    $message = "";

    if ($_POST){
        if(isset($_POST["update"])){
            //validate if user already registered
            $validateUsername = $database->select("tb_users", "*",[
                "usr"=>$_POST["usr"]
            ]);

            if(count($validateUsername) > 0){
                $message = "This username is already registered";
            }else{
                $pass = password_hash($_POST["confirmed-pwd"], PASSWORD_DEFAULT, ['cost'=>12]);
                $database->update("tb_users",[
                    "id_country" => $_POST["prefix"],
                    "id_user_type" => 1,
                    "usr" => $_POST["usr"],
                    "email" => $_POST["email"],
                    "pwd" => $pass,
                    "name" => $_POST["name"],
                    "lastname" => $_POST["lastname"],
                    "phone" => $_POST["phone"],
                ], [
                    "id_user" => $_POST["id"],
                ]);
            }
        }
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
                    <a href="">Account details  </a>
                    <a href="">Orders</a>
                    <a href="">Addresses</a>
                    <a href="">My Wishlist</a>
                    <a href="">Log Out</a>
                </div>

                <div class="account-data-container">
                    <div class="login">
                <?php
                    $users = getUser($database); 
                    echo "<form class='contact-form' method='post' action='account.php'>"
                        //Name
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='name'>Name</label>"
                        ."<input id='name' class='contact-input' name='name' type='text' value='".$users[0]["name"]."'>"   
                        ."</div>"
                        //Lastname
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='lastname'>Lastname</label>"
                        ."<input id='lastname' class='contact-input' name='lastname' type='text' value='".$users[0]["lastname"]."'>"
                        ."</div>"
                        //Username
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='usr'>Username</label>"
                        ."<input id='usr' class='contact-input' name='usr' type='text' value='".$users[0]["usr"]."'>"
                        ."</div>"
                        //Email
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='email'>Email</label>"
                        ."<input id='email' class='contact-input' name='email' type='text' value='".$users[0]["email"]."'>"
                        ."</div>"
                        //Phone
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='phone'>Phone</label>"
                        ."<div class='phone-inputs'>"
                        ."<select class='contact-input prefix' name='prefix' id='prefix'>";
                        foreach ($countries as $country) {
                           //check if the country matches the user
                            $selected = ($country["id_country"] == $users[0]["id_country"]) ? "selected" : "";
                            echo "<option value='" . $country["id_country"] . "' " . $selected . ">" . $country["country_nicename"] . " +".$country["country_phonecode"]." </option>";
                        }
                        echo "</select>"
                        ."<input id='phone' class='contact-input tel' name='phone' type='tel' value='".$users[0]["phone"]."'>"
                        ."</div>"
                        ."</div>"
                        //Change password
                        //New password
                        ."<div class='form-items login-form-items'>"
                        ."<h3 class='nav-footer-link contact-texts'><b>Change password</b></h3>"
                        ."<label class='nav-footer-link contact-texts' for='new-pdw'>New password</label>"
                        ."<input oninput='getNewPassword()' id='new-pdw' class='contact-input' name='new-pdw' type='password'>"
                        ."</div>"
                        //New password confirmation
                        ."<div class='form-items login-form-items'>"
                        ."<label class='nav-footer-link contact-texts' for='confirmed-pwd'>Confirm new password</label>"
                        ."<input oninput='getConfirmedPassword()' id='confirmed-pwd' class='contact-input' name='confirmed-pwd' type='password'>"
                        ."</div>"
                        //Passwords don't match message
                        ."<p id=pwd-message class='dish-type'></p>"
                        //User id
                        ."<input name='id' type='hidden' value='".$users[0]["id_user"]."'>"
                        //Submit
                        ."<input class='btn view-all' type='submit' value='Save Changes'>"
                        ."<input type='hidden' name='update' value='1'>"
                    ."</form>";
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