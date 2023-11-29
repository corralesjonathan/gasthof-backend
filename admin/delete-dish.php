<?php 
    require_once '../database.php';
    // Reference: https://medoo.in/api/where
    if($_GET){
        $data = $database->select("tb_dishes","*",[
            "id_dish"=>$_GET["id"]
        ]);
    }

    if($_POST){
        // Reference: https://medoo.in/api/delete
        $database->delete("tb_dishes",[
            "id_dish"=>$_POST["id"]
        ]);

        header("location: list-dishes.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Dish</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
</head>
<body>
    <h2>Delete Dish: <?php echo $data[0]["dish_name"]; ?></h2>
    <form method="post" action="delete-dish.php">
        <input name="id" type="hidden" value="<?php echo $data[0]["id_dish"]; ?>">
        <input style="padding: .5rem;" class="submit-btn-admin" type="button" onclick="history.back();" value="CANCEL">
        <input style="padding: .5rem;" class="submit-btn-admin" type="submit" value="DELETE">
    </form>
</body>
</html>