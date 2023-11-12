<?php 
    require_once '../database.php';
    $users = $database->select("tb_users", [
        "[>]tb_countries" => ["id_country" => "id_country"]
    ], [
        "tb_users.id_user",
        "tb_users.usr",
        "tb_users.email",
        "tb_users.name",
        "tb_users.lastname",
        "tb_users.phone",
        "tb_countries.id_country",
        "tb_countries.country_name",
        "tb_countries.country_phonecode" 
    ]); 
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
    <h2>Registered Users</h2>
    <table>
        <thead>
            <tr class="titles-bg">
                <td class="titles-td">Name</td>
                <td class="titles-td">Lastname</td>
                <td class="titles-td">Username</td>
                <td class="titles-td">Email</td>
                <td class="titles-td">Phone</td>
                <td class="titles-td">Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                for($i=0; $i<count ($users); $i++){
                echo "<tr class='data-bg'>";
                echo "<td class='data-td'>".$users[$i]["name"]."</td>";
                echo "<td class='data-td'>".$users[$i]["lastname"]."</td>";
                echo "<td class='data-td'>".$users[$i]["usr"]."</td>";
                echo "<td class='data-td'>".$users[$i]["email"]."</td>";
                echo "<td class='data-td'>+".$users[$i]["country_phonecode"]." ".$users[$i]["phone"]."</td>";
                echo "<td><a style='color: #333; text-decoration:none' href='edit-users.php?id=".$users[$i]["id_user"]."'> 
                Edit </a> <a style='color: #9d1310; text-decoration:none' href='delete-user.php?id=".$users[$i]["id_user"]."'>Delete</a></td>";
                echo "</tr>";
            };
            ?>
        </tbody>
    </table>
    </div>
</body>
</html>