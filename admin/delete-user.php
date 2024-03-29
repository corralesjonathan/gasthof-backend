<?php 
    require_once '../database.php';
    // Reference: https://medoo.in/api/where
    if($_GET){
        $data = $database->select("tb_users","*",[
            "id_user"=>$_GET["id"]
        ]);
    }

    if($_POST){
        // Reference: https://medoo.in/api/delete
        $database->delete("tb_users",[
            "id_user"=>$_POST["id"]
        ]);

        header("location: list-users.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
</head>
<body>
    <h2>Delete User: <?php echo $data[0]["usr"]; ?></h2>
    <form method="post" action="delete-user.php">
        <input name="id" type="hidden" value="<?php echo $data[0]["id_user"]; ?>">
        <input style="padding: .5rem;" class="submit-btn-admin" type="button" onclick="history.back();" value="CANCEL">
        <input style="padding: .5rem;" class="submit-btn-admin" type="submit" value="DELETE">
    </form>
</body>
</html>