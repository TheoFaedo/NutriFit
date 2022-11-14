<?php
namespace app\vues;

use app\autres\CoeficientX;
use app\autres\EquationCourbe;
use app\autres\FonctionsUtiles;
use app\autres\ModeleCourbe;

class VueAjouterPlat{

    private $rq;

    public function __construct($rq){
        $this->rq = $rq;
    }

    public function render(){

        $BaseUrl = $this->rq->getUri()->getBasePath();

        $html = <<<END
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>NutriFit</title>
                <link rel="stylesheet" href="$BaseUrl/style/main.css">
            </head>
            <body>
                <label for="pet-select">Choississez un plat</label>
                <select name="plats" id="plat-select">
                    <option value="">Choisissez un plat</option>
                </select>
                <button onclick="ajouterPrise()">Ajouter</button>
                <div id="val-nut">energie: ...kcal lipides: ...g glucides: ...g proteines: ...g</div>
        
                <ul id="liste_prises">
                    
                </ul>
            </body>
        </html>
        <script>
            let liste_prises = document.getElementById("liste_prises");
            let plats;
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
        
            req = loadRessource("$BaseUrl/requestGetPlats/");
        
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
                fetch('$BaseUrl/requestAjouterPrise/', {
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
                loadRessource("http://localhost/ProjetSolo/NutriFit/requestGetPriseDuJour")
                    .then((res) => {
                        Object.keys(res.prises).forEach((key) => {
                            let li = document.createElement("li");
                            li.innerText = res.prises[key].nom;
                            liste_prises.appendChild(li);
                        });
                    });
            }
            
        </script>
        END ;

        return $html;
    }

}