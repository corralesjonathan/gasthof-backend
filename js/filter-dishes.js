function addToCart(id_user, id_dish, quantity, dishPrice) {
    console.log(id_user, id_dish, quantity, dishPrice);
    let subtotal = quantity*dishPrice;
    console.log(subtotal);
    
    let info = {
        id_user: id_user,
        id_dish: id_dish,
        quantity: quantity,
        subtotal: subtotal 
    };

    //fetch
    fetch("http://localhost/gasthof-backend/add-to-cart.php", {
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

            let cartPopup = document.getElementById("cart-popup");
            cartPopup.classList.add("show-cart-popup");
            cartPopup.innerHTML = '';

            if (data.length > 0) {
                    
                    let total=0;
                    
                    data.forEach(function(item) {
                        total += Number(item.subtotal);
                        total = Number(total.toFixed(2));
                        console.log(total);
                    });

                    //close button
                    let closeButton =  document.createElement("button");
                    closeButton.classList.add("close-btn-popup");
                    closeButton.onclick = function(){
                        cartPopup.classList.remove("show-cart-popup");
                    }
                    cartPopup.appendChild(closeButton);

                    //close img
                    let closeImg = document.createElement("img");
                    closeImg.classList.add("close-img-popup");
                    closeImg.setAttribute("src", './imgs/icons/close.svg');
                    closeImg.setAttribute("alt", "Close");
                    closeButton.appendChild(closeImg);

                    //added to cart message
                    let message = document.createElement("h2");
                    message.classList.add("slide-title");
                    message.classList.add("dish-title");
                    message.innerText = "dish successfully added to your cart!";
                    cartPopup.appendChild(message);

                    //total of dishes on cart message
                    let itemsMessage = document.createElement("p");
                    itemsMessage.classList.add("dish-type");
                    itemsMessage.classList.add("slide-description");
                    itemsMessage.innerHTML = "You have <b>"+data.length+"</b> items in your cart";
                    cartPopup.appendChild(itemsMessage);

                    //total amount message
                    let totalMesssage = document.createElement("p");
                    totalMesssage.classList.add("dish-type");
                    totalMesssage.classList.add("slide-description");
                    totalMesssage.innerHTML = "<b>Total:</b> $" +total;
                    cartPopup.appendChild(totalMesssage);

                    //go to cart button
                    let toCartbtn = document.createElement("a");
                    toCartbtn.classList.add("btn");
                    toCartbtn.classList.add("view-all");
                    toCartbtn.setAttribute("href", "cart.php");
                    toCartbtn.innerText="go to cart";
                    cartPopup.appendChild(toCartbtn);
            }
        })
        .catch(err => console.log("error: " + err));
}


function getWishlist(id_dish, id_user){
    console.log(id_dish, id_user);

    //create variable to send via fetch
    let info = {
        id_dish: id_dish,
        id_user: id_user 
    };
    
    //fetch
    fetch("http://localhost/gasthof-backend/get-wishlist.php", {
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
            window.location.href = "http://localhost/gasthof-backend/wishlist.php";
           if (data.length > 0){
            console.log("Added to wishlist");
           }else{
            console.log("Removed from wishlist");
           }
        });
}

function getCategories(idCategory, id_user) {
    console.log(idCategory, id_user);

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
        category: idCategory,
        id_user: id_user 
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
                    //dish card container
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
                    if(id_user>0){
                        //action if is already logged user
                        like.addEventListener("click", () => getWishlist(item.id_dish, id_user));
                    }else{
                        //action if don't exist logged user
                        like.setAttribute("href", 'login.php');
                        
                    }
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
                    if(id_user>0){
                        //action if is already logged user
                        cart.addEventListener("click", () => addToCart(id_user, item.id_dish, 1, item.dish_price));
                    }else{
                        //action if don't exist logged user
                        cart.setAttribute("href", 'login.php');
                    }
                    dishDataContainer.appendChild(cart);

                    //add to cart icon
                    let cartImg = document.createElement("img");
                    cartImg.classList.add("cart-img");
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
    getCategories('all', userId);
});