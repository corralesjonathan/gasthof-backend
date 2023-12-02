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
    fetch("http://localhost/gasthof-backend/AJAX/add-to-cart.php", {
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