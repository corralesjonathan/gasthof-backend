
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gasthof=Contact</title>
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <!--fonts-->
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <!--header & hero-->
    <header>
        <!--nav-->
        <?php 
            include './parts/navigation.php'
        ?>
        <!--nav-->
    <!--header & hero-->

    <main>
        <div class="dishes-main-container">
            <div class="home-titles-container">
                <h3 class="home-title1">Hello,</h3>
                <h2 class="home-title2">next destination</h2>
            </div>
            <h2 class="slide-title dish-title wish-list-title">This is your wish list</h2>
            <div class="dishes-container">
                <section class="dish-card" data-category="main-courses">
                    <img src="./imgs/dishes/Main Courses/beer-brats.jpg" alt="Schnitzel" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Schnitzel</h2>
                            <p class="dish-type">Main course</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$5.90</p>
                    <a class="btn order" href="">Order</a>
                </section>
                <section class="dish-card" data-category="main-courses">
                    <img src="./imgs/dishes/Main Courses/beer-brats.jpg" alt="Schnitzel" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Schnitzel</h2>
                            <p class="dish-type">Main course</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$5.90</p>
                    <a class="btn order" href="">Order</a>
                </section>
                <section class="dish-card" data-category="main-courses">
                    <img src="./imgs/dishes/Main Courses/beer-brats.jpg" alt="Schnitzel" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Schnitzel</h2>
                            <p class="dish-type">Main course</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$5.90</p>
                    <a class="btn order" href="">Order</a>
                </section>
                <section class="dish-card" data-category="main-courses">
                    <img src="./imgs/dishes/Main Courses/beer-brats.jpg" alt="Schnitzel" class="dish-card-img">
                    <div class="dish-data-container">
                        <div>
                            <h2 class="dish-title">Schnitzel</h2>
                            <p class="dish-type">Main course</p>
                        </div>
                        <a href="#"><img src="./imgs/icons/cart.svg" alt="Cart"></a>
                    </div>
                    <p class="dish-price">$5.90</p>
                    <a class="btn order" href="">Order</a>
                </section>
            </div>
        </div>
    </main>

    <footer>
        <?php 
            include './parts/footer.php'
        ?>
    </footer>
</body>

</html>