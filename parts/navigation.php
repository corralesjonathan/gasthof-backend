<?php 
    require_once './database.php';

    // Reference: https://medoo.in/api/select
    $categories = $database->select("tb_dishes_categories",[
        "tb_dishes_categories.id_dish_category",
        "tb_dishes_categories.dish_category_name",
    ]);
?>

<?php 
        include 'parts/floating-widgets.php'
?>

<div class="top-nav-container">
    <nav class="top-nav">
        <button id="mobile-open-btn"> <img src="./imgs/icons/mobile-btn.svg" alt="Mobile button"></button>
        <div class="website-logo-container">
            <img src="./imgs/icons/website-logo.svg" alt="Gasthof logo" class="website-logo">
        </div>
        <!--nav menu & mobile btn-->
        <div id="nav-container">
            <button id="mobile-close-btn"><img src="./imgs/icons/close.svg" alt=""></button>
            <ul class="nav-list">
                <li><a id="btnHome" class="nav-list-link" href="home.php">Home</a></li>
                <li><a id="btnMenu" class="nav-list-link" href="menu.php">Menu +</a>
                    <div id="dropdown-content">
                        <?php 
                        echo "<a class='nav-list-link' href='starters.php'>".$categories[0]["dish_category_name"]."</a>"
                        ."<a class='nav-list-link' href='main-courses.php'>".$categories[1]["dish_category_name"]."</a>"
                        ."<a class='nav-list-link' href='desserts.php'>".$categories[2]["dish_category_name"]."</a>"
                        ."<a class='nav-list-link' href='drinks.php'>".$categories[3]["dish_category_name"]."</a>";
                        ?>
                    </div>
                </li>
                <li><a id="btnContact" class="nav-list-link" href="contact.html">Contact</a></li>
                <li><a id="btnAboutUs" class="nav-list-link" href="#">About Us</a></li>
            </ul>
        </div>
        <!--nav menu & mobile btn-->

        <!--nav icons-->
       
            <ul class="icons_container">
                <li><a class="search-icon" href="#"><img src="./imgs/icons/search-icon.svg" alt="Search"></a></li>
                <li><a id="user-icon"  id="account-icon"><img src="./imgs/icons/user.svg" alt="Account"></a>
                    <div id="account-menu">
                        <ul class="nav-list account-list">
                            <?php 
                                session_start();
                                if(isset($_SESSION["isLoggedIn"])){
                                    echo "<li><a class='nav-list-link account-nav-list-link'>Hi, <b>".$_SESSION["fullname"]."!</b></a></li>";
                                    echo "<li><a class='nav-list-link account-nav-list-link' href='account.php'>My account</a></li>";
                                    echo "<li><a class='nav-list-link account-nav-list-link' href='wishlist.php'>Wishlist</a></li>";
                                    echo "<li><a class='nav-list-link account-nav-list-link' href='logout.php'>log out</a> <a href='logout.php'><img src='./imgs/icons/logout.svg' alt='Logout'></a></li>";
                                }else{
                                    echo "<li><a class='nav-list-link account-nav-list-link' href='login.php'>My account</a></li>";
                                    echo "<li><a class='nav-list-link account-nav-list-link' href='login.php'>login</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                </li>
                <li><a class="bag-icon" href="#"><img src="./imgs/icons/bag.svg" alt="Bag"></a></li>
      
        
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
    close.addEventListener("click", () =>{
        nav.classList.remove("visible");
    })
</script>

<script>
//nav-menu
function selectedPage() {
    //get buttons by id
    let btnHome = document.getElementById('btnHome');
    let btnMenu = document.getElementById('btnMenu');
    let btnContact = document.getElementById('btnContact');
    let btnAboutUs = document.getElementById('btnAboutUs');

    //get currently url
    let url = window.location.href;

    //check url
    if (url.includes("home.php")) {
        btnHome.classList.add("active");
    } else if (url.includes("menu.php")) {
        btnMenu.classList.add("active");
    } else if (url.includes("contact.html")) {
        btnContact.classList.add("active");
    } else if (url.includes("aboutUs.html")) {
        btnAboutUs.classList.add("active");
    }
}
//main loading
document.addEventListener("DOMContentLoaded", function () {
    selectedPage();
});
</script>