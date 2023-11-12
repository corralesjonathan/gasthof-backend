//nav-menu
function selectedPage() {
    //get buttons by id
    let btnHome = document.getElementById('btnHome');
    let btnMenu = document.getElementById('btnMenu');
    let btnContact = document.getElementById('btnContact');
    let btnAboutUs = document.getElementById('btnAboutUs');

    //get currently url
    let url = window.location.href;

    //check url
    if (url.includes("home.php")) {
        btnHome.classList.add("active");
    } else if (url.includes("menu.php")) {
        btnMenu.classList.add("active");
    } else if (url.includes("contact.html")) {
        btnContact.classList.add("active");
    } else if (url.includes("aboutUs.html")) {
        btnAboutUs.classList.add("active");
    }
}

//main loading
document.addEventListener("DOMContentLoaded", function () {
    selectedPage();
});