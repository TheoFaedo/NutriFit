let liste_prises = document.getElementById("liste_prises");
let plats;
let prises;
selecteur = document.querySelector("#plat-select");

window.addEventListener("load", () => {
    actualiserPrises();
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
    valnut.innerText = "energie: " + plat.energie + "kcal lipides: " + plat.lipides + "g glucides: " + plat.glucides + "g proteines: " + plat.proteines + "g";
});

function ajouterPrise(){
    console.log("sdf");
    let platChoisi = selecteur.value;
    const data = { id: platChoisi+"" };
    fetch('requestAjouterPrise/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
        })
        .then((response) => response.json());
        actualiserPrises();
}

function actualiserPrises(){
    loadRessource("requestGetPriseDuJour")
        .then((res) => {
            prises = res.prises;
            document.getElementById("obj").innerText = sommeEnergie();
            removeAllChild(liste_prises);
            Object.keys(res.prises).forEach((key) => {
                let li = document.createElement("li");
                let prise = res.prises[key];
                li.innerText = prise.date_prise + " " + prise.nom + " " + prise.energie + "kcal";
                liste_prises.appendChild(li);
            });
        });
}

function removeAllChild(node){
    while(node.childNodes[0]) node.removeChild(node.childNodes[0]);
}

function sommeEnergie(){
    let somme = 0;
    Object.keys(prises).forEach((key) => {
        somme+= prises[key].energie;
    });
    return somme;
}