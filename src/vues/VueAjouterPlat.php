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
                <br/>
                <ul id="liste_prises">
                    
                </ul>
                <div id="obj"></div>
            </body>
        </html>
        <script src="$BaseUrl/js/ajouterPrise.js"></script>
        END ;

        return $html;
    }

}