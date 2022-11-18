const boutons_navbar = document.querySelectorAll(".footbar_button img");
const navbar = document.getElementById("footbar");

navbar.addEventListener("click", (e) => {
    switch(e.target){
        case boutons_navbar[0]:
            document.location.href = "enregistrerPrise";
            break;
        case boutons_navbar[1]:
            document.location.href = "creerPlat";
            break;
    }
});