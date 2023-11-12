<?php
    //var_dump($_POST);
    /*

    */
    require_once '../database.php';
    // Reference: https://medoo.in/api/insert
    if($_POST){
        $database->insert("tb_users",[
            "usr"=> $_POST["usr"],
            "pwd"=> $_POST["pwd"],
            "email"=> $_POST["email"],
            "name"=> $_POST["name"],
            "lastname"=> $_POST["lastname"]
        ]);
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gasthof-Add Users</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
</head>
<body>
<div class="main-container">
    <img src="../imgs/gasthof-logo.webp" alt="Gathof Logo">
    <h2>Add New User</h2>
    <div class="container">   
            <form method="post" action="add-users.php">
                <div class="form-items">
                    <label for="name">Name</label>
                    <input id="name" class="textfield" name="name" type="text">
                </div>
                <div class="form-items">
                    <label for="lastname">Last name</label>
                    <input id="lastname" class="textfield" name="lastname" type="text">
                </div>
                <div class="form-items">
                    <label for="usr">Username</label>
                    <input id="usr" class="textfield" name="usr" type="text">
                </div>
                <div class="form-items">
                    <label for="email">Email</label>
                    <input id="email" class="textfield" name="email" type="text">
                </div>
                <div class="form-items">
                    <label for="pwd">Password</label>
                    <input id="pwd" class="textfield" name="pwd" type="password">
                </div>
                <div class="form-items">
                    <input class="submit-btn" type="submit" value="Add new user">
                </div>
            </form>
        </div>
</div>    
</body>
</html>