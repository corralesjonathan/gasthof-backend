<?php 
    require_once '../database.php';

    // Reference: https://medoo.in/api/select
    $categories = $database->select("tb_dishes_categories",[
        "tb_dishes_categories.id_dish_category",
        "tb_dishes_categories.dish_category_name",
    ]);
?>

<div class="top-nav-container">
    <nav class="top-nav">
        <button id="mobile-open-btn"> <img src="../imgs/icons/mobile-btn.svg" alt="Mobile button"></button>
        <div class="website-logo-container">
            <a href="./home.php"><img src="../imgs/icons/website-logo.svg" alt="Gasthof logo" class="website-logo"></a>
        </div>
        <!--nav menu & mobile btn-->
        <div id="nav-container">
            <button id="mobile-close-btn"><img src="../imgs/icons/close.svg" alt=""></button>
            <ul class="nav-list">
                <li><a id="listDishes" class="nav-list-link" href="list-dishes.php">Dishes list</a></li>
                <li><a id="addDish" class="nav-list-link" href="add-dish.php">Add dish</a></li>
                <li><a id="listUsers" class="nav-list-link" href="list-users.php">Users list</a></li>
            </ul>
        </div>
        <!--nav menu & mobile btn-->

        <!--nav icons-->
        <ul class="icons_container">
            <li><a id="user-icon"><img class="user-img" src="../imgs/icons/user.svg" alt="Account"></a>
                <div id="account-menu">
                    <ul class="nav-list account-list">
                        <?php 
                                session_start();
                                    echo "<li><a class='nav-list-link account-nav-list-link'>Hi, <b>".$_SESSION["fullname"]."!</b></a></li>";
                                    echo "<li><a class='nav-list-link account-nav-list-link' href='../logout.php'>log out</a> <a href='logout.php'><img src='../imgs/icons/logout.svg' alt='Logout'></a></li>";
                            ?>
                    </ul>
                </div>
            </li>
</div>

<!--nav icons-->
</nav>

<script>
//mobile-nav-menu
//get elements by id
let nav = document.getElementById("nav-container");
let open = document.getElementById("mobile-open-btn");
let close = document.getElementById("mobile-close-btn");

//make nav visible
open.addEventListener("click", () => {
    nav.classList.add("visible");
})

//make nav unvisible
close.addEventListener("click", () => {
    nav.classList.remove("visible");
})
</script>

<script>
//nav-menu
function selectedPage() {
    //get buttons by id
    let listDishes = document.getElementById('listDishes');
    let addDish = document.getElementById('addDish');
    let listUsers = document.getElementById('listUsers');

    //get currently url
    let url = window.location.href;

    //check url
    if (url.includes("list-dishes.php")) {
        listDishes.classList.add("active");
    } else if (url.includes("add-dish.php")) {
        addDish.classList.add("active");
    } else if (url.includes("list-users.php")) {
        listUsers.classList.add("active");
    }
}
//main loading
document.addEventListener("DOMContentLoaded", function() {
    selectedPage();
});
</script>