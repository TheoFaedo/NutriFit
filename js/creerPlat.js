let inputs = {};

//Lorsque la page est chargée on ajoute différents handler aux inputs pour traquer leurs changement
window.addEventListener("load", () => {
    inputs = {energie: document.getElementById("energie"), lip: document.getElementById("lipides"), prot: document.getElementById("proteines"), gluc: document.getElementById("glucides")};
    Object.values(inputs).forEach((e) => {
        if(e.id == "energie"){
            e.addEventListener("change", () => {mettreMacrosAZero()});
        }else{
            e.addEventListener("change", () => {changerEnergie()});
        }
    });
})

function setAffichageValNuts(valNuts){
    inputs = {energie: document.getElementById("energie"), lip: document.getElementById("lipides"), prot: document.getElementById("proteines"), gluc: document.getElementById("glucides")};
    inputs.energie.value = valNuts.energie;
    inputs.lip.value = valNuts.lipides;
    inputs.prot.value = valNuts.proteines;
    inputs.gluc.value = valNuts.glucides;
    document.getElementById("nom").value = valNuts.nom;
}

/**
 * Fonction permettant de convertir les macronutriments en energie
 */
function changerEnergie(){
    inputs.energie.value = macrosToKCal({
        lipides: inputs.lip.value,
        proteines: inputs.prot.value,
        glucides: inputs.gluc.value
    });
}

/**
 * Fonction permettant de mettre tout les macronutriments à 0
 */
function mettreMacrosAZero(){
    Object.values(inputs).forEach((e) => {
        if(e.id != "energie"){
            e.value = 0;
        }
    });
}

/**
 * Fonction qui transforme les macronutriments passés en paramètre et retourne leurs équivalent en energie
 * @param {*} macros : objet contenant la valeur de chaque macronutriment (ex: {lipide: 10, proteines: 5, glucides: 20})
 * @returns la conversion en energie de la quantité de ces macronutriments
 */
function macrosToKCal(macros){
    return arrondi(macros.lipides*9 + macros.proteines * 4 + macros.glucides * 4);
}