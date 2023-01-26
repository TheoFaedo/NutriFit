const liste_prises = document.getElementById("liste_prises");
const selecteur = document.querySelector("#plat-select");
let plats;
let prises;

window.addEventListener("load", () => {
    actualiserPrises();
    actualiserObjectif();
})

//Récupération des plats de l'utilisateur
req = loadRessource("api/getPlats");
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

/**
 * Handler qui permet d'actualiser les informations du plat selectionné
 */
selecteur.addEventListener("change", (e) => {
    let valnut = document.getElementById("val-nut");
    plat = plats[selecteur.value];
    actualiserValNut(plat);
});

/**
 * Fonction permettant d'ajouter le plat selectionner comme prise
 */
function ajouterPrise(){
    let platChoisi = selecteur.value; //On récupère l'id du plat
    const data = { id: platChoisi+"" };
    fetch('api/ajouterPrise/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
        })
        .then((response) => actualiserPrises());
}

/**
 * Fontion qui actualise l'affichage des prise de la journée pour l'utilisateur
 */
function actualiserPrises(){
    loadRessource("api/getPriseDuJour")
        .then((res) => {
            prises = res.prises;
            actualiserProgression();

            //On supprime tout les elements de la liste
            removeAllChild(liste_prises);

            //On ajoute une premère ligne de séparation
            liste_prises.appendChild(document.createElement("hr"));

            //On va ajouter pour chaques prise, une ligne correspondante
            Object.keys(res.prises).forEach((key) => {

                //On créé l'element de la liste
                let li = document.createElement("li");
                let prise = res.prises[key];

                //On créé le bouton de supression de la prise
                let bouton = document.createElement("button");
                bouton.innerText = "-";
                bouton.onclick = () => supprimerPrise(prise.id_prise);
                li.appendChild(bouton);

                //Ajoute un texte comprenant la date de la prise du plat, son nom et son nombre de calories
                li.appendChild(document.createTextNode(prise.date_prise + " : " + prise.nom + " " + prise.energie + "kcal"));

                //On ajoute l'élément à la liste
                liste_prises.appendChild(li);
                liste_prises.appendChild(document.createElement("hr")); //On ajoute une ligne de séparation en dessous
            });
        });
}

/**
 * Fonction qui supprime tout les fils d'un noeud donné en paramètre
 * @param {*} node : noeud dont on veut supprimer les fils
 */
function removeAllChild(node){
    if (node.childNodes == null) return;
    while(node.childNodes[0]) node.removeChild(node.childNodes[0]);
}

/**
 * Fonction qui calcule la somme de toutes les valeurs nutrionelles de toutes les prises du jour
 * @returns un objet contenant la somme de chaques valeurs nutrionelles
 */
function sommeValNut(){
    let somme = {energie:0, lipides:0, glucides:0, proteines:0};
    Object.keys(prises).forEach((key) => {
        somme.energie+= prises[key].energie;
        somme.lipides+= prises[key].lipides;
        somme.glucides+= prises[key].glucides;
        somme.proteines+= prises[key].proteines;
    });

    //On arrondi chaque sommes à la centième près
    somme.energie = arrondi(somme.energie);
    somme.lipides = arrondi(somme.lipides);
    somme.glucides = arrondi(somme.glucides);
    somme.proteines = arrondi(somme.proteines);

    return somme;
}

/**
 * Fonction qui à son appel, actualise la somme des valeurs nutrionelles de toutes les prises
 */
function actualiserProgression(){
    let liste = document.body.getElementsByClassName("prog");
    let objSomme = sommeValNut();
    liste[0].innerText = objSomme.energie;
    liste[1].innerText = objSomme.lipides;
    liste[2].innerText = objSomme.glucides;
    liste[3].innerText = objSomme.proteines;
}

/**
 * Fonction permettant d'actualiser les valeurs d'objectif affichées
 */
function actualiserObjectif(){
    let liste = document.body.getElementsByClassName("obj");
    loadRessource("api/getObjectif")
        .then((res) => {
            let obj = res.objectif;
            liste[0].innerText = obj.obj_energie;
            liste[1].innerText = obj.obj_lipides;
            liste[2].innerText = obj.obj_glucides;
            liste[3].innerText = obj.obj_proteines;
        });
}

/**
 * Fonction permettant d'actualisé les valeurs des macrosnutriments affichées lorsque qu'un plat est selectionné
 * @param {*} plat 
 */
function actualiserValNut(plat){
    let liste = Array.from(document.body.getElementsByClassName("valn"));

    if(plat===undefined){ //Si le plat n'existe pas on affiche pas les valeurs nutritionelles
        liste.forEach((e) => {
            e.innerText="---";
        })
    }else{
        liste[0].innerText = plat.energie;
        liste[1].innerText = plat.lipides;
        liste[2].innerText = plat.glucides;
        liste[3].innerText = plat.proteines;
    }
}

/**
 * Fonction qui appelle la requête de suppression de prise dans la base de données
 * @param {*} idprise : id de la prise à supprimer
 */
function supprimerPrise(idprise){
    const data = { id: idprise }; //On mets l'id de la prise en payload
    fetch('api/supprimerPlat/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
        })
        .then((response) => actualiserPrises());
}

Quagga.init({
    inputStream : {
      name : "Live",
      type : "LiveStream",
      target: document.querySelector('#camera')    // Or '#yourElement' (optional)
    },
    decoder : {
      readers : ["ean_13_reader"],
    }
  }, function(err) {
      if (err) {
          console.log(err);
          return
      }
      console.log("Initialization finished. Ready to start");
      Quagga.start();
  });

Quagga.onDetected((data) => {
    console.log(data);
});