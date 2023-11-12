<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Gathof</title>
    <!--fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/bebas-neue" rel="stylesheet">
    <!--fonts-->
    <link rel="stylesheet" href="./css/main.css">
</head>
<body>
    <!--header-->
    <header>
        <!--nav-->
        <?php 
            include './parts/navigation.php'; 
        ?>
        <!--nav-->
    </header>
    <!--header-->

    <main>
        <div class="login-container">
            <div class="login">
                <div class="home-titles-container">
                    <h3 class="home-title1">login to</h3>
                    <h2 class="home-title2">your account</h2>
                </div>
                <form class="contact-form">
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts">Username</label>
                        <input class="contact-input" type="text">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts">Password</label>
                        <input class="contact-input" type="password">
                    </div>
                </form>
            </div>
            <div class="sing-up">
                <div class="home-titles-container">
                    <h3 class="home-title1">need</h3>
                    <h2 class="home-title2">an account?</h2>
                </div>
                <form class="contact-form">
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts">Username</label>
                        <input class="contact-input" type="text">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts">Email</label>
                        <input class="contact-input" type="Email">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts">Password</label>
                        <input class="contact-input" type="password">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts">Name</label>
                        <input class="contact-input" type="text">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts">Lastname</label>
                        <input class="contact-input" type="text">
                    </div>
                    <div class="form-items login-form-items">
                        <label class="nav-footer-link contact-texts">Phone</label>
                        <div class="phone-inputs">
                        <select class="contact-input prefix"  name="Prefix" id="Prefix">
                            <option value="California">California</option>
                            <option value="Mexico">Mexico</option>
                        </select>
                        <!---<input class="contact-input prefix" type="text" value="+506">-->
                        <input class="contact-input tel" type="tel">
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <?php 
            include './parts/footer.php'; 
        ?>
    </footer>
    
</body>
</html>