//get elements by id
let btnEN = document.getElementById("btnEN");
let btnDE = document.getElementById("btnDE");

//add "click" event to change the language of the dish description to German
btnDE.addEventListener("click", () => {
    document.getElementById("dish-title").innerHTML = "KARTOFFELPUFFER";
    document.getElementById("dish-category").innerHTML = "Starthilfe";
    document.getElementById("dish-price").innerHTML = "€6.52";
    document.getElementById("dish-description").innerHTML = "Kartoffelpuffer sind flach gebratene Pfannkuchen aus geriebenen oder gemahlenen Kartoffeln,"+
    "Matzenmehl und einer bindenden Zutat wie Ei oder Apfelmus, oft gewürzt mit geriebenem Knoblauch oder Zwiebeln und Gewürzen.";
})

//add "click" event to change the language of the dish description to English
btnEN.addEventListener("click", () => {
    document.getElementById("dish-title").innerHTML = "KARTOFFELPUFFER";
    document.getElementById("dish-category").innerHTML = "Starter";
    document.getElementById("dish-price").innerHTML = "$6.90";
    document.getElementById("dish-description").innerHTML = "Potato Pancakes Are Shallow Fried Pancakes Of Grated Or Ground Potato,"+
    "Matzo Meal, And A Binding Ingredient Such As Egg Or Applesauce, Often Flavored With Grated Garlic Or Onion And Seasonings.";
})