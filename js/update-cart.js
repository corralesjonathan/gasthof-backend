function updateCart(id_user, id_dish, dish_price, id_cart) {
    let quantity = Number(document.getElementById("quantity-" + id_cart).value);
    let subtotal = Number(quantity * dish_price);
    subtotal = Number(subtotal.toFixed(2));

    let tdSubtotal = document.querySelector(`#subtotal-${id_cart}`);
    tdSubtotal.innerHTML = "$ " + subtotal;

    console.log(id_user, id_dish, quantity, subtotal);

    let info = {
        id_user: id_user,
        id_dish: id_dish,
        quantity: quantity,
        subtotal: subtotal
    };

    // Fetch
    fetch("http://localhost/gasthof-backend/AJAX/update-cart.php", {
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
            
            let ptotal = document.getElementById("total");
            let total=0;

            data.forEach(function(item) {
                total += Number(item.subtotal);
                total = Number(total.toFixed(2));
                console.log(total);
            });

            ptotal.innerHTML="<b>$"+total+"</b>";
        })
        .catch(err => console.log("Error al enviar la solicitud: " + err));
}