<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Gasthof</title>
    <!--favicon-->
    <link rel="icon" href="./imgs/icons/favicon.svg" type="image/x-icon">
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <!--fonts-->
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <header class="hero-background menu-header-background">
        <!--nav-->
        <?php include './parts/navigation.php';?>
        <!--nav-->
        <div class="hero-container">
            <div class="menu-header-texts-container">
                <h3 class="home-title1 menu-header-title">contact us</h3>
            </div>
        </div>
    </header>

    <main>
        <div class="dishes-main-container">
            <div class="home-titles-container">
                <h3 class="home-title1">discover your</h3>
                <h2 class="home-title2">next destination</h2>
            </div>
            <div class="contact-container">
                <div class="contact-info-container">
                    <h2 class="single-dish-title dish-title">LOCATION</h2>
                    <p class="nav-footer-link contact-texts">Berliner Strasse, Belin.</p>

                    <h2 class="single-dish-title dish-title">schedule</h2>
                    <p class="nav-footer-link contact-texts">Monday to Saturday from 10:00 - 22:00</p>

                    <h2 class="single-dish-title dish-title">contact</h2>
                    <p class="nav-footer-link contact-texts">+490304664553700</p>

                    <h2 class="single-dish-title dish-title">social media</h2>
                    <div class="contact-socialmedia-container">
                        <a class="nav-footer-link contact-texts" href="">FACEBOOK</a>
                        <a class="nav-footer-link contact-texts" href="">INSTAGRAM</a>
                        <a class="nav-footer-link contact-texts" href="">TIKTOK</a>
                    </div>
                </div>
                <div class="location-container">
                    <img class="dish-img" src="./imgs/map.jpg" alt="Location">
                </div>
            </div>
        </div>

        <div class="dishes-main-container">
            <div class="home-titles-container">
                <h3 class="home-title1">let's talk</h3>
                <h2 class="home-title2">complete the form</h2>
            </div>
            <div class="contact-form-container">
                <form class="contact-form">
                    <div class="form-items">
                        <label class="nav-footer-link contact-texts">Name</label>
                        <input class="contact-input" type="text">
                    </div>
                    <div class="form-items">
                        <label class="nav-footer-link contact-texts">Email address</label>
                        <input class="contact-input" type="text">
                    </div>
                    <div class="form-items">
                        <label class="nav-footer-link contact-texts">Phone</label>
                        <input class="contact-input" type="tel">
                    </div>
                    <div class="form-items">
                        <label class="nav-footer-link contact-texts">Message (Opcional)</label>
                        <textarea class="contact-input" cols="30" rows="5"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <?php include './parts/footer.php'?>
    </footer>
</body>

</html>