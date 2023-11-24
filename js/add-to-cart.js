function addToCart(id_user, id_dish, quantity, subtotal) {
    console.log(id_user, id_dish, quantity, subtotal);
    
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
            //action after dish was added to cart
            console.log(data);
        })
        .catch(err => console.log("error: " + err));
}