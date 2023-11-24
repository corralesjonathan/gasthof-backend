<?php 
    require_once 'database.php';
    $message = "";
    $messageLogin = "";

    // Reference: https://medoo.in/api/select
    $countries = $database->select("tb_countries","*");

    if ($_POST){

        if(isset($_POST["login"])){
            $user = $database->select("tb_users", "*",[
                "usr"=>$_POST["usr"]
            ]);

            if (count($user) > 0){
                if (password_verify($_POST["pwd"], $user[0]["pwd"])){
                    session_start();
                    $_SESSION["isLoggedIn"] = true;
                    $_SESSION["fullname"] = $user[0]["name"];
                    //this session variable stores the user id
                    $_SESSION["user_id"] = $user[0]["id_user"];
                    header("location: home.php");
                } else {
                    $messageLogin = "wrong username or password";
                }
            } else {
                $messageLogin = "wrong username or password";
            }
        }

        if(isset($_POST["signup"])){
            //validate if user already registered
            $validateUsername = $database->select("tb_users", "*",[
                "usr"=>$_POST["usr"]
            ]);

            if(count($validateUsername) > 0){
                $message = "This username is already registered";
            }else{
                $pass = password_hash($_POST["pwd"], PASSWORD_DEFAULT, ['cost'=>12]);
                $database->insert("tb_users",[
                    "id_country" => $_POST["prefix"],
                    "usr" => $_POST["usr"],
                    "email" => $_POST["email"],
                    "pwd" => $pass,
                    "name" => $_POST["name"],
                    "lastname" => $_POST["lastname"],
                    "phone" => $_POST["phone"],
                ]);
                //  header("location: book.php?id=".$_POST["register"]);
            }
        }

        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gathof</title>
    <!--favicon-->
    <?php include './parts/favicon.php'?>
    <!--fonts-->
    <?php include './parts/fonts.php'?>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <!--header-->
    <header>
        <!--nav-->
        <?php 
            include './parts/navigation.php'; 
        ?>
        <!--nav-->
    </header>
    <!--header-->
    <main>
        <div class="login-container">
            <div class="login">
                <div class="home-titles-container login-titles-container">
                    <h3 class="home-title1">login to</h3>
                    <h2 class="home-title2">your account</h2>
                </div>
                <form class="contact-form" method="post" action="login.php">
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts" for="usr">Username</label>
                        <input id="usr" class="contact-input" name="usr" type="text">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts" for="pwd">Password</label>
                        <input id="pwd" class="contact-input" name="pwd" type="password">
                    </div>
                    <input class="btn view-all" type="submit" value="LOGIN">
                    <p>
                        <?php 
                            echo $messageLogin;   
                        ?>
                    </p>
                    <input type="hidden" name="login" value="1">
                </form>
            </div>
            <div class="sing-up">
                <div class="home-titles-container login-titles-container">
                    <h3 class="home-title1">need</h3>
                    <h2 class="home-title2">an account?</h2>
                </div>
                <form class="contact-form" method="post" action="login.php" enctype="multipart/form-data">
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts" for="usr">Username</label>
                        <input id="usr" class="contact-input" name="usr" type="text">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts" for="email">Email</label>
                        <input id="email" class="contact-input" name="email" type="Email">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts" for="pwd">Password</label>
                        <input id="pwd" class="contact-input" name="pwd" type="password">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts" for="name">Name</label>
                        <input id="name" class="contact-input" name="name" type="text">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts" for="lastname">Lastname</label>
                        <input id="lastname" class="contact-input" name="lastname" type="text">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts" for="phone">Phone</label>
                        <div class="phone-inputs">
                            <select class="contact-input prefix" name="prefix" id="prefix">
                                <?php 
                                    foreach ($countries as $coutry){
                                        echo "<option value=".$coutry["id_country"].">".$coutry["country_nicename"]." +".$coutry["country_phonecode"]."</option>"; 
                                    }
                                ?>
                            </select>
                            <input id="phone" class="contact-input tel" name="phone" type="tel">
                        </div>
                    </div>
                    <input class="btn view-all" type="submit" value="SIGN UP">
                    <p>
                        <?php 
                            echo $message;
                        ?>
                    </p>
                    <input type="hidden" name="signup" value="1">
                </form>
            </div>
        </div>
    </main>

    <footer>
        <?php 
            include './parts/footer.php'; 
        ?>
    </footer>

</body>

</html>