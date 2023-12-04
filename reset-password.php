<?php
require_once 'database.php';

$message = "";
$messageLogin = "";
$newPasswordMessage = "";
$newPassword = "";

if ($_POST) {
    if (isset($_POST["login"])) {
        $username = $_POST["usr"];

        // Verify if user exists
        $user = $database->select("tb_users", [
            "[>]tb_user_type" => ["id_user_type" => "id_user_type"]
        ], [
            "tb_users.id_user",
            "tb_users.usr",
            "tb_users.email",
            "tb_users.pwd",
            "tb_users.name",
            "tb_users.lastname",
            "tb_users.phone",
            "tb_user_type.id_user_type",
            "tb_user_type.user_type_name"
        ], [
            "tb_users.usr" => $username
        ]);

        if (count($user) > 0) {
            // Create a random password
            $newPassword = generateRandomPassword();

            // Update password in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $database->update("tb_users", ["pwd" => $hashedPassword], ["usr" => $username]);

            /*
            // Send new password via email
            $to = $user[0]["email"];
            $subject = "Password Reset";
            $message = "Your new password is: $newPassword";
            $headers = "From: corralesrjonathan@gmail.com"; // Gmail address

            // Code to send an email
            mail($to, $subject, $message, $headers);
            */

            // Start session automatically with the new password
            session_start();
            $_SESSION["isLoggedIn"] = true;
            $_SESSION["fullname"] = $user[0]["name"];
            $_SESSION["user_id"] = $user[0]["id_user"];

            // Message to show the new password
            $newPasswordMessage = "Password reset successful. You are now logged in.";
        } else {
            // Message if the user wasn't found
            $messageLogin = "Wrong username";
        }
    }
}

// Function to generate a random password
function generateRandomPassword($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_+=<>?';
    $randomPassword = '';

    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomPassword;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Gathof</title>
    <!-- Favicon -->
    <?php include './parts/favicon.php' ?>
    <!-- Fonts -->
    <?php include './parts/fonts.php' ?>
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <!-- Header -->
    <header>
        <!-- Navigation -->
        <?php include './parts/navigation.php'; ?>
        <!-- Navigation -->
    </header>
    <!-- Header -->

    <!--main content-->
    <main>
        <div class="login-container">
            <div class="login">
                <div class="home-titles-container login-titles-container">
                    <h3 class="home-title1">reset</h3>
                    <h2 class="home-title2">your password</h2>
                </div>
                <form class="contact-form reset-pass-form" method="post" action="reset-password.php">
                    <h2 class="dish-title">Please enter your username</h2>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts" for="usr">Username</label>
                        <input id="usr" class="contact-input" name="usr" type="text">
                    </div>
                    <input class="btn view-all" type="submit" value="RESET">
                        <?php
                        if (!empty($newPasswordMessage)) {
                            echo "<div id='cart-popup' class='show-cart-popup'>"
                                . "<h2 class='slide-title dish-title'>Password reset successful</h2>"
                                . "<p class='dish-type slide-description'>Your new password: <b>$newPassword</b></p>"
                                . "<p class='dish-type slide-description'>You can change your password <a class='dish-type slide-description add-address' href='account.php'>here</a></p>"
                                . "<a class='btn view-all' href='home.php'>go home</a></div>";
                        }
                        ?>
                    <input type="hidden" name="login" value="1">
                </form>
            </div>
        </div>
    </main>
    <!--main content-->
    <!--footer-->
    <footer>
        <?php include './parts/footer.php'; ?>
    </footer>
    <!--footer-->
</body>

</html>
