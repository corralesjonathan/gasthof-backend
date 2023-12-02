function removeFromWishlist(id_wishlist) {
    console.log(id_wishlist);

    let info = {
        id_wishlist: id_wishlist,
    };

    // Fetch
    fetch("http://localhost/gasthof-backend/AJAX/remove-from-wishlist.php", {
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
            location.reload();
            console.log(data);
        })
        .catch(err => console.log("Error al enviar la solicitud: " + err));
}