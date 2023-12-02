window.onload = function () {
    document.getElementById("en").classList.add("clicked");
};

function getTranslation(id, language) {
    document.getElementById(language).classList.add("clicked");

    let oppositeLanguage = (language === 'en') ? 'de' : 'en';
    document.getElementById(oppositeLanguage).classList.remove("clicked");

    console.log(id);
    let info = {
        id_dish: id,
        language: language
    };

    fetch("http://localhost/gasthof-backend/AJAX/language.php", {
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
            
            document.getElementById("dish-title").innerHTML = data.name;
            document.getElementById("dish-description").innerHTML = data.description;
        })
        .catch(err => console.log("error: " + err));
}
