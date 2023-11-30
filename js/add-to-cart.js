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

    console.log(info);

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
            document.getElementById("cart-popup").classList.add("show-cart-popup");
        })
        .catch(err => console.log("error: " + err));
}