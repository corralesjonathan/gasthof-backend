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
            <a class="user-icon" href="#"><img src="./imgs/icons/user.svg" alt="Account"></a>
            <a class="bag-icon" href="#"><img src="./imgs/icons/bag.svg" alt="Bag"></a>
        </div>
        <!--nav icons-->
    </nav>
</div>

<script src="./js/mobileNavMenu.js"></script>
<script src="./js/navMenu.js"></script>