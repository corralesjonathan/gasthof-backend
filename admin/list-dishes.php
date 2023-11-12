<?php 
    require_once '../database.php';
    // Reference: https://medoo.in/api/select
    $dishes = $database->select("tb_dishes",[
        "[>]tb_dishes_categories" => ["id_dish_category" => "id_dish_category"],
        "[>]tb_dishes_sizes" => ["id_dish_size" => "id_dish_size"]
    ], [
        "tb_dishes.id_dish", 
        "tb_dishes.dish_name",
        "tb_dishes.dish_name_de",
        "tb_dishes.dish_description",
        "tb_dishes.dish_description_de",
        "tb_dishes.dish_image",
        "tb_dishes.dish_price",
        "tb_dishes.featured",
        "tb_dishes_categories.id_dish_category", 
        "tb_dishes_categories.dish_category_name",
        "tb_dishes_sizes.id_dish_size",
        "tb_dishes_sizes.dish_size_name"
    ], [

    ]);  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gasthof-Dishes List</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
</head>
<body>
    <div class="main-container">
    <img src="../imgs/gasthof-logo.webp" alt="Gathof Logo"> 
    <h2 style='color: #333333'>Registered Dishes</h2>
    <table style="width: 90vw">
        <thead>
            <tr style='background: #9d1310; height: 30px'>
                <td style='color: #ffffff'>Name</td>
                <td style='color: #ffffff'>Name - TR</td>
                <td style='color: #ffffff'>Category</td>
                <td style='color: #ffffff'>Size</td>
                <td style='color: #ffffff'>Description</td>
                <td style='color: #ffffff'>Description - TR</td>
                <td style='color: #ffffff'>Price</td>
                <td style='color: #ffffff'>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                for($i=0; $i<count ($dishes); $i++){
                echo "<tr style='background: #f7f7f7'>";
                echo "<td style='padding-right: 40px'>".$dishes[$i]["dish_name"]."</td>";
                echo "<td style='padding-right: 40px'>".$dishes[$i]["dish_name_de"]."</td>";
                echo "<td style='padding-right: 40px'>".$dishes[$i]["dish_category_name"]."</td>";
                echo "<td style='padding-right: 40px'>".$dishes[$i]["dish_size_name"]."</td>";
                echo "<td style='padding-right: 40px; max-width: 300px;'>".$dishes[$i]["dish_description"]."</td>";
                echo "<td style='padding-right: 40px; max-width: 300px;'>".$dishes[$i]["dish_description_de"]."</td>";
                echo "<td style='padding-right: 40px'>".$dishes[$i]["dish_price"]."</td>";
                echo "<td style='padding-right: 40px'><a style='color: blue; text-decoration:none' href='edit-dish.php?id=".$dishes[$i]["id_dish"]."'> 
                Edit </a> <a style='color: red; text-decoration:none' href='delete-dish.php?id=".$dishes[$i]["id_dish"]."'>Delete</a></td>";
                echo "</tr>";
            };
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>