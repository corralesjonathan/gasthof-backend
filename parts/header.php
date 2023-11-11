<header class="hero-background">
        <!--nav-->
        <?php 
            include 'navigation.php'
        ?>
        <!--nav-->
        <!--hero slider, titles & buttons-->
        <div class="hero-container">
            <div class="hero-title-container">
                <div class="hero-img-container">
                    <div class="hero-slide fade">
                        <img class="hero-img" src="./imgs/slides/hero-dish.png" alt="Hero dish">
                    </div>
                    <div class="hero-slide fade">
                        <img class="hero-img" src="./imgs/slides/hero-dish01.png" alt="Hero dish">
                    </div>
                    <div class="hero-dots-container">
                        <span class="hero-dot" onclick="currentHeroSlide(1)"></span>
                        <span class="hero-dot" onclick="currentHeroSlide(2)"></span>
                    </div>
                </div>
                <div class="hero-texts-container">
                    <h3 class="hero-title1">your passport to</h3>
                    <h1 class="hero-title2">german dining</h1>
                    <p class="hero-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. <br> Pellentesque
                        fermentum tempor accumsan.</p>
                    <div class="hero-buttons-container">
                        <a href="#" class="btn">read more</a>
                        <a href="menu.html" class="btn view-menu">view menu</a>
                    </div>
                </div>
            </div>
        </div>
        <!--hero slider, titles & buttons-->
    </header>