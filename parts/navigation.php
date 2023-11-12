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
                <li><a id="btnMenu" class="nav-list-link" href="menu.php">Menu</a></li>
                <li><a id="btnContact" class="nav-list-link" href="contact.html">Contact</a></li>
                <li><a id="btnAboutUs" class="nav-list-link" href="#">About Us</a></li>
            </ul>
        </div>
        <!--nav menu & mobile btn-->

        <!--nav icons-->
        <div class="icons_container">
            <a class="search-icon" href="#"><img src="./imgs/icons/search-icon.svg" alt="Search"></a>
            <a class="user-icon" href="#" id="account-icon"><img src="./imgs/icons/user.svg" alt="Account"></a>
            <a class="bag-icon" href="#"><img src="./imgs/icons/bag.svg" alt="Bag"></a>
            <!-- Menú de cuenta -->
            <div id="account-menu">
            <ul class="nav-list account-list">
                <?php 
                    session_start();
                    if(isset($_SESSION["isLoggedIn"])){
                        echo "<li><a class='nav-list-link account-nav-list-link'>Hola, ".$_SESSION["fullname"]."</a></li>";
                        echo "<li><a class='nav-list-link account-nav-list-link' href='account.php'>My account</a></li>";
                        echo "<li><a class='nav-list-link account-nav-list-link' href='logout.php'>log out</a> <a href='logout.php'><img src='./imgs/icons/logout.svg' alt='Logout'></a></li>";
                    }else{
                        echo "<li><a class='nav-list-link account-nav-list-link' href='login.php'>My account</a></li>";
                        echo "<li><a class='nav-list-link account-nav-list-link' href='login.php'>login</a></li>";
                    }
                ?>
            </ul>
            </div>

        </div>

        <!--nav icons-->
    </nav>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let accountIcon = document.getElementById("account-icon");
    let accountMenu = document.getElementById("account-menu");

    // Mostrar/ocultar el menú de cuenta al hacer clic en el icono de cuenta
    accountIcon.addEventListener("mouseover", function() {
        accountMenu.classList.add("visible");
    })

    accountMenu.addEventListener("mouseover", function() {
        accountMenu.classList.add("visible");
    })

    accountMenu.addEventListener("mouseout", function() {
        accountMenu.classList.remove("visible");
    })

});
</script>

<script src="./js/mobileNavMenu.js"></script>
<script src="./js/navMenu.js"></script>