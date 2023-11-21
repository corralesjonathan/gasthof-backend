function getCategories(idCategory) {
    console.log(idCategory);

    //code to add and remove the "active" class depending on the category.
    if(idCategory === "all"){
        document.getElementById("all").classList.add("active");
    }else{
        document.getElementById("all").classList.remove("active");
    }

    if(idCategory === 1){
        document.getElementById("starters").classList.add("active");         
    }else{
        document.getElementById("starters").classList.remove("active");
    }

    if(idCategory === 2){
        document.getElementById("main-courses").classList.add("active");         
    }else{
        document.getElementById("main-courses").classList.remove("active");
    }

    if(idCategory === 3){
        document.getElementById("desserts").classList.add("active");         
    }else{
        document.getElementById("desserts").classList.remove("active");
    }

    if(idCategory === 4){
        document.getElementById("drinks").classList.add("active");         
    }else{
        document.getElementById("drinks").classList.remove("active");
    }

    //create variable to send via fetch
    let info = {
        category: idCategory
    };

    //fetch
    fetch("http://localhost/gasthof-backend/filter-dishes.php", {
            method: "POST",
            mode: "same-origin",
            credentials: "same-origin",
            headers: {
                'Accept': "application/json, text/plain, */*",
                'Content-Type': "application/json"
            },
            body: JSON.stringify(info)
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            //delete container each time a category is selected
            let menuContainer = document.getElementById("menu-container");
            menuContainer.innerHTML = '';

            if (data.length > 0) {
                //create dish cards container
                let dishesContainer = document.createElement("div");
                dishesContainer.setAttribute("id", "items");
                dishesContainer.classList.add("dishes-container");
                document.getElementById("menu-container").appendChild(dishesContainer);

                data.forEach(function(item) {
                    console.log(item.dish_category_name);
                    //ish card container
                    let dishCard = document.createElement("section");
                    dishCard.classList.add("dish-card");
                    dishesContainer.appendChild(dishCard);

                    //img container
                    let cardImgContainer = document.createElement("div");
                    cardImgContainer.classList.add("card-img-container");
                    dishCard.appendChild(cardImgContainer);

                    //link for dish image
                    let dishCardLink = document.createElement("a");
                    dishCardLink.setAttribute("href", "dish.php?id=" + item.id_dish);
                    dishCardLink.classList.add("dish-card-link");
                    cardImgContainer.appendChild(dishCardLink);

                    //dish image
                    let dishCardImage = document.createElement("img");
                    dishCardImage.setAttribute("src", './imgs/dishes/' + item.dish_category_name + '/' + item.dish_image);
                    dishCardImage.setAttribute("alt", item.dish_name);
                    dishCardImage.classList.add("dish-card-img");
                    dishCardLink.appendChild(dishCardImage);

                    //like button
                    let like = document.createElement("a");
                    like.setAttribute("id", "like");
                    cardImgContainer.appendChild(like);

                    //like icon
                    let likeIcon = document.createElement("img");
                    likeIcon.setAttribute("src", './imgs/icons/like.svg');
                    likeIcon.setAttribute("alt", "Like Icon");
                    likeIcon.classList.add("like-icon");
                    like.appendChild(likeIcon);

                    //dish data container
                    let dishDataContainer = document.createElement("div");
                    dishDataContainer.classList.add("dish-data-container");
                    dishCard.appendChild(dishDataContainer);

                    //dish texts container
                    let dishTextsContainer = document.createElement("div");
                    dishTextsContainer.classList.add("dish-texts-container");
                    dishDataContainer.appendChild(dishTextsContainer);

                    //link for dish title
                    let aTitles = document.createElement("a");
                    aTitles.setAttribute("href", "dish.php?id=" + item.id_dish);
                    aTitles.classList.add("a-titles");
                    dishTextsContainer.appendChild(aTitles);

                    //dish title
                    let dishTitle = document.createElement("h2");
                    dishTitle.classList.add("dish-title");
                    dishTitle.innerText = item.dish_name;
                    aTitles.appendChild(dishTitle);

                    //dish type/category
                    let dishType = document.createElement("p");
                    dishType.classList.add("dish-type");
                    dishType.innerText = item.dish_category_name;
                    dishTextsContainer.appendChild(dishType);

                    //add to cart button
                    let cart = document.createElement("a");
                    cart.setAttribute("href", "#");
                    dishDataContainer.appendChild(cart);

                    //add to cart icon
                    let cartImg = document.createElement("img");
                    cartImg.setAttribute("src", './imgs/icons/cart.svg');
                    cartImg.setAttribute("alt", "Cart");
                    cart.appendChild(cartImg);

                    //dish price
                    let dishPrice = document.createElement("p");
                    dishPrice.classList.add("dish-price");
                    dishPrice.innerText = "$" + item.dish_price;
                    dishCard.appendChild(dishPrice);

                    //order button
                    let btnOrder = document.createElement("a");
                    btnOrder.setAttribute("href", "dish.php?id=" + item.id_dish);
                    btnOrder.classList.add("btn");
                    btnOrder.classList.add("order");
                    btnOrder.innerText = "Order";
                    dishCard.appendChild(btnOrder);
                });
            }
        })
        .catch(err => console.log("error: " + err));
}
document.addEventListener("DOMContentLoaded", function () {
    getCategories('all');
});