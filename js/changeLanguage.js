// Esta función se ejecutará cuando la página haya terminado de cargar
window.onload = function () {
    // Agrega la clase "clicked" a la etiqueta de "en" por defecto
    document.getElementById("en").classList.add("clicked");
};

// Función para cambiar el idioma y obtener la traducción
function getTranslation(id, language) {
    // Agrega la clase "clicked" a la etiqueta actual
    document.getElementById(language).classList.add("clicked");

    // Elimina la clase "clicked" de la etiqueta opuesta
    let oppositeLanguage = (language === 'en') ? 'de' : 'en';
    document.getElementById(oppositeLanguage).classList.remove("clicked");

    // Muestra el ID en la consola
    console.log(id);

    // Crea un objeto con la información del plato y el idioma
    let info = {
        id_dish: id,
        language: language
    };

    // Realiza una solicitud fetch para obtener la traducción desde el servidor
    fetch("http://localhost/gasthof-backend/language.php", {
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
            // Actualiza el título y la descripción del plato con la traducción obtenida
            document.getElementById("dish-title").innerHTML = data.name;
            document.getElementById("dish-description").innerHTML = data.description;
        })
        .catch(err => console.log("error: " + err));
}
