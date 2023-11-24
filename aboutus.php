<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Gasthof</title>
    <!--favicon-->
    <?php include './parts/favicon.php'?>
    <!--fonts-->
    <?php include './parts/fonts.php'?>
    <link rel="stylesheet" href="./css/main.css">
</head>
    <body>
        <header class="hero-background menu-header-background">
            <!--nav-->
            <?php include './parts/navigation.php';?>
            <!--nav-->
            <!--hero-->
            <div class="hero-container">
                <div class="menu-header-texts-container">
                    <h3 class="home-title1 menu-header-title">about us</h3>
                </div>
            </div>
            <!--hero-->
        </header>

        <main>
            <!--what we offer section-->
            <div class="dishes-main-container">
                <div class="home-titles-container">
                    <h3 class="home-title1">what</h3>
                    <h2 class="home-title2">we offer?</h2>
                </div>
                <div class="contact-container">
                    <div class="contact-info-container">
                        <p class="dish-type slide-description">Lorem ipsum dolor sit amet consectetur.
                            Lectus urna mauris felis sit aliquet pretium cursus. Mollis ultrices volutpat et scelerisque
                            quis.
                            Faucibus cursus fringilla vel tristique massa accumsan aliquam iaculis non.
                            Quis vel morbi viverra euismod quis risus mi. Non sed enim vitae suspendisse ut id lacus.
                        </p>
                    </div>
                    <div class="mockup-container">
                        <img class="mockup-img" src="./imgs/gasthof-mockup.png" alt="Mockup">
                    </div>
                </div>
            </div>
            <!--what we offer section-->

            <!--about restaurant section-->
            <?php include './parts/about-us.php'?>
            <!--about restaurant section-->

            <!--subscribe form-->
            <?php include './parts/subscribe-form.php'?>
            <!--subscribe form-->
        </main>

        <footer> <?php include './parts/footer.php'?> </footer>
    </body>
</html>