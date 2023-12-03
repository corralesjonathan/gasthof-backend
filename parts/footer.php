<footer class="footer-container">
        <div class="footer-website-icon-container">
            <img src="./imgs/icons/website-icon.svg" alt="">
        </div>
        <div class="footer-content">
            <!--social links-->
            <div>
                <hr class="footer-hr">
                <div class="social-icons-container">
                    <a href="https://www.facebook.com/" target="_blank"> <img src="./imgs/icons/facebook.svg"
                            alt="Facebook"></a>
                    <a href="https://www.instagram.com/" target="_blank"><img src="./imgs/icons/instagram.svg"
                            alt="Instagram"></a>
                    <a href="https://www.tiktok.com/explore" target="_blank"><img src="./imgs/icons/tiktok.svg"
                            alt="TikTok"></a>
                </div>
            </div>
            <!--social links-->
            <div class="footer-links">
                <!--explore-->
                <section>
                    <hr class="footer-hr">
                    <h2 class="dish-title footer-titles">explore</h2>
                    <ul class="nav-footer-list">
                        <li><a class="nav-footer-link" href="home.html">Home</a></li>
                        <li><a class="nav-footer-link" href="menu.html">Menu</a></li>
                        <li><a class="nav-footer-link" href="#">About Us</a></li>
                    </ul>
                </section>
                <!--explore-->
                <!--contact us-->
                <section>
                    <hr class="footer-hr">
                    <h2 class="dish-title footer-titles">CONTACT US</h2>
                    <ul class="nav-footer-list">
                        <li><a class="nav-footer-link" href="tel:+490304664553700">+490304664553700</a></li>
                        <li><a class="nav-footer-link" href="mailto:info@gasthof.com">info@gasthof.com</a></li>
                        <li><a class="nav-footer-link" href="#">Berliner Strasse, Belin.</a></li>
                    </ul>
                </section>
                <!--contact us-->
                <!--legal-->
                <section>
                    <hr class="footer-hr">
                    <h2 class="dish-title footer-titles">LEGAL</h2>
                    <ul class="nav-footer-list">
                        <li><a class="nav-footer-link" href="#">Terms</a></li>
                        <li><a class="nav-footer-link" href="#">Privacy</a></li>
                    </ul>
                </section>
                <!--legal-->
            </div>
        </div>
        <!--footer legal-->
        <p class="footer-legal">©<span id="current-year"></span> Gasthof. - All rights reserved.</p>
        <!--footer legal-->
    </footer>
        <!--Get current year-->
    <script>
        let currenYear = document.getElementById("current-year");
        currenYear.innerHTML = new Date().getFullYear();
    </script>