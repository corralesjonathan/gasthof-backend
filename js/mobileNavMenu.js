//mobile-nav-menu
    //get elements by id
    let nav = document.getElementById("nav-container");
    let open = document.getElementById("mobile-open-btn");
    let close = document.getElementById("mobile-close-btn");
    
    //make nav visible
    open.addEventListener("click", () => {
        nav.classList.add("visible");
    })
    
    //make nav unvisible
    close.addEventListener("click", () =>{
        nav.classList.remove("visible");
    })