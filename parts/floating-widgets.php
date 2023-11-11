<!--back to top button-->
<a id="top" href="#"> <img src="./imgs/icons/up.svg" alt="Up"></a>
<!--back to top button-->

<!--whatsapp icon-->
<a href="https://web.whatsapp.com/" target="_blank" class="whatsapp-button"><img src="./imgs/icons/whatsapp.svg"
        alt="WhatsApp"></a>
<!--whatsapp icon-->

<script>
// Get the "Back to Top" button by its ID
let topButton = document.getElementById("top");

// Add a scroll event
window.addEventListener("scroll", function() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        topButton.style.display = "block"; // Show the button when scrolling down
    } else {
        topButton.style.display = "none"; // Hide the button when at the top
    }
});

// Add a click event to scroll back to the top when the button is clicked
topButton.addEventListener("click", function() {
    document.body.scrollTop = 0; // For web browsers
    document.documentElement.scrollTop = 0; // For Internet Explorer
});
</script>