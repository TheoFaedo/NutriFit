const boutons_navbar = document.querySelectorAll(".footbar_button img");
const navbar = document.getElementById("footbar");

//Handler permettant de gérer le changement entre les différents menus de l'application
navbar.addEventListener("click", (e) => {
    switch(e.target){
        case boutons_navbar[0]:
            document.location.href = "enregistrerPrise";
            break;
        case boutons_navbar[1]:
            document.location.href = "profile";
            break;
        case boutons_navbar[2]:
            document.location.href = "creerPlat";
            break;
    }
});