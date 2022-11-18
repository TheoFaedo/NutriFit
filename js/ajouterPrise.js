const liste_prises = document.getElementById("liste_prises");
const selecteur = document.querySelector("#plat-select");
let plats;
let prises;

window.addEventListener("load", () => {
    actualiserPrises();
    actualiserObjectif();
})

function loadRessource(uri){
    return fetch(uri).then(response => {
        if(response.ok){
            return response.json();
        }else{
            Promise.reject(new Error(response.statusText));
        }
    });
}

req = loadRessource("requestGetPlats");

req.then((res) => {
    tab = res.plats;
    plats = tab;
    Object.keys(tab).forEach((key) => {
        let opt = document.createElement("option");
        opt.value = key;
        opt.text = tab[key].nom;
        selecteur.options.add(opt);
    }
)});

selecteur.addEventListener("change", (e) => {
    let valnut = document.getElementById("val-nut");
    plat = plats[selecteur.value];
    actualiserValNut(plat);
});

function ajouterPrise(){
    let platChoisi = selecteur.value;
    const data = { id: platChoisi+"" };
    fetch('requestAjouterPrise/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
        })
        .then((response) => actualiserPrises());
}

function actualiserPrises(){
    loadRessource("requestGetPriseDuJour")
        .then((res) => {
            console.log("salut");
            prises = res.prises;
            actualiserProgression()
            removeAllChild(liste_prises);
            liste_prises.appendChild(document.createElement("hr"));
            Object.keys(res.prises).forEach((key) => {

                let li = document.createElement("li");
                let prise = res.prises[key];

                let bouton = document.createElement("button");
                bouton.innerText = "-";
                bouton.onclick = () => supprimerPrise(prise.id_prise);
                li.appendChild(bouton);

                li.appendChild(document.createTextNode(prise.date_prise + " : " + prise.nom + " " + prise.energie + "kcal"));

                liste_prises.appendChild(li);
                liste_prises.appendChild(document.createElement("hr"));
            });
        });
}

function removeAllChild(node){
    while(node.childNodes[0]) node.removeChild(node.childNodes[0]);
}

function sommeValNut(){
    let somme = {energie:0, lipides:0, glucides:0, proteines:0};
    Object.keys(prises).forEach((key) => {
        somme.energie+= prises[key].energie;
        somme.lipides+= prises[key].lipides;
        somme.glucides+= prises[key].glucides;
        somme.proteines+= prises[key].proteines;
    });

    //On arrondi chaque sommes
    somme.energie = arrondi(somme.energie, 2);
    somme.lipides = arrondi(somme.lipides, 2);
    somme.glucides = arrondi(somme.glucides, 2);
    somme.proteines = arrondi(somme.proteines, 2);

    return somme;
}

function actualiserProgression(){
    let liste = document.body.getElementsByClassName("prog");
    let objSomme = sommeValNut();
    liste[0].innerText = objSomme.energie;
    liste[1].innerText = objSomme.lipides;
    liste[2].innerText = objSomme.glucides;
    liste[3].innerText = objSomme.proteines;
}

function actualiserObjectif(){
    let liste = document.body.getElementsByClassName("obj");
    loadRessource("requestGetObjectif")
        .then((res) => {
            let obj = res.objectif;
            liste[0].innerText = obj.obj_energie;
            liste[1].innerText = obj.obj_lipides;
            liste[2].innerText = obj.obj_glucides;
            liste[3].innerText = obj.obj_proteines;
        });
}

function actualiserValNut(plat){
    let liste = document.body.getElementsByClassName("valn");
    liste[0].innerText = plat.energie;
    liste[1].innerText = plat.lipides;
    liste[2].innerText = plat.glucides;
    liste[3].innerText = plat.proteines;
}

function supprimerPrise(idprise){
    const data = { id: idprise };
    fetch('requestSupprimerPlat/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
        })
        .then((response) => actualiserPrises());
}

function arrondi(nombre, precision){
    let arrondi = nombre * Math.pow(10, precision)
    arrondi = Math.round(arrondi);
    return arrondi/Math.pow(10, precision);
}