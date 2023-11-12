<?php 
    require_once 'database.php';

    $categories = $database->select("tb_dishes",[
        "[>]tb_dishes_sizes"=>["id_dish_size" => "id_dish_size"],
        "[>]tb_dishes_categories"=>["id_dish_category" => "id_dish_category"]
    ],[
        "tb_dishes.id_dish",
        "tb_dishes.dish_name",
        "tb_dishes.dish_description",
        "tb_dishes.dish_price",
        "tb_dishes.dish_image",
        "tb_dishes.featured",
        "tb_dishes_sizes.id_dish_size",
        "tb_dishes_sizes.dish_size_name",
        "tb_dishes_categories.id_dish_category",
        "tb_dishes_categories.dish_category_name",
    ],[
        //where to show featured dishes only
    "tb_dishes_categories.id_dish_category" => 4
    ]);

    if ($_GET){
        $dish = $database->select("tb_dishes",[
            "[>]tb_dishes_sizes"=>["id_dish_size" => "id_dish_size"],
            "[>]tb_dishes_categories"=>["id_dish_category" => "id_dish_category"]
        ],[
            "tb_dishes.id_dish",
            "tb_dishes.dish_name",
            "tb_dishes.dish_description",
            "tb_dishes.dish_price",
            "tb_dishes.dish_image",
            "tb_dishes.featured",
            "tb_dishes_sizes.id_dish_size",
            "tb_dishes_sizes.dish_size_name",
            "tb_dishes_categories.dish_category_name",
        ],[
            "id_dish"=>$_GET["id"]
        ]); 
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish</title>
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <!--fonts-->
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <header>
        <?php 
            include './parts/navigation.php'
        ?>
    </header>

    <main>
        <!--single dish-->
        <?php 
            echo "<div class='dish-container'>"
                ."<div class='dish-img-container'>"
                    ."<img class='dish-img' src='./imgs/dishes/".$dish[0]["dish_category_name"]."/".$dish[0]["dish_image"]."' alt=".$dish[0]["dish_name"].">"
                ."</div>"
                ."<div class='dish-info-container'>"
                    ."<div class='language-btn-container'>"
                        ."<button id='btnEN' class='btn order'>EN</button>"
                        ."<button id='btnDE' class='btn order'>DE</button>"
                    ."</div>"
                    ."<div class='dish-title-container'>"
                        ."<h2 id='dish-title' class='single-dish-title dish-title'>".$dish[0]["dish_name"]."</h2>"
                        ."<img src='./imgs/icons/star.svg' alt='Star'>"
                    ."</div>"
                    ."<p id='dish-category' class='dish-type'>".$dish[0]["dish_category_name"]."</p>"
                    ."<p id='dish-price' class='single-dish-price dish-price'>$".$dish[0]["dish_price"]."</p>"
                    ."<p id='dish-description' class='dish-type slide-description'>".$dish[0]["dish_description"]."</p>";
                    if ($dish[0]["id_dish_size"] == 1){
                        echo "<img src='./imgs/icons/individual.svg' alt=".$dish[0]["dish_size_name"].">";
                    } else if ($dish[0]["id_dish_size"] == 2){
                        echo "<img src='./imgs/icons/couple.svg' alt=".$dish[0]["dish_size_name"].">";
                    } else {
                        echo "<img src='./imgs/icons/family.svg' alt=".$dish[0]["dish_size_name"].">";
                    }
                    echo "<div class='add-cart-container'>"
                        ."<input class='quantity' type='number' id='quantity' value='1'>"
                        ."<a class='btn add-cart' href='#'>ADD TO CART</a>"
                    ."</div>"
                ."</div>"
            ."</div>";
        ?>
        <!--single dish-->

        <!--related dishes-->
        <div class="dishes-main-container">
            <div class="home-titles-container">
                <h3 class="home-title1">discover</h3>
                <h2 class="home-title2">related dishes</h2>
            </div>
            <div class="dishes-container">
                <?php 
                foreach($categories as $category){
               echo "<section class='dish-card'>"
                    ."<img src='./imgs/dishes/".$category["dish_category_name"]."/".$category["dish_image"]."' alt=".$category["dish_name"]." class='dish-card-img'>"
                    ."<div class='dish-data-container'>"
                        ."<div>"
                            ."<h2 class='dish-title'>".$category["dish_name"]."</h2>"
                            ."<p class='dish-type'>".$category["dish_category_name"]."</p>"
                        ."</div>"
                        ."<a href='#'><img src='./imgs/icons/cart.svg' alt='Cart'></a>"
                    ."</div>"
                    ."<p class='dish-price'>$5.90</p>"
                    ."<a class='btn order' href=''>Order</a>"
                ."</section>";
                }
                ?>
            </div>
        </div>
        <!--related dishes-->

        <!--subscribe form-->
        <?php 
            include './parts/subscribe-form.php'
        ?>
        <!--subscribe form-->
    </main>

    <footer>
        <?php 
            include './parts/footer.php'
        ?>
    </footer>
    
    <!--code to change dish data language-->
    <script>
    //get elements by id
    let btnEN = document.getElementById("btnEN");
    let btnDE = document.getElementById("btnDE");

    //add "click" event to change the language of the dish description to German
    btnDE.addEventListener("click", () => {
        document.getElementById("dish-title").innerHTML = "KARTOFFELPUFFER";
        document.getElementById("dish-category").innerHTML = "Starthilfe";
        document.getElementById("dish-price").innerHTML = "€6.52";
        document.getElementById("dish-description").innerHTML =
            "Kartoffelpuffer sind flach gebratene Pfannkuchen aus geriebenen oder gemahlenen Kartoffeln," +
            "Matzenmehl und einer bindenden Zutat wie Ei oder Apfelmus, oft gewürzt mit geriebenem Knoblauch oder Zwiebeln und Gewürzen.";
    })

    //add "click" event to change the language of the dish description to English
    btnEN.addEventListener("click", () => {
        document.getElementById("dish-title").innerHTML = "KARTOFFELPUFFER";
        document.getElementById("dish-category").innerHTML = "Starter";
        document.getElementById("dish-price").innerHTML = "$6.90";
        document.getElementById("dish-description").innerHTML =
            "Potato Pancakes Are Shallow Fried Pancakes Of Grated Or Ground Potato," +
            "Matzo Meal, And A Binding Ingredient Such As Egg Or Applesauce, Often Flavored With Grated Garlic Or Onion And Seasonings.";
    })
    </script>
</body>

</html>