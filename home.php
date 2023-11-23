<?php 
    require_once 'database.php';
    // Reference: https://medoo.in/api/select
    // tb_dishes and tb_categories JOIN
    $dishes = $database->select("tb_dishes", [
        "[>]tb_dishes_categories" => ["id_dish_category" => "id_dish_category"]
    ], [
        "tb_dishes.id_dish",
        "tb_dishes.dish_name",
        "tb_dishes.dish_description",
        "tb_dishes.dish_image",
        "tb_dishes.dish_price",
        "tb_dishes.featured",
        "tb_dishes_categories.id_dish_category",
        "tb_dishes_categories.dish_category_name" 
    ], [
        //where to show featured dishes only
        "tb_dishes.featured" => 1 
    ]);
    
    function getWishlist($database, $id_dish) {
        $userId = $_SESSION["user_id"];
    
        // Obtén la información de la wishlist para un platillo específico y un usuario específico
        $wishlist = $database->select("tb_wishlist", [
            "[>]tb_dishes" => ["id_dish" => "id_dish"],
            "[>]tb_users" => ["id_user" => "id_user"],
            "[>]tb_dishes_categories" => ["tb_dishes.id_dish_category" => "id_dish_category"],
        ], [
            "tb_wishlist.id_wishlist",
            "tb_dishes.id_dish",
            "tb_dishes.dish_name",
            "tb_dishes.dish_image",
            "tb_dishes.dish_price",
            "tb_users.id_user",
            "tb_dishes_categories.dish_category_name"
        ], [
            "tb_wishlist.id_user" => $userId,
            "tb_wishlist.id_dish" => $id_dish,
        ]);
    
        return $wishlist;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Gasthof</title>
    <!--favicon-->
    <link rel="icon" href="./imgs/icons/favicon.svg" type="image/x-icon">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <!--fonts-->
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <!--header & hero-->
    <header> <?php include './parts/header.php'?> </header>
    <!--header & hero-->

    <!--main content-->
    <main>
        <!--featured dishes-->
        <div class="dishes-main-container">
            <div class="home-titles-container">
                <h3 class="home-title1">discover our</h3>
                <h2 class="home-title2">featured dishes</h2>
            </div>
            <div class="dishes-container">
                <?php
                        foreach ($dishes as $dish) {
                            echo "<section class='dish-card'>"
                            ."<div class='card-img-container'>"
                            ."<a class='dish-card-link' href='dish.php?id=".$dish["id_dish"]."'>"
                                    ."<img src='./imgs/dishes/".$dish["dish_category_name"]."/".$dish["dish_image"]."' alt=".$dish["dish_name"]." class='dish-card-img'>"
                                    ."</a>";
                                    if(isset($_SESSION["isLoggedIn"])){
                                        $wishlist = getWishlist($database, $dish["id_dish"]);
                                        if(!empty($wishlist)){
                                            echo "<a id='like'  onclick='removeFromWishlist(".$wishlist[0]["id_wishlist"].")'><img class='like-icon' src='./imgs/icons/like-fill.svg'></a>";
                                        }else{
                                            echo "<a id='like'  onclick='addToWishlist(".$dish["id_dish"].", ".$_SESSION["user_id"].")'><img class='like-icon' src='./imgs/icons/like.svg'></a>";
                                        }
                                    }else{
                                        echo "<a href='login.php' id='like'><img id='like-icon' src='./imgs/icons/like.svg'></a>";   
                                    }
                                    echo"</div>"
                                    ."<div class='dish-data-container'>"
                                        ."<div class='dish-texts-container'>"
                                        ."<a class='a-titles' href='dish.php?id=".$dish["id_dish"]."'>"
                                            ."<h2 class='dish-title'>".$dish["dish_name"]."</h2>"
                                            ."</a>"
                                            ."<p class='dish-type'>".$dish["dish_category_name"]."</p>"
                                        ."</div>"
                                        ."<a href='#'><img src='./imgs/icons/cart.svg' alt='Cart'></a>"
                                    ."</div>"
                                    ."<p class='dish-price'>$".$dish["dish_price"]."</p>"
                                    ."<a class='btn order' href='dish.php?id=".$dish["id_dish"]."'>Order</a>"
                            ."</section>";
                        }
                    ?>
            </div>
            <a href="menu.php" class="btn view-all">view all</a>
        </div>
        <!--featured dishes-->

        <!--beers slider-->
        <?php include './parts/beer-slider.php'?>
        <!--beers slider-->

        <!--about restaurant section-->
        <?php include './parts/about-us.php'?>
        <!--about restaurant section-->

        <!--subscribe form-->
        <?php include './parts/subscribe-form.php'?>
        <!--subscribe form-->
    </main>
    <!--main content-->

    <!--footer-->
    <footer> <?php include './parts/footer.php'?> </footer>
    <!--footer-->

    <!--script-->
    <script>
    function addToWishlist(id_dish, id_user) {
        console.log(id_dish, id_user);
        
        let info = {
            id_dish: id_dish,
            id_user: id_user
        };

        //fetch
        fetch("http://localhost/gasthof-backend/add-to-wishlist.php", {
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
                window.location.href = "http://localhost/gasthof-backend/wishlist.php";
            })
            .catch(err => console.log("error: " + err));

    }
    function removeFromWishlist(id_wishlist) {
            console.log(id_wishlist);

            let info = {
                id_wishlist: id_wishlist,
            };

            // Fetch
            fetch("http://localhost/gasthof-backend/remove-from-wishlist.php", {
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
                    location.reload();
                    console.log(data);
                })
                .catch(err => console.log("Error al enviar la solicitud: " + err));
        }
    </script>
    <!--script-->
</body>
</html>