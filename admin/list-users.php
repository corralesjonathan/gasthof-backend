<?php 
    require_once '../database.php';
    // Reference: https://medoo.in/api/select
    $users = $database->select("tb_users","*");  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gasthof-Users List</title>
    <link rel="stylesheet" href="../css/themes/admin.css">
</head>
<body>
    <div class="main-container">
<img src="../imgs/gasthof-logo.webp" alt="Gathof Logo"> 
    <h2 style='color: #333333'>Registered Users</h2>
    <table>
        <thead>
            <tr style='background: #9d1310; height: 30px'>
                <td style='color: #ffffff'>Name</td>
                <td style='color: #ffffff'>Lastname</td>
                <td style='color: #ffffff'>Username</td>
                <td style='color: #ffffff'>Email</td>
                <td style='color: #ffffff'>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                for($i=0; $i<count ($users); $i++){
                echo "<tr style='background: #f7f7f7'>";
                echo "<td style='padding-right: 40px'>".$users[$i]["name"]."</td>";
                echo "<td style='padding-right: 40px'>".$users[$i]["lastname"]."</td>";
                echo "<td style='padding-right: 40px'>".$users[$i]["usr"]."</td>";
                echo "<td style='padding-right: 40px'>".$users[$i]["email"]."</td>";
                echo "<td style='padding-right: 40px'><a style='color: #333; text-decoration:none' href='edit-users.php?id=".$users[$i]["id_user"]."'> 
                Edit </a> <a style='color: #9d1310; text-decoration:none' href='delete-user.php?id=".$users[$i]["id_user"]."'>Delete</a></td>";
                echo "</tr>";
            };
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>