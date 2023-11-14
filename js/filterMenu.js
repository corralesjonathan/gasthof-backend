//filter menu
//function to filter dishes by category
/*function filterDishes(category) {
    //get buttons by id
    let btnAll = document.getElementById('btnAll');
    let btnDesserts = document.getElementById('btnDesserts');
    let btnStarters = document.getElementById('btnStarters');
    let btnMainCourses = document.getElementById('btnMainCourses');
    let btnDrinks = document.getElementById('btnDrinks');

    //add event "click" for all categories button
    btnAll.addEventListener('click', () => filterDishes('all'));

    //add event "click" for each category button
    btnDesserts.addEventListener('click', () => filterDishes('desserts'));
    btnStarters.addEventListener('click', () => filterDishes('starters'));
    btnMainCourses.addEventListener('click', () => filterDishes('main-courses'));
    btnDrinks.addEventListener('click', () => filterDishes('drinks'));

    let dishCard = document.querySelectorAll('.dish-card');
    dishCard.forEach(card => {
        if (category === 'all' || card.getAttribute('data-category') === category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }

        activeButton(category);
    });
}*/
//function to add and delete "active" class for filter menu
function activeButton(category) {

    if (category === 'all') {
        btnAll.classList.add("active");
    } else {
        btnAll.classList.remove("active");
    }

    if (category === 'desserts') {
        btnDesserts.classList.add("active");
    } else {
        btnDesserts.classList.remove("active");
    }

    if (category === 'main-courses') {
        btnMainCourses.classList.add("active");
    } else {
        btnMainCourses.classList.remove("active");
    }

    if (category === 'starters') {
        btnStarters.classList.add("active");
    } else {
        btnStarters.classList.remove("active");
    }

    if (category === 'drinks') {
        btnDrinks.classList.add("active");
    } else {
        btnDrinks.classList.remove("active");
    }
}

//main loading
document.addEventListener("DOMContentLoaded", function(){
    //show all by defalult
    filterDishes('all');
    activeButton(category);
    });