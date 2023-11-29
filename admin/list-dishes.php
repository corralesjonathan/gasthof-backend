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
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <header>
        <?php include 'navigation-admin.php'; ?>
    </header>
    <main>
        <div class="main-container">
        <h2>Registered Dishes</h2>
        <table>
            <thead>
                <tr class="titles-bg">
                    <td class="titles-td">Name</td>
                    <td class="titles-td">Name - TR</td>
                    <td class="titles-td">Category</td>
                    <td class="titles-td">Size</td>
                    <td class="titles-td">Description</td>
                    <td class="titles-td">Description - TR</td>
                    <td class="titles-td">Price</td>
                    <td class="titles-td">Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php 
                    for($i=0; $i<count ($dishes); $i++){
                    echo "<tr class='data-bg'>";
                    echo "<td class='data-td'>".$dishes[$i]["dish_name"]."</td>";
                    echo "<td class='data-td'>".$dishes[$i]["dish_name_de"]."</td>";
                    echo "<td class='data-td'>".$dishes[$i]["dish_category_name"]."</td>";
                    echo "<td class='data-td'>".$dishes[$i]["dish_size_name"]."</td>";
                    echo "<td class='data-td'>".$dishes[$i]["dish_description"]."</td>";
                    echo "<td class='data-td'>".$dishes[$i]["dish_description_de"]."</td>";
                    echo "<td class='data-td'>".$dishes[$i]["dish_price"]."</td>";
                    echo "<td ><a style='color: #333333; text-decoration:none' href='edit-dish.php?id=".$dishes[$i]["id_dish"]."'> 
                    Edit </a> <a style='color: #9d1310; text-decoration:none' href='delete-dish.php?id=".$dishes[$i]["id_dish"]."'>Delete</a></td>";
                    echo "</tr>";
                };
                ?>
            </tbody>
        </table>
        </div>
    </main>
</body>
</html>