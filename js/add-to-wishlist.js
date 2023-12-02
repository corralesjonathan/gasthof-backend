function addToWishlist(id_dish, id_user) {
    console.log(id_dish, id_user);
    
    let info = {
        id_dish: id_dish,
        id_user: id_user
    };

    //fetch
    fetch("http://localhost/gasthof-backend/AJAX/add-to-wishlist.php", {
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
        })
        .catch(err => console.log("error: " + err));

}