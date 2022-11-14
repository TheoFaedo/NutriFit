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
                <button>Creer un plat</button>
                <button>Ajouter plat à la liste</button>
                <label for="pet-select">Choississez un plat</label>
                <select name="plats" id="plat-select">
                    <option value="">Choississez un plat</option>
                </select>
                <div id="val-nut"></div>
            </body>
        </html>
        <script>
            let plats;
            selecteur = document.querySelector("#plat-select");
        
            function loadRessource(uri){
                return fetch(uri).then(response => {
                    if(response.ok){
                        return response.json();
                    }else{
                        Promise.reject(new Error(response.statusText));
                    }
                });
            }
        
            req = loadRessource("http://localhost/NutriFit/requestGetPlats/");
        
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
            
            selecteur.addEventListener("click", (e) => {
                let valnut = document.getElementById("val-nut");
                plat = plats[selecteur.value];
                valnut.innerText = "energie: " + plat.energie + " lipides: " + plat.lipides + " glucides: " + plat.glucides + " proteines: " + plat.proteines;
            });
            
        </script>
        END ;

        return $html;
    }
}