function removeFromCart(id_cart) {
    console.log(id_cart);

    let info = {
        id_cart: id_cart,
    };

    // Fetch
    fetch("http://localhost/gasthof-backend/remove-from-cart.php", {
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
            updateInterface(id_cart);
            console.log(data);
        })
        .catch(err => console.log("Error al enviar la solicitud: " + err));
}