let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("slide");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "grid";
    dots[slideIndex - 1].className += " active";
}

//function to advance slide every 4 seconds
let autoSlideInterval = setInterval(function () {
    plusSlides(1);
}, 4000);

//function to stop the slider when the mouse enters or exits the dot
let dots = document.getElementsByClassName("dot");
for (let i = 0; i < dots.length; i++) {
    dots[i].addEventListener("mouseover", function () {
        clearInterval(autoSlideInterval); //stop slider with mouseover
    });
    dots[i].addEventListener("mouseout", function () {
        autoSlideInterval = setInterval(function () {
            plusSlides(1);
        }, 4000); //restart timer when the mouse exit the dot
    });
}


//add a way to scroll to change the slide on mobile
let touchStartX = null;
let touchEndX = null;

document.getElementById("slider-container").addEventListener("touchstart", function (e) {
    touchStartX = e.touches[0].clientX;
});

document.getElementById("slider-container").addEventListener("touchend", function (e) {
    touchEndX = e.changedTouches[0].clientX;

    //cheack the scroll direction
    if (touchStartX - touchEndX > 50) {
        plusSlides(1); //left to move forward
    } else if (touchEndX - touchStartX > 50) {
        plusSlides(-1); //right to move forward
    }
});

